<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('/product', [AppController::class, 'product'])->name('web.product');
    Route::get('/product_detail', [AppController::class, 'productDetail'])->name('web.product_detail');
    Route::get('/best_seller', [AppController::class, 'bestSeller'])->name('web.best_seller');
    Route::get('/brand', [AppController::class, 'brand'])->name('web.brand');
    Route::get('/blog', [AppController::class, 'blog'])->name('web.blog');
    Route::get('/blog/detail', [AppController::class, 'blogDetail'])->name('web.blog_detail');

    Route::get('login', [AuthController::class, 'login'])->name('web.login');
    Route::post('login', [AuthController::class, 'doLogin'])->name('web.doLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('web.logout');
    Route::get('register', [AuthController::class, 'register'])->name('web.register');
    Route::get('forgot_password', [AuthController::class, 'forgotPassword'])->name('web.forgot_password');
});
