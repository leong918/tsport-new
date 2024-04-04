<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'setting.'], function () {
    Route::get('setting/homepage_index', [SettingController::class, 'homepageIndex'])->name('homepage_index');
    Route::get('setting/global_index', [SettingController::class, 'globalIndex'])->name('global_index');
    Route::get('setting/about_index', [SettingController::class, 'aboutIndex'])->name('about_index');
    Route::get('setting/about_membership', [SettingController::class, 'aboutMembership'])->name('about_membership');
    Route::get('setting/about_contact', [SettingController::class, 'aboutContact'])->name('about_contact');
    Route::get('setting/about_tnc', [SettingController::class, 'aboutTnc'])->name('about_tnc');
    Route::get('setting/about_shipping', [SettingController::class, 'aboutShipping'])->name('about_shipping');
    Route::post('setting/updateAbout', [SettingController::class, 'updateAbout'])->name('updateAbout.post');
    Route::post('setting/updateAboutMembership', [SettingController::class, 'updateAboutMembership'])->name('updateAboutMembership.post');
    Route::post('setting/updateAboutContact', [SettingController::class, 'updateAboutContact'])->name('updateAboutContact.post');
    Route::post('setting/updateAboutTnc', [SettingController::class, 'updateAboutTnc'])->name('updateAboutTnc.post');
    Route::post('setting/updateAboutShipping', [SettingController::class, 'updateAboutShipping'])->name('updateAboutShipping.post');
    Route::post('setting/updateFaqBanner', [SettingController::class, 'updateFaqBanner'])->name('updateFaqBanner.post');
    Route::post('setting/updateSlider', [SettingController::class, 'updateSlider'])->name('updateSlider.post');
    Route::post('setting/updateHomepageSetting', [SettingController::class, 'updateHomepageSetting'])->name('updateHomepageSetting.post');
    Route::post('setting/updateGlobalSetting', [SettingController::class, 'updateGlobalSetting'])->name('updateGlobalSetting.post');
    Route::delete('setting/delete/{id}', [SettingController::class, 'destroy'])->name('destroy.delete');
});
