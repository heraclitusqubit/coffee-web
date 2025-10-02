<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

    //landing page

Route::get('/', [FrontendController::class, 'index'])->name('landing.index');
Route::get('/category/{category}', [FrontendController::class, 'byCategory'])->name('landing.byCategory');
Route::get('/products/{product}', [FrontendController::class, 'show'])->name('landing.show');

    // product

    // cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');



    // checkout
Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class); //👈 tambahan
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);

});

