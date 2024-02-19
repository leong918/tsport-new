<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.'], function () {
    Route::get('user/index', [UserController::class, 'index'])->name('index');
    Route::get('user/create', [UserController::class, 'create'])->name('create');
    Route::post('user/create', [UserController::class, 'store'])->name('create.post');
    Route::get('user/update/{id}', [UserController::class, 'edit'])->name('update');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('update.put');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('destroy.delete');
    Route::post('user/status/{id}', [UserController::class, 'toggleStatus'])->name('status.post');
});
