<?php

use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'blog.'], function () {
    Route::get('blog/index', [BlogController::class, 'index'])->name('index');
    Route::get('blog/getBlogComment', [BlogController::class, 'getBlogComment'])->name('getBlogComment');
    Route::get('blog/create', [BlogController::class, 'create'])->name('create');
    Route::post('blog/create', [BlogController::class, 'store'])->name('create.post');
    Route::get('blog/update/{id}', [BlogController::class, 'edit'])->name('update');
    Route::put('blog/update/{id}', [BlogController::class, 'update'])->name('update.put');
    Route::delete('blog/delete/{id}', [BlogController::class, 'destroy'])->name('destroy.delete');
    Route::post('blog/status/{id}', [BlogController::class, 'toggleStatus'])->name('status.post');
});
