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
        $user_data = auth()->user() ? auth()->user()->id : getPublicIp();
        $type = auth()->user() ? 'login' : 'guest';
        $cartList = $this->userCartRepository->getUserCartByType($user_data, $type);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($cartList);

        return view('sales_order::web.cart.cart', compact('cartList', 'cartTotal'));
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $data['user_ip'] = getPublicIP();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;

        $this->userCartRepository->addToCart($data);

        $user_data = auth()->user() ? auth()->user()->id : getPublicIp();
        $type = auth()->user() ? 'login' : 'guest';
        $cart_count = $this->userCartRepository->getUserCartByType($user_data, $type)->count();

        return $this->response(['cart_count' => $cart_count], 'OK');
    }

    public function updateCartQty(Request $request)
    {
        $data = $request->all();
        $subtotal = $this->userCartRepository->updateCartQty($data);

        // refetch user cart total
        $user_data = auth()->user() ? auth()->user()->id : getPublicIp();
        $type = auth()->user() ? 'login' : 'guest';
        $cartList = $this->userCartRepository->getUserCartByType($user_data, $type);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($cartList);

        return $this->response(['subtotal' => number_format($subtotal, 2)], 'OK');
    }

    public function wishlist()
    {
        return view('sales_order::web.cart.wishlist');
    }

    public function checkout()
    {
        return view('sales_order::web.cart.checkout');
    }

    public function payment()
    {
        return view('sales_order::web.cart.payment');
    }

    public function complete()
    {
        return view('sales_order::web.cart.complete');
    }
}
