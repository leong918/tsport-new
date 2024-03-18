<?php

namespace App\Plugins\SalesOrder\Web;

use App\Plugins\SalesOrder\Repositories\UserCartRepository;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    private UserCartRepository $userCartRepository;

    public function __construct(UserCartRepository $userCartRepository)
    {
        $this->userCartRepository = $userCartRepository;
    }

    public function cart()
    {
        return $this->view('cart.cart');
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $data['user_ip'] = getPublicIP();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;

        $this->userCartRepository->addToCart($data);
        $cart_count = $this->userCartRepository->countCartByItem($data);

        return $this->response(['cart_count' => $cart_count], 'OK');
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
