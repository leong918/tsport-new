<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web', 'prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', [AppController::class, 'index'])->name('web.home');
    Route::get('/about-us', [AppController::class, 'aboutUs'])->name('web.about-us');
    Route::get('/mission-vision-value', [AppController::class, 'mission'])->name('web.mission');
    Route::get('/our-partners', [AppController::class, 'ourPartner'])->name('web.our-partner');
    Route::get('/founder', [AppController::class, 'founder'])->name('web.founder');
    Route::get('/what-do-we-do', [AppController::class, 'whatDoWeDo'])->name('web.what-do-we-do');
});
