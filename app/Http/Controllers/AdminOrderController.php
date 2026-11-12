<?php

namespace App\Http\Controllers;

use App\Models\FinanceReport;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:' . implode(',', array_keys(Order::TRANSITIONS)),
        ]);

        $orders = Order::with('user')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $order)
    {
        $order = Order::with(['items', 'user'])->findOrFail($order);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Ubah status pesanan sesuai aturan transisi.
     * Saat status menjadi "selesai", pemasukan otomatis tercatat di laporan keuangan.
     */
    public function updateStatus(Request $request, int $order)
    {
        $order = Order::findOrFail($order);

        $data = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::TRANSITIONS)),
        ]);

        if (! $order->canTransitionTo($data['status'])) {
            return back()->withErrors([
                'status' => "Status tidak bisa diubah dari {$order->status} ke {$data['status']}.",
            ]);
        }

        DB::transaction(function () use ($order, $data) {
            $order->update(['status' => $data['status']]);

            // pesanan dibatalkan: stok dikembalikan
            if ($data['status'] === Order::CANCELLED) {
                $order->restoreStock();
            }

            if ($data['status'] === Order::DONE) {
                FinanceReport::create([
                    'date' => now()->toDateString(),
                    'type' => FinanceReport::INCOME,
                    'amount' => $order->total,
                    'note' => 'Penjualan pesanan #' . $order->id,
                ]);
            }
        });

        return back()->with('success', 'Status pesanan #' . $order->id . ' diubah menjadi ' . $data['status'] . '.');
    }
}
