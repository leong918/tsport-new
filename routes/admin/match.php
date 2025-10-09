<?php

use App\Http\Controllers\Admin\MatchController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'match.'], function () {
    Route::get('match/index', [MatchController::class, 'index'])->name('index');
    Route::get('match/create', [MatchController::class, 'create'])->name('create');
    Route::post('match/create', [MatchController::class, 'store'])->name('create.post');
    Route::get('match/update/{id}', [MatchController::class, 'edit'])->name('update');
    Route::put('match/update/{id}', [MatchController::class, 'update'])->name('update.put');
    Route::delete('match/delete/{id}', [MatchController::class, 'destroy'])->name('destroy.delete');
    Route::post('match/status/{id}', [MatchController::class, 'toggleStatus'])->name('status.post');
    Route::post('match/top/{id}', [MatchController::class, 'toggleTop'])->name('top.post');
});
