<?php
$pluginRepository = new \App\Repositories\PluginRepository(new \Illuminate\Container\Container);

if ($pluginRepository->getActivePlugin('SalesOrder')) {
    $this->loadRoutesFrom(__DIR__ . '/Route.php');
    $this->loadViewsFrom(__DIR__ . '/Views', 'sales_order');

    if (!function_exists('salesOrderRenderView')) {
        function salesOrderRenderView($blade_name)
        {
            return view("sales_order::web." . $blade_name);
        }
    }
}
