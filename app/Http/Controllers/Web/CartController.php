<?php

namespace App\Http\Controllers\Web;

class CartController extends BaseController
{
    public function cart()
    {
        return $this->view('cart.cart');
    }
    public function wishlist()
    {
        return $this->view('cart.wishlist');
    }
    public function checkout()
    {
        return $this->view('cart.checkout');
    }
    public function payment()
    {
        return $this->view('cart.payment');
    }
    public function complete()
    {
        return $this->view('cart.complete');
    }
}
