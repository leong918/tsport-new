<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'setting.'], function () {
    Route::get('setting/index', [SettingController::class, 'index'])->name('index');
    Route::post('setting/updateMainSlider', [SettingController::class, 'updateMainSlider'])->name('updateMainSlider.post');
    Route::post('setting/updateSubSlider', [SettingController::class, 'updateSubSlider'])->name('updateSubSlider.post');
    Route::post('setting/updateSectionRight', [SettingController::class, 'updateSectionRight'])->name('updateSectionRight.post');
    Route::post('setting/updateSectionLeft', [SettingController::class, 'updateSectionLeft'])->name('updateSectionLeft.post');
    Route::post('setting/updateSectionCenter', [SettingController::class, 'updateSectionCenter'])->name('updateSectionCenter.post');
    Route::post('setting/updateSectionRecommended', [SettingController::class, 'updateSectionRecommended'])->name('updateSectionRecommended.post');
    Route::delete('setting/delete/{id}', [SettingController::class, 'destroy'])->name('destroy.delete');
});
