<?php
$pluginRepository = new \App\Repositories\PluginRepository(new \Illuminate\Container\Container);

if ($pluginRepository->getActivePlugin('SalesOrder')) {
    $this->loadRoutesFrom(__DIR__ . '/Route.php');
    $this->loadViewsFrom(__DIR__ . '/Views', 'sales_order');

    if (!function_exists('salesOrderRenderView')) {
        function salesOrderRenderView($blade_name, $product = null)
        {
            return view("sales_order::web." . $blade_name, compact('product'));
        }
    }

    if (!function_exists('updateUserOwnerCart')) {
        function updateUserOwnerCart($user_id, $coupon_session)
        {
            $userCartRepository = new \App\Plugins\SalesOrder\Repositories\UserCartRepository(new \Illuminate\Container\Container);

            $user_ip = getPublicIp();
            $userCartRepository->updateOwnerCartByIp($user_id, $user_ip);

            if (count($coupon_session) > 0) {
                session(['coupon-' . $user_id => $coupon_session]);
            }
        }
    }
}
