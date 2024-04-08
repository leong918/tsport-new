<?php

use App\Plugins\ProductReview\Admin\ProductReviewController;
use App\Plugins\ProductReview\Web\ProductReviewController as WebProductReviewController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    /**
     * Route admin
     */

    Route::group(['namespace' => 'product_review'], function () {
        Route::post('product_review/post_review/{id}', [WebProductReviewController::class, 'postReview'])->name('product_review.post_review');
    });

    Route::group(['as' => 'admin.product_review.', 'prefix' => 'admin'], function () {
        Route::get('product_review/index', [ProductReviewController::class, 'index'])->name('index');
        Route::delete('product_review/delete/{id}', [ProductReviewController::class, 'destroy'])->name('destroy.delete');
        Route::post('product_review/status/{id}', [ProductReviewController::class, 'toggleStatus'])->name('status.post');
    });
});
