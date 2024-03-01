<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('product/{category_type?}', [AppController::class, 'product'])->name('web.product');
    Route::get('product_detail/{alias}', [AppController::class, 'productDetail'])->name('web.product_detail');
    Route::get('best_seller', [AppController::class, 'bestSeller'])->name('web.best_seller');
    Route::get('brand/{brand_id}', [AppController::class, 'brand'])->name('web.brand');
    Route::get('blog', [AppController::class, 'blog'])->name('web.blog');
    Route::get('blog/detail/{blog_id}', [AppController::class, 'blogDetail'])->name('web.blog_detail');
    Route::post('blog_comment/create', [AppController::class, 'createBlogComment'])->name('web.create_blog_comment');
    Route::get('voucher', [AppController::class, 'voucher'])->name('web.voucher');
    Route::get('how_to', [AppController::class, 'howTo'])->name('web.how_to');
    Route::get('new', [AppController::class, 'productNew'])->name('web.product_new');

    require_once 'auth.php';
    require_once 'about.php';
    require_once 'account.php';
    require_once 'cart.php';
});
