<?php

use App\Plugins\SalesOrder\Web\CartController;
use App\Plugins\SalesOrder\Admin\SalesOrderController;
use App\Plugins\SalesOrder\Admin\CartRuleController;
use App\Plugins\SalesOrder\API\StripeController;
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
        Route::post('toggle_wishlist', [CartController::class, 'toggleWishlist'])->name('cart.toggle_wishlist');
        Route::post('remove_wishlist', [CartController::class, 'removeWishlist'])->name('cart.remove_wishlist');
        Route::get('wishlist', [CartController::class, 'wishlist'])->name('cart.wishlist');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('apply_point', [CartController::class, 'applyPoint'])->name('cart.apply_point');
        Route::post('remove_point', [CartController::class, 'removePoint'])->name('cart.remove_point');
        Route::post('get_shipping_fee', [CartController::class, 'getShippingFee'])->name('cart.get_shipping_fee');
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
        Route::get('sales_order/update/{id}', [SalesOrderController::class, 'edit'])->name('update');
        Route::post('sales_order/update/{id}', [SalesOrderController::class, 'update'])->name('update.put');
        Route::post('sales_order/update_product/{id}/{product_id?}', [SalesOrderController::class, 'updateProduct'])->name('updateProduct.put');
        Route::delete('sales_order/delete_product/{id}/{product_id}', [SalesOrderController::class, 'destroySalesOrderProduct'])->name('destroy.deleteProduct');
        Route::delete('sales_order/delete/{id}', [SalesOrderController::class, 'destroy'])->name('destroy.delete');
        Route::post('sales_order/deleteByList', [SalesOrderController::class, 'destroyByList'])->name('deleteByList');
        Route::get('exportByList', [SalesOrderController::class, 'exportByList'])->name('exportByList');
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

/**
 * Route api
 */
Route::group(['prefix' => 'stripe'], function () {
    Route::post("/webhook", [StripeController::class, 'webhook']);
});
