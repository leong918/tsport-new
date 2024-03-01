<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Brand; // Assuming Navigation is your model

class LoadHeaderData
{
    public function handle($request, Closure $next)
    {
        // Fetch navigation data from the database
        $brand_list = Brand::where('status',1)->selectRaw('name,id')->get();

        // Share navigation data with all views
        View::share('brand_list', $brand_list);

        return $next($request);
    }
}