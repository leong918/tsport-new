<?php

use App\Http\Controllers\Api\DvrController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| DVR API Routes
|--------------------------------------------------------------------------
|
| Routes for handling DVR upload notifications from rtmp-server
| These routes are not protected by authentication middleware
|
*/

Route::prefix('dvr')->group(function () {
    Route::post('/upload-complete', [DvrController::class, 'uploadComplete']);
});
