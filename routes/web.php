<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('api')->group(function () {
    require __DIR__.'/api.php';
});

Route::get('/products', [ProductController::class, 'index'])->name('product_index');
Route::get('/product/{product:id}', [ProductController::class, 'show'])->name('product_show');

Route::get('/cart', [CartController::class, 'index'])->name('cart_index');
Route::post('/products', [CartController::class, 'addItem'])->name('add_product');
Route::delete('/cart/{cart:id}', [CartController::class, 'removeCart'])->name('delete_cart');

Route::put('/cart/{cartItem:id}', [CartItemController::class, 'updateCartItem'])->name('update_product');
Route::delete('/cart/{item:id}', [CartItemController::class, 'removeCartItem'])->name('delete_product');
