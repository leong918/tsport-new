<?php

use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'event.'], function () {
    Route::get('event/index', [EventController::class, 'index'])->name('index');
    Route::get('event/create', [EventController::class, 'create'])->name('create');
    Route::post('event/create', [EventController::class, 'store'])->name('create.post');
    Route::get('event/update/{id}', [EventController::class, 'edit'])->name('update');
    Route::put('event/update/{id}', [EventController::class, 'update'])->name('update.put');
    Route::delete('event/delete/{id}', [EventController::class, 'destroy'])->name('destroy.delete');
    Route::post('event/status/{id}', [EventController::class, 'toggleStatus'])->name('status.post');
});
