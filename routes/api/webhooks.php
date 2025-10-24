<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

Route::post('/dvr/upload-complete', [WebhookController::class, 'dvrUploadComplete']);
