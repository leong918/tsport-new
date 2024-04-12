<?php
    $pluginRepository = new \App\Repositories\PluginRepository(new \Illuminate\Container\Container);

    if ($pluginRepository->getActivePlugin('ProductReview')) {
        $this->loadRoutesFrom(__DIR__.'/Route.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'product_review');

        if (!function_exists('reviewRenderView')) {
            function reviewRenderView($blade_name, $product = null, $review_list = null, $review_total = null, $avgRating = null)
            {
                return view("product_review::web." . $blade_name, compact('product', 'review_list', 'review_total', 'avgRating'));
            }
        }
    }