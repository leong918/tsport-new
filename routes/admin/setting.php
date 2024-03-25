<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'setting.'], function () {
    Route::get('setting/homepage_index', [SettingController::class, 'homepageIndex'])->name('homepage_index');
    Route::get('setting/global_index', [SettingController::class, 'globalIndex'])->name('global_index');
    Route::post('setting/updateSlider', [SettingController::class, 'updateSlider'])->name('updateSlider.post');
    Route::post('setting/updateHomepageSetting', [SettingController::class, 'updateHomepageSetting'])->name('updateHomepageSetting.post');
    Route::post('setting/updateGlobalSetting', [SettingController::class, 'updateGlobalSetting'])->name('updateGlobalSetting.post');
    Route::delete('setting/delete/{id}', [SettingController::class, 'destroy'])->name('destroy.delete');
});
