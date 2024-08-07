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
    Route::get('/event', [AppController::class, 'event'])->name('web.event');
    Route::get('/event_details/{id}', [AppController::class, 'eventDetails'])->name('web.event_details');
    Route::get('/contact-us', [AppController::class, 'contactUs'])->name('web.contact-us');
    Route::post('/send-contact', [AppController::class, 'sendContact'])->name('web.send-contact')->middleware('captcha');
    Route::get('/programme/healthy-teeth-collaboration', [AppController::class, 'programme'])->name('web.programme');
    Route::get('/blog', [AppController::class, 'blog'])->name('web.blog');
    Route::get('/blog-details/{id}', [AppController::class, 'blogDetails'])->name('web.blog_details');
});
