<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'about'], function () {
    Route::get('/about/contact', [AppController::class, 'aboutContact'])->name('about.contact');
    Route::get('/about/membership', [AppController::class, 'aboutMembership'])->name('about.membership');
    Route::get('/about/points', [AppController::class, 'aboutPoint'])->name('about.points');
    Route::get('/about/shipping', [AppController::class, 'aboutShipping'])->name('about.shipping');
    Route::get('/about/tnc', [AppController::class, 'aboutTnc'])->name('about.tnc');
    Route::get('/about', [AppController::class, 'about'])->name('about.index');
});
