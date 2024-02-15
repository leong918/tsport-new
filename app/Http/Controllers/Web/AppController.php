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
    public function about()
    {
        return $this->view('about');
    }
    public function aboutContact()
    {
        return $this->view('about_contact');
    }
    public function aboutMembership()
    {
        return $this->view('about_membership');
    }
    public function aboutPoint()
    {
        return $this->view('about_points');
    }
    public function aboutShipping()
    {
        return $this->view('about_shipping');
    }
    public function aboutTnc()
    {
        return $this->view('about_tnc');
    }
}
