<?php

use App\Http\Controllers\Web\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'cart'], function () {
    Route::get('cart', [CartController::class, 'cart'])->name('cart.shopping_cart');
    Route::get('wishlist', [CartController::class, 'wishlist'])->name('cart.wishlist');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('payment', [CartController::class, 'payment'])->name('cart.payment');
    Route::get('complete', [CartController::class, 'complete'])->name('cart.complete');
});
