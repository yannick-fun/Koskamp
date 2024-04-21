<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('product_index');
    Route::get('/product/{product:id}', [ProductController::class, 'show'])->name('product_show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart_index');
    Route::post('/products', [CartController::class, 'addItem'])->name('add_product');
    Route::delete('/cart/{cart:id}', [CartController::class, 'removeCart'])->name('delete_cart');

    Route::put('/cartItem/{cartItem:id}', [CartItemController::class, 'updateCartItem'])->name('update_product');
    Route::delete('/cartItem/{cartItem:id}', [CartItemController::class, 'removeCartItem'])->name('delete_product');
});

require __DIR__ . '/auth.php';
