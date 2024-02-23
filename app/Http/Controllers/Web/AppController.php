<?php

namespace App\Http\Controllers\Web;

class AppController extends BaseController
{
    public function index()
    {
        return $this->view('index');
    }
    public function product()
    {
        return $this->view('product');
    }
    public function productDetail()
    {
        return $this->view('product_detail');
    }
    public function productNew()
    {
        return $this->view('product_new');
    }
    public function bestSeller()
    {
        return $this->view('best_seller');
    }
    public function brand()
    {
        return $this->view('brand');
    }
    public function blog()
    {
        return $this->view('blog');
    }
    public function blogDetail()
    {
        return $this->view('blog_detail');
    }
    public function voucher()
    {
        return $this->view('voucher');
    }
    public function howTo()
    {
        return $this->view('how_to');
    }
    public function search()
    {
        return $this->view('search_result');
    }
}
