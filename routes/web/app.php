<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web', 'prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('/about-us', [AppController::class, 'aboutUs'])->name('web.about-us');
    Route::get('/mission', [AppController::class, 'mission'])->name('web.mission');
    Route::get('/event', [AppController::class, 'event'])->name('web.event');
    Route::get('/event_details/{slug}', [AppController::class, 'eventDetails'])->name('web.event_details');
    Route::get('/contact-us', [AppController::class, 'contactUs'])->name('web.contact-us');
    Route::post('/send-contact', [AppController::class, 'sendContact'])->name('web.send-contact');
});
