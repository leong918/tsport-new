<?php

use App\Http\Controllers\Admin\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'faq.'], function () {
    Route::get('faq/index', [FaqController::class, 'index'])->name('index');
    Route::get('faq/create', [FaqController::class, 'create'])->name('create');
    Route::post('faq/create', [FaqController::class, 'store'])->name('create.post');
    Route::get('faq/update/{id}', [FaqController::class, 'edit'])->name('update');
    Route::put('faq/update/{id}', [FaqController::class, 'update'])->name('update.put');
    Route::delete('faq/delete/{id}', [FaqController::class, 'destroy'])->name('destroy.delete');
    Route::post('faq/status/{id}', [FaqController::class, 'toggleStatus'])->name('status.post');
});
