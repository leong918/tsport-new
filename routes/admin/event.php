<?php
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'event.'], function () {
    Route::get('event', [EventController::class, 'index'])->name('index');
    Route::get('event/create', [EventController::class, 'create'])->name('create');
    Route::post('event', [EventController::class, 'store'])->name('store');
    Route::get('event/{id}', [EventController::class, 'show'])->name('show');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('edit');
    Route::put('event/{id}', [EventController::class, 'update'])->name('update');
    Route::delete('event/{id}', [EventController::class, 'destroy'])->name('destroy');
    
    // Additional routes for soft delete functionality
    Route::post('event/{id}/toggle-status', [EventController::class, 'toggleStatus'])->name('toggle-status');
    Route::post('event/{id}/restore', [EventController::class, 'restore'])->name('restore');
    Route::delete('event/{id}/force-delete', [EventController::class, 'forceDelete'])->name('force-delete');
});
