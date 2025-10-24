<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ViewerTrackingController;

Route::post('/live/{id}/join', [ViewerTrackingController::class, 'join']);
Route::post('/live/{id}/leave', [ViewerTrackingController::class, 'leave']);
Route::post('/live/{id}/heartbeat', [ViewerTrackingController::class, 'heartbeat']);
Route::get('/live/{id}/viewers', [ViewerTrackingController::class, 'getViewers']);
