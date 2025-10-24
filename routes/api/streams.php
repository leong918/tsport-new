<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StreamController;

Route::post('/streams/callback', [StreamController::class, 'srsCallback']);
Route::post('/srs/callback', [StreamController::class, 'srsCallback']);
Route::post('/streams/status', [StreamController::class, 'updateStatus']);
Route::get('/streams/{streamKey}', [StreamController::class, 'show']);
Route::get('/dvr/recordings/{liveMatchId}', [StreamController::class, 'getDvrRecordings']);
