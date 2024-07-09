<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends BaseController
{

    public function __construct() {}

    public function index()
    {
        // $slider_list = $this->sliderRepository->getListing()->get();
        // $setting_list = $this->settingRepository->getListing()->get();
        // $blog_list = $this->blogRepository->getListing()->get();
        // $brand_list = $this->brandRepository->getListing()->where('status', 1)->get();
        // $more_discover_category_list = $this->categoryRepository->getMoreToDiscoverListing();

        // return $this->view('index', compact('slider_list', 'setting_list', 'blog_list', 'brand_list', 'more_discover_category_list'));
        return $this->view('index');
    }
}
