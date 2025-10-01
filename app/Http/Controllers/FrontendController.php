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
    public function index()
    {
        $products = Product::latest()->get();
        $categories = Category::all();
        return view('landing.index', compact('products', 'categories'));
    }

    public function byCategory(Category $category)
    {
        $products = $category->products()->latest()->get();
        $categories = Category::all();
        return view('landing.index', compact('products', 'categories', 'category'));
    }
}
