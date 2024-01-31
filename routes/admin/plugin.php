<?php

use App\Http\Controllers\Admin\PluginController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'plugin.'], function () {
    Route::get('plugin', [PluginController::class, 'index'])->name('index');
    Route::post('plugin/install', [PluginController::class, 'install'])->name('install');
});
