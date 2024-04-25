<?php

use App\Http\Controllers\Admin\EmailContentController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'email_content.'], function () {
    Route::get('email_content/index', [EmailContentController::class, 'index'])->name('index');
    Route::get('email_content/create', [EmailContentController::class, 'create'])->name('create');
    Route::post('email_content/create', [EmailContentController::class, 'store'])->name('create.post');
    Route::get('email_content/update/{id}', [EmailContentController::class, 'edit'])->name('update');
    Route::put('email_content/update/{id}', [EmailContentController::class, 'update'])->name('update.put');
    Route::delete('email_content/delete/{id}', [EmailContentController::class, 'destroy'])->name('destroy.delete');
    Route::get('email_content/send_mail/{id}', [EmailContentController::class, 'sendMail'])->name('sendMail');
});
