<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('get_captcha', function (\Mews\Captcha\Captcha $captcha) {
    return $captcha->src('flat');
})->name('captcha');

Route::group(['middleware' => ['web']], function () {
    require_once 'web/app.php';
    require_once 'admin/app.php';
});
