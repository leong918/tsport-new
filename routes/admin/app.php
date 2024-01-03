<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth.admin.authenticated'], function () {
        Route::redirect('/', 'admin/login');
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'doLogin'])->name('login.post')->middleware('captcha');
    });
});
