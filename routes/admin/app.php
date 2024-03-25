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
        require_once 'plugin.php';
        require_once 'brand.php';
        require_once 'category.php';
        require_once 'product.php';
        require_once 'currency.php';
        require_once 'blog.php';
        require_once 'user.php';
        require_once 'tag.php';
        require_once 'verification.php';
        require_once 'setting.php';
        require_once 'top_bar.php';
    });
});
