<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('/product', [AppController::class, 'product'])->name('web.product');
    Route::get('/product_detail', [AppController::class, 'productDetail'])->name('web.product_detail');

    Route::get('login', [AuthController::class, 'login'])->name('web.login');
    Route::post('login', [AuthController::class, 'doLogin'])->name('web.doLogin');
    Route::get('register', [AuthController::class, 'register'])->name('web.register');
    Route::get('forgot_password', [AuthController::class, 'forgotPassword'])->name('web.forgot_password');
});
