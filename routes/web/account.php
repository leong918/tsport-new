<?php

use App\Http\Controllers\Web\AccountController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'account'], function () {
    Route::get('account/info', [AccountController::class, 'accountDetails'])->name('account.details');
    Route::get('account/addresses', [AccountController::class, 'accountAddress'])->name('account.address');
    Route::get('account/order', [AccountController::class, 'accountOrder'])->name('account.order');
    Route::get('account/order_detail/{id}', [AccountController::class, 'accountOrderDetail'])->name('account.order_detail');
    Route::get('account/point', [AccountController::class, 'accountPoints'])->name('account.point');
    Route::put('account/update/{id}', [AccountController::class, 'doUpdateUserAccount'])->name('account.updateUser');
    Route::put('account/update_address/{id}', [AccountController::class, 'doUpdateUserAddress'])->name('account.updateAddress');
});
