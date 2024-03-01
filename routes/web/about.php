<?php

use App\Http\Controllers\Web\AboutController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'about'], function () {
    Route::get('about/contact', [AboutController::class, 'aboutContact'])->name('about.contact');
    Route::get('about/membership', [AboutController::class, 'aboutMembership'])->name('about.membership');
    Route::get('about/points', [AboutController::class, 'aboutPoint'])->name('about.points');
    Route::get('about/shipping', [AboutController::class, 'aboutShipping'])->name('about.shipping');
    Route::get('about/tnc', [AboutController::class, 'aboutTnc'])->name('about.tnc');
    Route::get('about', [AboutController::class, 'about'])->name('about.index');
});
