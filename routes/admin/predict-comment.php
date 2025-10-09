<?php

use App\Http\Controllers\Admin\PredictCommentController;
use App\Http\Controllers\Admin\PredictController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'predict-comment.'], function () {
    Route::post('predict/comment/status/{id}', [PredictCommentController::class, 'toggleStatus'])->name('status.post');
    Route::get('predict/comment/update/{id}', [PredictCommentController::class, 'edit'])->name('update');
    Route::put('predict/comment/update/{id}', [PredictCommentController::class, 'update'])->name('update.put');
    Route::delete('predict/comment/delete/{id}', [PredictCommentController::class, 'destroy'])->name('destroy.delete');
});
