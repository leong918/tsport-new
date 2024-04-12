<?php

namespace App\Plugins\SalesOrder\Web;

use App\Plugins\SalesOrder\Repositories\UserCartRepository;
use App\Plugins\SalesOrder\Repositories\WishlistRepository;
use App\Plugins\ProductReview\Repositories\ProductReviewRepository;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PointLogRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderProductRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderLogRepository;
use App\Plugins\SalesOrder\Repositories\SalesOrderTotalRepository;
use App\Plugins\SalesOrder\Repositories\CartRuleRepository;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartController extends BaseController
{
    private UserCartRepository $userCartRepository;
    private CountryRepository $countryRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;
    private PointLogRepository $pointLogRepository;
    private SalesOrderRepository $salesOrderRepository;
    private SalesOrderProductRepository $salesOrderProductRepository;
    private SalesOrderLogRepository $salesOrderLogRepository;
    private SalesOrderTotalRepository $salesOrderTotalRepository;
    private CartRuleRepository $cartRuleRepository;
    private WishlistRepository $wishlistRepository;
    private ProductReviewRepository $productReviewRepository;

    public function __construct(
        UserCartRepository $userCartRepository,
        CountryRepository $countryRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        PointLogRepository $pointLogRepository,
        SalesOrderRepository $salesOrderRepository,
        SalesOrderProductRepository $salesOrderProductRepository,
        SalesOrderLogRepository $salesOrderLogRepository,
        SalesOrderTotalRepository $salesOrderTotalRepository,
        CartRuleRepository $cartRuleRepository,
        WishlistRepository $wishlistRepository,
        ProductReviewRepository $productReviewRepository,
    ) {
        $this->userCartRepository = $userCartRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->pointLogRepository = $pointLogRepository;
        $this->salesOrderRepository = $salesOrderRepository;
        $this->salesOrderProductRepository = $salesOrderProductRepository;
        $this->salesOrderLogRepository = $salesOrderLogRepository;
        $this->salesOrderTotalRepository = $salesOrderTotalRepository;
        $this->cartRuleRepository = $cartRuleRepository;
        $this->wishlistRepository = $wishlistRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    public function cart(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartList = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null);

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
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null);
        $cart_count = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type'])->count();

        return $this->response(['subtotal' => number_format($subtotal, 2), 'cartTotal' => $cartTotal, 'cartCount' => $cart_count], 'OK');
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
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function removeCoupon(Request $request)
    {
        $coupon_id = $request->coupon_id;
        $country_data['country_id'] = $request->country_id;

        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();

        if (($key = array_search($coupon_id, $coupon_session)) !== false) {
            unset($coupon_session[$key]);
        }
        session(['coupon-' . $user_data['user_data'] => $coupon_session]);

        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $addressData = $request->session()->get('cart-' . $user_data['user_data']) ?? $country_data;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null, $addressData);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function toggleWishlist(Request $request)
    {
        $data = $request->all();

        $data['user_ip'] = getPublicIP();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;

        if ($data['user_id'] == null) {
            return response()->json(['msg' => 'Please log in before add product to wishlist!'], 500);
        }
       
        $this->wishlistRepository->toggleWishlist($data);
        $wishlist_count = $this->wishlistRepository->getWishlistByUser($data['user_id'])->count();

        return $this->response(['wishlist_count' => $wishlist_count], 'OK');
    }

    public function removeWishlist(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;
        
        $this->wishlistRepository->removeWishlist($data['user_id'], $data['product_id']);

        return $this->response(['data' => $data], 'OK');
    }

    public function wishlist(Request $request)
    {
        $data = $request->all();
        $data['user_ip'] = getPublicIP();
        $data['user_id'] = auth()->user() ? auth()->user()->id : null;

        $wishlist_record = $this->wishlistRepository->getWishlistByUser($data['user_id']);
        $wishlist_count = $wishlist_record->count();

        return view('sales_order::web.cart.wishlist', compact('wishlist_record', 'wishlist_count'));
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
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user()->id, $addressData);
        return view('sales_order::web.cart.checkout', compact('countryList', 'addressData', 'cartTotal'));
    }

    public function applyPoint(Request $request)
    {
        $country_data = $request->all();
        $user_data = $this->getUserDataAndType();
        session(['point-' . $user_data['user_data'] => true]);

        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null, $country_data);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function removePoint(Request $request)
    {
        $user_data = $this->getUserDataAndType();
        session(['point-' . $user_data['user_data'] => false]);

        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $addressData = $request->session()->get('cart-' . $user_data['user_data']) ?? $request->all();
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user() ? auth()->user()->id : null, $addressData);
        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function getShippingFee(Request $request)
    {
        $data = $request->all();
        $user_data = $this->getUserDataAndType();
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user()->id, $data);

        return $this->response(['cartTotal' => $cartTotal], 'OK');
    }

    public function processCheckout(Request $request)
    {
        $data = $request->all();
        session(['cart-' . auth()->user()->id => $data]);

        $user_data = $this->getUserDataAndType();
        $addressData = $request->session()->get('cart-' . auth()->user()->id);
        $coupon_session = $request->session()->get('coupon-' . $user_data['user_data']) ?? array();
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user()->id, $addressData);

        if ($cartTotal['total'] <= 0) {
            DB::beginTransaction();
            try {
                $data['payment_method'] = null;
                $user_cart = $this->userCartRepository->getUserCartByType($user_data['user_data'], $user_data['type']);
                $order = $this->createEmptySalesOrder($data, $user_cart, $cartTotal);
                DB::commit();
                return redirect()->route('cart.complete', ['order_id' => $order->sales_order_id]);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('swal_error', $e->getMessage());
            }
        }

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
            $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
            $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user()->id, $addressData);
            $intentSecret = json_encode($this->createPaymentIntent($cartTotal['total']));

            return view('sales_order::web.cart.payment', compact('addressData', 'intentSecret', 'cartTotal'));
        } catch (\Exception $e) {
            return redirect(route('cart.checkout'))->with('swal_error', $e->getMessage());
        }
    }

    private function createPaymentIntent($cartTotal)
    {
        $total_amount = str_replace('.', '', number_format($cartTotal, 2));
        $total_amount = str_replace(',', '', $total_amount);
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
        $point_session = $request->session()->get('point-' . $user_data['user_data']) ?? false;
        $cartTotal = $this->userCartRepository->calculateUserCartTotal($user_data, $coupon_session, $point_session, auth()->user()->id, $addressData);

        //do checking check total is same or not, if not same need redirect back
        if ($request->cart_total != $cartTotal['total']) {
            return response()->json(['msg' => 'Cart total is different, please refer latest price', 'redirect' => true], 500);
        }

        // refresh the page again to trigger error or generate new payment intent id
        if ($user_cart->count() <= 0 || !$request->session()->get('cart-' . auth()->user()->id)) {
            return response()->json(['msg' => null, 'redirect' => true], 500);
        }

        DB::beginTransaction();
        try {
            $order = $this->createEmptySalesOrder($request->all(), $user_cart, $cartTotal);
            DB::commit();
            return response()->json(['order' => $order], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['msg' => $e->getMessage(), 'redirect' => false], 500);
        }
    }

    private function createEmptySalesOrder($data, $user_cart, $cartTotal)
    {
        $order = null;
        $data['user_id'] = auth()->user()->id;
        $data['address'] = session()->get('cart-' . auth()->user()->id);

        if (isset($data['stripe_payment_intent_id'])) {
            $order = $this->salesOrderRepository->getOrderByPaymentIntentId($data['stripe_payment_intent_id']['clientSecret']);
        }

        if (!$order || $data['payment_method'] !== 'stripe') {
            $user = $this->userRepository->find($data['user_id']);
            $data['point_earned'] = $this->productRepository->calculatePointEarned($user, $user_cart);
            $data['point_used'] = 0;

            if ($cartTotal['point_redemption'] > 0 && $user->point > 0) {
                $data['point_used'] = $user->point;
                $this->userRepository->deductFullPoint($user->id);
            }

            $order = $this->salesOrderRepository->createOrder($data, $cartTotal);
            $this->salesOrderProductRepository->createOrderProduct($order, $user_cart);
            $this->salesOrderTotalRepository->createOrderTotal($order, $cartTotal);

            //release point earned if total is 0
            if ($cartTotal['total'] <= 0 && $data['point_earned'] > 0) {
                $this->userRepository->addOrderPoint($order);
            }

            if ($order && $order->point_used > 0) {
                $this->pointLogRepository->markPointUsed($order);
            }

            if ($data['payment_method'] !== 'stripe') {
                $this->userCartRepository->clearCart($order->user_id);
                session()->flush('cart-' . $order->user_id);
                session()->flush('coupon-' . $order->user_id);
                session()->flush('point-' . $order->user_id);
            }

            $description = 'New Order';
            $this->salesOrderLogRepository->createLog($order, $data['user_id'], 'user', 0, $description);
        }

        return $order;
    }

    public function complete(Request $request)
    {
        $product_list = $this->productRepository->getListing()->take(8)->get();
        $order_id = $request->order_id;
        $sales_order = $this->salesOrderRepository->getSalesOrderId($order_id);

        if (!auth()->user() || !$sales_order || $sales_order->user_id != auth()->user()->id) {
            return redirect()->route('web.home')->with('swal_error', 'Order Not Found!');
        }

        if (Carbon::parse($sales_order->created_at)->addMinutes(30) < Carbon::now()) {
            return redirect()->route('web.home')->with('swal_error', 'Session Expired! Please view order at order detail!');
        }

        if ($request->payment_intent_client_secret) {
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
            $paymentIntent = $stripe->paymentIntents->retrieve($request->payment_intent, []);

            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->route('web.home')->with('swal_error', 'Your order currently in status - ' . $paymentIntent->status . '. Please contact admin for more enquiry.');
            }

            $this->userCartRepository->clearCart($sales_order->user_id);
            session()->flush('cart-' . $sales_order->user_id);
            session()->flush('coupon-' . $sales_order->user_id);
            session()->flush('point-' . $sales_order->user_id);
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
