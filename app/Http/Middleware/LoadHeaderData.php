<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;

class LoadHeaderData
{
    private BrandRepository $brandRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        BrandRepository $brandRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function handle($request, Closure $next)
    {
        // Fetch navigation data from the database
        $sidebar_brand_list = $this->brandRepository->getListingForNav();
        $sidebar_category_list = $this->categoryRepository->getListingForNav();

        // Share navigation data with all views
        View::share('sidebar_brand_list', $sidebar_brand_list);
        View::share('sidebar_category_list', $sidebar_category_list);

        return $next($request);
    }
}
