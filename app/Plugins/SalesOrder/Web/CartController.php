<?php

namespace App\Plugins\SalesOrder\Web;

use App\Plugins\SalesOrder\Repositories\UserCartRepository;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderProductRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderLogRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderTotalRepository;
use App\Plugins\SalesOrder\Repositories\CartRuleRepository;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController
{
    private UserCartRepository $userCartRepository;
    private CountryRepository $countryRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;
    private SalesOrderRepository $salesOrderRepository;
    private SalesOrderProductRepository $salesOrderProductRepository;
    private SalesOrderLogRepository $salesOrderLogRepository;
    private SalesOrderTotalRepository $salesOrderTotalRepository;
    private CartRuleRepository $cartRuleRepository;

    public function __construct(
        UserCartRepository $userCartRepository,
        CountryRepository $countryRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        SalesOrderRepository $salesOrderRepository,
        SalesOrderProductRepository $salesOrderProductRepository,
        SalesOrderLogRepository $salesOrderLogRepository,
        SalesOrderTotalRepository $salesOrderTotalRepository,
        CartRuleRepository $cartRuleRepository
    ) {
        $this->userCartRepository = $userCartRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->salesOrderRepository = $salesOrderRepository;
        $this->salesOrderProductRepository = $salesOrderProductRepository;
        $this->salesOrderLogRepository = $salesOrderLogRepository;
        $this->salesOrderTotalRepository = $salesOrderTotalRepository;
        $this->cartRuleRepository = $cartRuleRepository;
    }

    public function cart(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $cartList = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user() ? auth()->user()->id : null);

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
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id);

        return $this->response(['subtotal' => number_format($subtotal, 2), 'cartTotal' => $cartTotal], 'OK');
    }

    public function applyCoupon(Request $request)
    {
        $coupon = $this->cartRuleRepository->getCouponByCode($request->coupon);
        if (!$coupon) {
            return response()->json(['msg' => 'Coupon Not Found!'], 500);
        }

        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        array_push($coupon_session, $coupon->id);
        session(['coupon-' . $user_data['user_data'] => $coupon_session]);

        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function removeCoupon(Request $request)
    {
        $coupon_id = $request->coupon_id;
        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();

        if (($key = array_search($coupon_id, $coupon_session)) !== false) {
            unset($coupon_session[$key]);
        }
        session(['coupon-' . $user_data['user_data'] => $coupon_session]);

        $addressData = $request->session()->get('cart-' . $user_data['user_data']) ?? null;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id, $addressData);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
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
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id, $addressData);
        return view('sales_order::web.cart.checkout', compact('countryList', 'addressData', 'cartTotal'));
    }

    public function updateAddress(Request $request)
    {
        $data = $request->all();
        session(['cart-' . auth()->user()->id => $data['data']]);

        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id, $data['data']);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
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
            return redirect(route('cart.shopping_cart'));
        }

        if (!$request->session()->get('cart-' . auth()->user()->id)) {
            return redirect(route('cart.checkout'))->with('swal_error', 'Session Expired! Please confirm your address again.');
        }

        try {
            // refetch user cart total
            $user_data = $this->getUserDataAndType();
            $addressData = $request->session()->get('cart-' . auth()->user()->id);
            $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
            $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id, $addressData);
            $intentSecret = json_encode($this->createPaymentIntent($cartTotal['total']));

            return view('sales_order::web.cart.payment', compact('addressData', 'intentSecret', 'cartTotal'));
        } catch (\Exception $e) {
            return redirect(route('cart.checkout'))->with('swal_error', $e->getMessage());
        }
    }

    private function createPaymentIntent($cartTotal)
    {
        $total_amount = str_replace('.', '', number_format($cartTotal, 2));
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $total_amount,
            'currency' => 'hkd'
        ]);

        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];

        return $output;
    }

    public function createOrder(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        $user_cart = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
        $addressData = $request->session()->get('cart-' . auth()->user()->id);
        $coupon_session = $request->session()->get('coupon-' . auth()->user()->id) ?? array();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, auth()->user()->id, $addressData);

        //do checking check total is same or not, if not same need redirect back
        if ($request->cart_total != $cartTotal['total']) {
            session()->flash('swal_error', 'Cart total is different, please refer latest price');
            return response()->json(['msg' => null, 'redirect' => true], 500);
        }

        // refresh the page again to trigger error or generate new payment intent id
        if ($user_cart->count() <= 0 || !$request->session()->get('cart-' . auth()->user()->id)) {
            return response()->json(['msg' => null, 'redirect' => true], 500);
        }

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data['address'] = $request->session()->get('cart-' . auth()->user()->id);
            $order = $this->salesOrderRepository->getOrderByPaymentIntentId($data['stripe_payment_intent_id']['clientSecret']);
            
            if (!$order) {
                $data['point_earned'] = $this->productRepository->calculatePointEarned($user_cart);
                $order = $this->salesOrderRepository->createOrder($data, $cartTotal);
                $this->salesOrderProductRepository->createOrderProduct($order, $user_cart);
                $this->salesOrderTotalRepository->createOrderTotal($order, $cartTotal);
                $this->userRepository->deductFullPoint($order);

                $description = 'New Order';
                $this->salesOrderLogRepository->createLog($order, $data['user_id'], 'user', 0, $description);
            }

            DB::commit();
            return response()->json(['order' => $order], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e->getMessage(), 'redirect' => false], 500);
        }
    }

    public function complete(Request $request)
    {
        $product_list = $this->productRepository->getListing()->take(8)->get();
        $order_id = $request->order_id;
        $sales_order = $this->salesOrderRepository->getSalesOrderId($order_id);

        if ($request->payment_intent_client_secret) {
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
            $paymentIntent = $stripe->paymentIntents->retrieve($request->payment_intent, []);

            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->route('web.home')->with('swal_error', 'Your order currently in status - ' . $paymentIntent->status . '. Please contact admin for more enquiry.');
            }
        }

        if (!$sales_order || $sales_order->user_id != auth()->user()->id) {
            return redirect()->route('web.home')->with('swal_error', 'Order Not Found!');
        }

        return view('sales_order::web.cart.complete', compact('sales_order', 'product_list'));
    }

    private function getUserDataAndType()
    {
        $data['user_data'] = auth()->user() ? auth()->user()->id : getPublicIp();
        $data['type'] = auth()->user() ? 'login' : 'guest';

        return $data;
    }
}
