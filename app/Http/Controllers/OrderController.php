<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Riwayat pesanan milik customer yang login.
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, int $order)
    {
        $order = Order::with('items')
            ->where('user_id', $request->user()->id)
            ->findOrFail($order);

        return view('orders.show', compact('order'));
    }

    /**
     * Customer hanya boleh membatalkan pesanan yang masih pending.
     */
    public function cancel(Request $request, int $order)
    {
        $order = Order::where('user_id', $request->user()->id)->findOrFail($order);

        if ($order->status !== Order::PENDING) {
            return back()->withErrors(['status' => 'Hanya pesanan berstatus pending yang bisa dibatalkan.']);
        }

        DB::transaction(function () use ($order) {
            $order->update(['status' => Order::CANCELLED]);
            $order->restoreStock();
        });

        return back()->with('success', 'Pesanan #' . $order->id . ' dibatalkan.');
    }
}
