<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // tampilkan cart
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // tambah produk ke cart
    // public function add(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $cart = session()->get('cart', []);

    //     if(isset($cart[$id])){
    //         $cart[$id]['qty']++;
    //     } else {
    //         $cart[$id] = [
    //             "name" => $product->name,
    //             "price" => $product->price,
    //             "qty" => 1
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Produk ditambahkan ke cart!');
    // }
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $variant = $request->get('variant', 'Default');
        $quantity = (int) $request->get('qty', 1);

        // Key unik: gabungan ID + variant (supaya 1 produk bisa beda varian di cart)
        $key = $id . '_' . $variant;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $quantity;
        } else {
            $cart[$key] = [
                "id"      => $id,               // simpan ID asli untuk database
                "name"    => $product->name,
                "qty"     => $quantity,
                "price"   => $product->price,
                "image"   => $product->image,
                "variant" => $variant,
            ];
        }

        session()->put('cart', $cart);

        return redirect('/')->with('success', 'Produk berhasil ditambahkan ke cart!');
    }


    // update qty
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    // hapus item
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    // kosongkan cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
