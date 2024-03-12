<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Brand; // Assuming Navigation is your model
use App\Models\Category; 

class LoadHeaderData
{
    public function handle($request, Closure $next)
    {
        // Fetch navigation data from the database
        $brand_list = Brand::where('status',1)->selectRaw('name,id')->get();
        $all_category_list = Category::where('status', 1)->whereNull('parent_category_id')->orderBy('sort', 'asc')->get();

        // Share navigation data with all views
        View::share('brand_list', $brand_list);
        View::share('all_category_list', $all_category_list);

        return $next($request);
    }
}