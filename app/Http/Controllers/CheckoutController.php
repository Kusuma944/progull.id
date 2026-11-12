<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    /**
     * Ambil item keranjang user yang produknya masih aktif.
     */
    private function activeCartItems(Request $request)
    {
        return CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get()
            ->filter(fn ($item) => $item->product && $item->product->is_active)
            ->values();
    }

    public function create(Request $request)
    {
        $items = $this->activeCartItems($request);

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Keranjang masih kosong.']);
        }

        $total = $items->sum(fn ($item) => $item->subtotal);

        return view('checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $items = $this->activeCartItems($request);

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Keranjang masih kosong.']);
        }

        $data = $request->validate([
            'recipient_name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^[0-9]{9,15}$/'],
            'address' => 'required|string|min:10|max:255',
            'note' => 'nullable|string|max:255',
        ], [
            'phone.regex' => 'Nomor telepon harus berupa angka 9-15 digit.',
        ]);

        $order = DB::transaction(function () use ($request, $items, $data) {
            // Kunci baris produk dan cek stok agar tidak terjual melebihi persediaan
            foreach ($items as $item) {
                $product = Product::whereKey($item->product_id)->lockForUpdate()->first();

                if (! $product || ! $product->is_active || $product->stock < $item->quantity) {
                    throw ValidationException::withMessages([
                        'stock' => 'Stok ' . $item->product->name . ' tidak mencukupi (tersisa ' . ($product->stock ?? 0) . ').',
                    ]);
                }
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => Order::PENDING,
                'total' => $items->sum(fn ($item) => $item->subtotal),
                'recipient_name' => $data['recipient_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'note' => $data['note'] ?? null,
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                ]);

                // kurangi stok sesuai jumlah yang dibeli
                Product::whereKey($item->product_id)->decrement('stock', $item->quantity);
            }

            // kosongkan keranjang setelah pesanan dibuat
            CartItem::where('user_id', $request->user()->id)->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat. Nomor pesanan #' . $order->id);
    }
}
