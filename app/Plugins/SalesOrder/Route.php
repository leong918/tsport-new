<?php

use App\Plugins\SalesOrder\Admin\SalesOrderController;
use Illuminate\Support\Facades\Route;

/**
 * Route admin
 */
Route::group(['as' => 'admin.sales_order.', 'prefix' => 'admin'], function () {
    Route::get('sales_order/index', [SalesOrderController::class, 'index'])->name('index');
    Route::delete('sales_order/delete/{id}', [SalesOrderController::class, 'destroy'])->name('destroy.delete');
    Route::post('sales_order/status/{id}', [SalesOrderController::class, 'toggleStatus'])->name('status.post');
});
