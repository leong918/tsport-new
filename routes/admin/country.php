<?php

use App\Http\Controllers\Admin\CountryController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'country.'], function () {
    Route::get('country/index', [CountryController::class, 'index'])->name('index');
    Route::get('country/create', [CountryController::class, 'create'])->name('create');
    Route::post('country/create', [CountryController::class, 'store'])->name('create.post');
    Route::get('country/update/{id}', [CountryController::class, 'edit'])->name('update');
    Route::put('country/update/{id}', [CountryController::class, 'update'])->name('update.put');
    Route::delete('country/delete/{id}', [CountryController::class, 'destroy'])->name('destroy.delete');
    Route::post('country/status/{id}', [CountryController::class, 'toggleStatus'])->name('status.post');
});
