<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'product.'], function () {
    Route::get('product/index', [ProductController::class, 'index'])->name('index');
    Route::get('product/create', [ProductController::class, 'create'])->name('create');
    Route::post('product/create', [ProductController::class, 'store'])->name('create.post');
    Route::get('product/update/{id}', [ProductController::class, 'edit'])->name('update');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('update.put');
    Route::put('product/updateStock/{id}', [ProductController::class, 'updateStock'])->name('updateStock.put');
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('destroy.delete');
    Route::post('product/status/{id}', [ProductController::class, 'toggleStatus'])->name('status.post');
});
