<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\LiveMatchController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'web.', 'namespace' => 'Web'], function () {
    // Public routes accessible to everyone
    Route::get('', [AppController::class, 'index'])->name('home');
    Route::get('matches', [AppController::class, 'matches'])->name('matches');
    Route::get('event', [AppController::class, 'events'])->name('events');
    Route::get('predict', [AppController::class, 'predict'])->name('predict');
    Route::get('predict/expert/{expert}', [AppController::class, 'predictByExpert'])->name('predict.expert');
    
    // Routes for authenticated users only - place before wildcard routes
    Route::group(['middleware' => ['auth.user', 'auth.user.inactive.logout']], function () {
        Route::post('predict/{id}/comment', [AppController::class, 'addPredictComment'])->name('predict.comment.add');
        Route::post('comment/{id}/like', [AppController::class, 'likePredictComment'])->name('predict.comment.like');
        Route::post('predict/{id}/like', [AppController::class, 'likePrediction'])->name('predict.like');
        Route::get('predict/{id}/like-stats', [AppController::class, 'getPredictionLikeStats'])->name('predict.like.stats');
        
        // Utility routes for syncing like counts (admin/maintenance)
        Route::post('admin/sync-predict-likes', [AppController::class, 'syncPredictLikeCounts'])->name('admin.sync.predict.likes');
        Route::post('admin/sync-comment-likes', [AppController::class, 'syncCommentLikeCounts'])->name('admin.sync.comment.likes');
    });
    
    // This should be last among predict routes to avoid conflicts
    Route::get('predict/{id}', [AppController::class, 'predictDetail'])->name('predict.detail');

    Route::get('live/{id?}', [AppController::class, 'live'])->name('live');
    
    // Live streaming API routes
    Route::get('live/{id}/viewer-count', [AppController::class, 'getLiveViewerCount'])->name('live.viewer-count');
    Route::get('live/{id}/status', [AppController::class, 'getLiveStatus'])->name('live.status');
    
    // Live match comment routes (require authentication)
    Route::group(['middleware' => ['auth.user', 'auth.user.inactive.logout']], function () {
        Route::post('live/{id}/comment', [AppController::class, 'addLiveComment'])->name('live.comment.add');
    });

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
