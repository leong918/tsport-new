<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'brand.'], function () {
    Route::get('brand/index', [BrandController::class, 'index'])->name('index');
    Route::get('brand/create', [BrandController::class, 'create'])->name('create');
    Route::post('brand/create', [BrandController::class, 'store'])->name('create.post');
    Route::get('brand/update/{id}', [BrandController::class, 'edit'])->name('update');
    Route::put('brand/update/{id}', [BrandController::class, 'update'])->name('update.put');
    Route::delete('brand/delete/{id}', [BrandController::class, 'destroy'])->name('destroy.delete');
    Route::post('brand/status/{id}', [BrandController::class, 'toggleStatus'])->name('status.post');
});
