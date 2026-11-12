<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan isi keranjang milik user yang login.
     */
    public function index(Request $request)
    {
        $items = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get()
            // produk yang sudah dinonaktifkan/dihapus admin tidak ditampilkan
            ->filter(fn ($item) => $item->product && $item->product->is_active)
            ->values();

        $total = $items->sum(fn ($item) => $item->subtotal);

        return view('cart', compact('items', 'total'));
    }

    /**
     * Tambah produk ke keranjang (jumlah bertambah jika sudah ada).
     */
    public function add(Request $request, Product $product)
    {
        abort_unless($product->is_active, 404);

        $data = $request->validate([
            'quantity' => 'nullable|integer|min:1|max:' . CartItem::MAX_QUANTITY,
        ]);
        $quantity = $data['quantity'] ?? 1;

        $item = CartItem::firstOrNew([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        $newQuantity = ($item->exists ? $item->quantity : 0) + $quantity;

        if ($product->stock < 1) {
            return back()->withErrors(['stock' => $product->name . ' sedang habis.']);
        }

        if ($newQuantity > $product->stock) {
            return back()->withErrors([
                'stock' => 'Stok ' . $product->name . ' tidak mencukupi (tersisa ' . $product->stock . ').',
            ]);
        }

        $item->quantity = min($newQuantity, CartItem::MAX_QUANTITY);
        $item->save();

        return back()->with('success', $product->name . ' ditambahkan ke keranjang.');
    }

    /**
     * Ubah jumlah item.
     */
    public function update(Request $request, int $item)
    {
        $cartItem = CartItem::with('product')->where('user_id', $request->user()->id)->findOrFail($item);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . CartItem::MAX_QUANTITY,
        ]);

        if ($cartItem->product && $data['quantity'] > $cartItem->product->stock) {
            return back()->withErrors([
                'stock' => 'Stok ' . $cartItem->product->name . ' tidak mencukupi (tersisa ' . $cartItem->product->stock . ').',
            ]);
        }

        $cartItem->update(['quantity' => $data['quantity']]);

        return redirect()->route('cart.index')->with('success', 'Jumlah berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang.
     */
    public function destroy(Request $request, int $item)
    {
        CartItem::where('user_id', $request->user()->id)->findOrFail($item)->delete();

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }
}
