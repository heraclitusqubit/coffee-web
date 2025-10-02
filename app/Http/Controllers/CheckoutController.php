<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function form()
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Cart kosong!');
        }
        return view('checkout.form', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_address' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('cart.index');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // simpan order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
            'customer_phone' => $request->customer_phone,
            'total' => $total,
            'status' => 'pending',
            'discount'        => $request->discount ?? 0,
            'shipping_cost'   => $request->shipping_cost ?? 0,
        ]);

        // simpan item
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'variant'    => $item['variant'],
                'qty' => $item['qty'],
                'price' => $item['price']
            ]);
        }

        // kosongkan cart
        session()->forget('cart');

        return redirect()->route('landing.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
