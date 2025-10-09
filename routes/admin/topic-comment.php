<?php

use App\Http\Controllers\Admin\TopicCommentController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'topic-comment.'], function () {
    Route::post('topic/comment/status/{id}', [TopicCommentController::class, 'toggleStatus'])->name('status.post');
    Route::get('topic/comment/update/{id}', [TopicCommentController::class, 'edit'])->name('update');
    Route::put('topic/comment/update/{id}', [TopicCommentController::class, 'update'])->name('update.put');
    Route::delete('topic/comment/delete/{id}', [TopicCommentController::class, 'destroy'])->name('destroy.delete');
});
