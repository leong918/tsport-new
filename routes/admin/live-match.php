<?php

use App\Http\Controllers\Admin\LiveMatchController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'live-match', 'as' => 'live-match.'], function () {
    Route::get('/', [LiveMatchController::class, 'index'])->name('index');
    Route::get('/create', [LiveMatchController::class, 'create'])->name('create');
    Route::post('/store', [LiveMatchController::class, 'store'])->name('store');
    Route::get('/show/{id}', [LiveMatchController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [LiveMatchController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [LiveMatchController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [LiveMatchController::class, 'destroy'])->name('destroy');
    
    // Status and control routes
    Route::post('/status/{id}', [LiveMatchController::class, 'toggleStatus'])->name('status.post');
    Route::post('/start-streaming/{id}', [LiveMatchController::class, 'startStreaming'])->name('start-streaming');
    Route::post('/mark-as-live/{id}', [LiveMatchController::class, 'markAsLive'])->name('mark-as-live');
    Route::post('/stop-streaming/{id}', [LiveMatchController::class, 'stopStreaming'])->name('stop-streaming');
    Route::post('/update-viewer-count/{id}', [LiveMatchController::class, 'updateViewerCount'])->name('update-viewer-count');
    
    // Statistics
    Route::get('/statistics', [LiveMatchController::class, 'statistics'])->name('statistics');
});
