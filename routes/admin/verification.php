<?php

use App\Http\Controllers\Admin\VerificationController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'verification.'], function () {
    Route::get('email/userVerify/{id}', [VerificationController::class, 'sendVerificationViaEmail'])->name('sendVerificationViaEmail');
});
