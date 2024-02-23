<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('/product/{category_type}', [AppController::class, 'product'])->name('web.product');
    Route::get('/product/{category_type}/{category_id}', [AppController::class, 'filterProduct'])->name('web.filter_product_list');
    Route::get('/product_detail', [AppController::class, 'productDetail'])->name('web.product_detail');
    Route::get('/best_seller', [AppController::class, 'bestSeller'])->name('web.best_seller');
    Route::get('/brand/{brand_id}', [AppController::class, 'brand'])->name('web.brand');
    Route::get('/blog', [AppController::class, 'blog'])->name('web.blog');
    Route::get('/blog/detail', [AppController::class, 'blogDetail'])->name('web.blog_detail');
    Route::get('/voucher', [AppController::class, 'voucher'])->name('web.voucher');
    Route::get('/how_to', [AppController::class, 'howTo'])->name('web.how_to');
    Route::get('/new', [AppController::class, 'productNew'])->name('web.product_new');

    Route::get('login', [AuthController::class, 'login'])->name('web.login');
    Route::post('login', [AuthController::class, 'doLogin'])->name('web.doLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('web.logout');
    Route::get('register', [AuthController::class, 'register'])->name('web.register');
    Route::get('forgot_password', [AuthController::class, 'forgotPassword'])->name('web.forgot_password');
});
