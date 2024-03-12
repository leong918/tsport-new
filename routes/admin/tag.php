<?php

use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'tag.'], function () {
    Route::get('tag/index', [TagController::class, 'index'])->name('index');
    Route::get('tag/create', [TagController::class, 'create'])->name('create');
    Route::post('tag/create', [TagController::class, 'store'])->name('create.post');
    Route::get('tag/update/{id}', [TagController::class, 'edit'])->name('update');
    Route::put('tag/update/{id}', [TagController::class, 'update'])->name('update.put');
    Route::delete('tag/delete/{id}', [TagController::class, 'destroy'])->name('destroy.delete');
    Route::post('tag/status/{id}', [TagController::class, 'toggleStatus'])->name('status.post');
});
