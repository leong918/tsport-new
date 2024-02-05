<?php

use App\Http\Controllers\Admin\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'currency.'], function () {
    Route::get('currency/index', [CurrencyController::class, 'index'])->name('index');
    Route::get('currency/create', [CurrencyController::class, 'create'])->name('create');
    Route::post('currency/create', [CurrencyController::class, 'store'])->name('create.post');
    Route::get('currency/update/{id}', [CurrencyController::class, 'edit'])->name('update');
    Route::put('currency/update/{id}', [CurrencyController::class, 'update'])->name('update.put');
    Route::delete('currency/delete/{id}', [CurrencyController::class, 'destroy'])->name('destroy.delete');
    Route::post('currency/status/{id}', [CurrencyController::class, 'toggleStatus'])->name('status.post');
});
