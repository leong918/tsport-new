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
}
