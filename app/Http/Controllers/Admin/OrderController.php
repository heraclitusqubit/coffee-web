<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }


    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,done',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Status order berhasil diupdate');
    }
}
