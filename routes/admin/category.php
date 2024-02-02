<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'category.'], function () {
    Route::get('category/index', [CategoryController::class, 'index'])->name('index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('create');
    Route::post('category/create', [CategoryController::class, 'store'])->name('create.post');
    Route::get('category/update/{id}', [CategoryController::class, 'edit'])->name('update');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('update.put');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy.delete');
    Route::post('category/status/{id}', [CategoryController::class, 'toggleStatus'])->name('status.post');
});
