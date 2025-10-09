<?php

use App\Http\Controllers\Admin\PredictController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'predict.'], function () {
    Route::get('predict/index', [PredictController::class, 'index'])->name('index');
    Route::get('predict/create', [PredictController::class, 'create'])->name('create');
    Route::post('predict/create', [PredictController::class, 'store'])->name('create.post');
    Route::get('predict/update/{id}', [PredictController::class, 'edit'])->name('update');
    Route::put('predict/update/{id}', [PredictController::class, 'update'])->name('update.put');
    Route::delete('predict/delete/{id}', [PredictController::class, 'destroy'])->name('destroy.delete');
    Route::post('predict/status/{id}', [PredictController::class, 'toggleStatus'])->name('status.post');
});
