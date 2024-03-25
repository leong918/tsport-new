<?php

use App\Http\Controllers\Admin\TopBarController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'top_bar.'], function () {
    Route::get('top_bar/index', [TopBarController::class, 'index'])->name('index');
    Route::get('top_bar/create', [TopBarController::class, 'create'])->name('create');
    Route::post('top_bar/create', [TopBarController::class, 'store'])->name('create.post');
    Route::get('top_bar/update/{id}', [TopBarController::class, 'edit'])->name('update');
    Route::put('top_bar/update/{id}', [TopBarController::class, 'update'])->name('update.put');
    Route::delete('top_bar/delete/{id}', [TopBarController::class, 'destroy'])->name('destroy.delete');
    Route::post('top_bar/status/{id}', [TopBarController::class, 'toggleStatus'])->name('status.post');

});
