<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TopBarRepository;

class LoadHeaderData
{
    private BrandRepository $brandRepository;
    private CategoryRepository $categoryRepository;
    private TopBarRepository $topBarRepository;

    public function __construct(
        BrandRepository $brandRepository,
        CategoryRepository $categoryRepository,
        TopBarRepository $topBarRepository,
    ) {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->topBarRepository = $topBarRepository;
    }

    public function handle($request, Closure $next)
    {
        // Fetch navigation data from the database
        $sidebar_brand_list = $this->brandRepository->getListingForNav();
        $sidebar_category_list = $this->categoryRepository->getListingForNav();
        $top_bar = $this->topBarRepository->getListing()->where('status', 1)->first();

        // Share navigation data with all views
        View::share('sidebar_brand_list', $sidebar_brand_list);
        View::share('top_bar', $top_bar);
        View::share('sidebar_category_list', $sidebar_category_list);

        return $next($request);
    }
}
