<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'web.', 'namespace' => 'Web'], function () {
    // Public routes accessible to everyone
    Route::get('', [AppController::class, 'index'])->name('home');
    Route::get('live-matches', [AppController::class, 'liveMatches'])->name('live-matches');
    Route::get('event', [AppController::class, 'events'])->name('events');
    Route::get('predict', [AppController::class, 'predict'])->name('predict');
    Route::get('predict/{id}', [AppController::class, 'predictDetail'])->name('predict.detail');

    Route::get('ordering', [AppController::class, 'ordering'])->name('ordering');

    // Routes for guests only (redirects authenticated users)
    Route::group(['middleware' => 'auth.user.authenticated'], function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('do-register', [AuthController::class, 'doRegister'])->name('do-register');
        Route::post('do-login', [AuthController::class, 'doLogin'])->name('do-login');
        // Route::post('forgot', [AuthController::class, 'forgotPassword'])->name('forgot');
    });

    // Routes for authenticated users only
    Route::group(['middleware' => ['auth.user', 'auth.user.inactive.logout']], function () {
        Route::get('profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('personal-info', [AuthController::class, 'personalInfo'])->name('personal-info');
        Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password');
        Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
        Route::post('do-reset-password', [AuthController::class, 'doResetPassword'])->name('do-reset-password');
        Route::post('redeem-code', [AuthController::class, 'redeemCode'])->name('redeem-code');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
