<?php

use App\Plugins\SalesOrder\Web\CartController;
use App\Plugins\SalesOrder\Admin\SalesOrderController;
use App\Plugins\SalesOrder\Admin\CartRuleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    /**
     * Route web
     */
    Route::group(['namespace' => 'cart'], function () {
        Route::get('cart', [CartController::class, 'cart'])->name('cart.shopping_cart');
        Route::post('add_to_cart', [CartController::class, 'addToCart'])->name('cart.add_to_cart');
        Route::post('update_cart_qty', [CartController::class, 'updateCartQty'])->name('cart.update_cart_qty');
        Route::post('apply_coupon', [CartController::class, 'applyCoupon'])->name('cart.apply_coupon');
        Route::post('remove_coupon', [CartController::class, 'removeCoupon'])->name('cart.remove_coupon');
        Route::get('wishlist', [CartController::class, 'wishlist'])->name('cart.wishlist');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('process_checkout', [CartController::class, 'processCheckout'])->name('cart.process_checkout');
        Route::get('payment', [CartController::class, 'payment'])->name('cart.payment');
        Route::post('create_payment_intent', [CartController::class, 'createPaymentIntent'])->name('cart.create_payment_intent');
        Route::post('create_order', [CartController::class, 'createOrder'])->name('cart.create_order');
        Route::get('complete', [CartController::class, 'complete'])->name('cart.complete');
    });

    /**
     * Route admin
     */
    Route::group(['as' => 'admin.sales_order.', 'prefix' => 'admin'], function () {
        Route::get('sales_order/index', [SalesOrderController::class, 'index'])->name('index');
        Route::delete('sales_order/delete/{id}', [SalesOrderController::class, 'destroy'])->name('destroy.delete');
        Route::post('sales_order/status/{id}', [SalesOrderController::class, 'toggleStatus'])->name('status.post');
    });

    Route::group(['as' => 'admin.cart_rule.', 'prefix' => 'admin'], function () {
        Route::get('cart_rule/index', [CartRuleController::class, 'index'])->name('index');
        Route::get('cart_rule/create', [CartRuleController::class, 'create'])->name('create');
        Route::post('cart_rule/create', [CartRuleController::class, 'store'])->name('create.post');
        Route::get('cart_rule/update/{id}', [CartRuleController::class, 'edit'])->name('update');
        Route::put('cart_rule/update/{id}', [CartRuleController::class, 'update'])->name('update.put');
        Route::delete('cart_rule/delete/{id}', [CartRuleController::class, 'destroy'])->name('destroy.delete');
        Route::post('cart_rule/status/{id}', [CartRuleController::class, 'toggleStatus'])->name('status.post');
    });
});
