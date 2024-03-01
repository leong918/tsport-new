<?php

use App\Plugins\ProductReview\Admin\ProductReviewController;
use Illuminate\Support\Facades\Route;

/**
 * Route admin
 */
Route::group(['as' => 'admin.product_review.', 'prefix' => 'admin'], function () {
    Route::get('product_review/index', [ProductReviewController::class, 'index'])->name('index');
    Route::delete('product_review/delete/{id}', [ProductReviewController::class, 'destroy'])->name('destroy.delete');
    Route::post('product_review/status/{id}', [ProductReviewController::class, 'toggleStatus'])->name('status.post');
});
