<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalPending = Order::where('status', 'pending')->count();
        $totalOmzet = Order::whereIn('status', ['paid', 'shipped', 'done'])->sum('total');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalPending',
            'totalOmzet'
        ));
    }
}
