<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth.admin.authenticated'], function () {
        Route::redirect('/', 'admin/login');
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'doLogin'])->name('login.post')->middleware('captcha');
    });

    Route::group(['middleware' => ['auth.admin', 'auth.admin.inactive.logout']], function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        require_once 'admin.php';
        require_once 'blog.php';
        require_once 'topic.php';
        require_once 'topic-comment.php';
        require_once 'match.php';
        require_once 'predict.php';
        require_once 'predict-comment.php';
        require_once 'event.php';
    });
});
