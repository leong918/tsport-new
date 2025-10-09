<?php

use App\Http\Controllers\Admin\TopicController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'topic.'], function () {
    Route::get('topic/index', [TopicController::class, 'index'])->name('index');
    Route::get('topic/create', [TopicController::class, 'create'])->name('create');
    Route::post('topic/create', [TopicController::class, 'store'])->name('create.post');
    Route::get('topic/update/{id}', [TopicController::class, 'edit'])->name('update');
    Route::put('topic/update/{id}', [TopicController::class, 'update'])->name('update.put');
    Route::delete('topic/delete/{id}', [TopicController::class, 'destroy'])->name('destroy.delete');
    Route::post('topic/status/{id}', [TopicController::class, 'toggleStatus'])->name('status.post');

    // Comment
    Route::post('topic/comment/status/{id}', [TopicController::class, 'toggleCommentStatus'])->name('comment.status.post');
    Route::get('topic/comment/update/{id}', [TopicController::class, 'editComment'])->name('comment.update');
    Route::put('topic/comment/update/{id}', [TopicController::class, 'updateComment'])->name('comment.update.put');
    Route::delete('topic/comment/delete/{id}', [TopicController::class, 'destroyComment'])->name('comment.destroy.delete');
});
