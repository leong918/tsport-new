<?php
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('web.login');
    Route::post('login', [AuthController::class, 'doLogin'])->name('web.doLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('web.logout');
    Route::get('register', [AuthController::class, 'register'])->name('web.register');
    Route::post('register', [AuthController::class, 'doRegister'])->name('web.doRegister');
    Route::get('forgot_password', [AuthController::class, 'forgotPassword'])->name('web.forgot_password');
});
