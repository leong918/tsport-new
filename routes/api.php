<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require_once 'api/auth.php';
require_once 'api-streams.php';
require_once 'api-dvr.php';

// Viewer tracking routes - loaded separately without Sanctum middleware
// These are defined in api-viewer-tracking.php and will be registered below

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
