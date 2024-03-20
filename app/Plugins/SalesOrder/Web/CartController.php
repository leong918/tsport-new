<?php

namespace App\Plugins\SalesOrder\Web;

use App\Plugins\SalesOrder\Repositories\UserCartRepository;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class CartController extends BaseController
{
    private UserCartRepository $userCartRepository;
    private CountryRepository $countryRepository;
    private UserRepository $userRepository;

    public function __construct(
        UserCartRepository $userCartRepository,
        CountryRepository $countryRepository,
        UserRepository $userRepository
    ) {
        $this->userCartRepository = $userCartRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
    }

    public function cart()
    {
        $user_data = $this->getUserDataAndType();
        $cartList = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($cartList);

        return view('sales_order::web.cart.cart', compact('cartList', 'cartTotal'));
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $data['user_ip'] = getPublicIP();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;

        $this->userCartRepository->addToCart($data);

        $user_data = $this->getUserDataAndType();
        $cart_count = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type'])->count();

        return $this->response(['cart_count' => $cart_count], 'OK');
    }

    public function updateCartQty(Request $request)
    {
        $data = $request->all();
        $subtotal = $this->userCartRepository->updateCartQty($data);

        // refetch user cart total
        $user_data = $this->getUserDataAndType();
        $cartList = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($cartList);

        return $this->response(['subtotal' => number_format($subtotal, 2)], 'OK');
    }

    public function wishlist()
    {
        return view('sales_order::web.cart.wishlist');
    }

    public function checkout(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        $cart_count = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type'])->count();

        if ($cart_count <= 0) {
            return redirect()->route('cart.shopping_cart');
        }

        $addressData = $request->session()->get('cart-' . auth()->user()->id);
        if (!$addressData) {
            $addressData = $this->userRepository->getAddressData(auth()->user()->id);
        }

        $countryList = $this->countryRepository->getListing();
        return view('sales_order::web.cart.checkout', compact('countryList', 'addressData'));
    }

    public function processCheckout(Request $request)
    {
        $data = $request->all();
        session(['cart-' . auth()->user()->id => $data]);

        return redirect()->route('cart.payment');
    }

    public function payment(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        $cart_count = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type'])->count();

        if ($cart_count <= 0) {
            return redirect()->route('cart.shopping_cart');
        }

        if (!$request->session()->get('cart-' . auth()->user()->id)) {
            return redirect()->route('cart.checkout');
        }

        $address = $request->session()->get('cart-' . auth()->user()->id);
        return view('sales_order::web.cart.payment', compact('address'));
    }

    public function createPaymentIntent(Request $request)
    {
    }

    public function complete()
    {
        return view('sales_order::web.cart.complete');
    }

    private function getUserDataAndType()
    {
        $data['user_data'] = auth()->user() ? auth()->user()->id : getPublicIp();
        $data['type'] = auth()->user() ? 'login' : 'guest';

        return $data;
    }
}
