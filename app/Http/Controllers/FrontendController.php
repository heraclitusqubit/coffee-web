<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    // public function index()
    // {
    //     $products = Product::all();
    //     return view('landing.index', compact('products'));
    // }
    // public function index()
    // {
    //     $categories = Category::all();
    //     $products = Product::latest()->get();
    //     return view('landing.index', compact('products', 'categories'));
    // }
    public function show(Product $product)
    {
        return view('landing.show', compact('product'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        // search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $products = Product::latest()->take(8)->get();
        // filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('landing.index', compact('products', 'categories'));
    }


    public function byCategory($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('landing.index', compact('products', 'categories', 'category'));
    }
}
