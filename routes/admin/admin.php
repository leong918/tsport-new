<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.'], function () {
    Route::get('admin/index', [AdminController::class, 'index'])->name('index');
    Route::get('admin/create', [AdminController::class, 'create'])->name('create');
    Route::post('admin/create', [AdminController::class, 'store'])->name('create.post');
    Route::get('admin/update/{id}', [AdminController::class, 'edit'])->name('update');
    Route::put('admin/update/{id}', [AdminController::class, 'update'])->name('update.put');
    Route::delete('admin/delete/{id}', [AdminController::class, 'destroy'])->name('destroy.delete');
    Route::post('admin/status/{id}', [AdminController::class, 'toggleStatus'])->name('status.post');
    Route::any('admin/profile', [AdminController::class, 'profile'])->name('profile');
});
