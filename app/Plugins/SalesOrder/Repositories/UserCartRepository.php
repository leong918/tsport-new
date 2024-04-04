<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\UserCart;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container;
use App\Plugins\SalesOrder\Repositories\CartRuleRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductAttributeRepository;
use App\Repositories\ProductAttributeTermRepository;
use App\Repositories\CountryRepository;

class UserCartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     */
    public function model()
    {
        return UserCart::class;
    }

    public function addToCart($data)
    {
        $cart = UserCart::where('product_id', $data['product_id']);

        if (isset($data['attribute'])) {
            ksort($data['attribute']);
            $data['product_attribute_term'] = json_encode($data['attribute']);

            $cart->where('product_attribute_term', $data['product_attribute_term']);
        }

        // when guest add cart
        if (!$data['user_id']) {
            $cart->where('user_ip', $data['user_ip'])->whereNull('user_id');
        } else {
            $cart->where('user_id', $data['user_id']);
        }

        $cart = $cart->first();
        if ($cart) {
            $cart->quantity += isset($data['quantity']) ? $data['quantity'] : 1;
        } else {
            $cart = new UserCart();
            $cart->fill($data);
            $cart->quantity = isset($data['quantity']) ? $data['quantity'] : 1;
        }

        $cart->save();
    }

    public function getUserCartByType($user_data, $type)
    {
        if ($type === 'guest') {
            $cart = UserCart::leftJoin('product', 'product.id', '=', 'user_cart.product_id')
                ->where('user_ip', $user_data)
                ->whereNull('user_id')
                ->select('user_cart.*', 'product.category_id', 'product.brand_id')
                ->get();
        } else {
            $cart = UserCart::leftJoin('product', 'product.id', '=', 'user_cart.product_id')
                ->where('user_id', $user_data)
                ->select('user_cart.*', 'product.category_id', 'product.brand_id')
                ->get();
        }

        $this->recalculateCart($cart);

        foreach ($cart as &$cart_content) {
            $description = null;

            if ($cart_content->product_attribute_term) {
                foreach (json_decode($cart_content->product_attribute_term) as $key => $product_attribute_term) {
                    $productAttributeRepository = new ProductAttributeRepository(new Container());
                    $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());

                    $productAttribute = $productAttributeRepository->find($key);
                    $productAttributeTerm = $productAttributeTermRepository->find($product_attribute_term);
                    $description .= '- ' . $productAttribute->name . ': ' . $productAttributeTerm->name . '</br>';
                }
            }

            $cart_content->description = $description;
        }

        return $cart;
    }

    private function recalculateCart($carts)
    {
        $productRepository = new ProductRepository(new Container());
        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());

        foreach ($carts as $cart) {
            $subtotal = 0;
            $product = $productRepository->find($cart->product_id);
            $subtotal += $product->getCurrencyParameters('HKD')->price;

            if ($cart->product_attribute_term) {
                foreach (json_decode($cart->product_attribute_term) as $product_attribute_term_id) {
                    $product_attribute_term = $productAttributeTermRepository->find($product_attribute_term_id);
                    $subtotal += $product_attribute_term->getCurrencyParameters('HKD')->price;
                }
            }

            $cart->price = $subtotal;
            $cart->total_price = $subtotal * $cart->quantity;
            $cart->save();
        }
    }

    public function updateOwnerCartByIp($user_id, $user_ip)
    {
        $empty_carts = UserCart::where('user_ip', $user_ip)->whereNull('user_id')->get();

        foreach ($empty_carts as $empty_cart) {
            //check if existing cart then update quantity into it
            $existing_cart = UserCart::where([
                'user_id' => $user_id,
                'user_ip' => $user_ip,
                'product_id' => $empty_cart->product_id,
                'product_attribute_term' => $empty_cart->product_attribute_term,
            ])->first();

            if ($existing_cart) {
                $existing_cart->quantity += $empty_cart->quantity;
                $existing_cart->save();

                $empty_cart->delete();
            } else {
                $empty_cart->user_id = $user_id;
                $empty_cart->save();
            }
        }
    }

    public function calculateUserCartTotal($user_data, $coupon_session, $user_id, $address = null)
    {
        $data = array();
        $data['subtotal'] = 0;
        $data['shipping_fee'] = 0;
        $cart_list = $this->getUserCartByType($user_data['user_data'], $user_data['type']);

        $productAttributeTermRepository = new ProductAttributeTermRepository(new Container());
        foreach ($cart_list as $cart) {
            $subtotal = 0;
            $subtotal += $cart->product->getCurrencyParameters('HKD')->price;

            if ($cart->product_attribute_term) {
                foreach (json_decode($cart->product_attribute_term) as $product_attribute_term_id) {
                    $product_attribute_term = $productAttributeTermRepository->find($product_attribute_term_id);
                    $subtotal += $product_attribute_term->getCurrencyParameters('HKD')->price;
                }
            }
            $data['subtotal'] += $subtotal * $cart->quantity;
        }

        $cartRuleRepository = new CartRuleRepository(new Container());
        $cart_rule_data = $cartRuleRepository->calculatePriorityRule($cart_list, $coupon_session);
        $data = array_merge($data, $cart_rule_data);

        $userRepository = new UserRepository(new Container());
        $data['point_redemption'] = $userRepository->calculateDiscountPoint($user_id);

        $total_price = $data['subtotal'] - $data['total_discount_amount'] - $data['point_redemption'];
        if (isset($address) && $address['country_id']) {
            $countryRepository = new CountryRepository(new Container());
            $shipping_data = $countryRepository->calculateShippingFee($total_price, $address['country_id']);
            $data = array_merge($data, $shipping_data);
        }

        $data['total'] = round($data['subtotal'] - $data['total_discount_amount'] - $data['point_redemption'] + $data['shipping_fee'], 2);
        return $data;
    }

    public function updateCartQty($data)
    {
        $subtotal = 0;
        $cart = UserCart::find($data['cart_id']);

        if ($data['quantity'] > 0) {
            $subtotal = $cart->product->getCurrencyParameters('HKD')->price * $data['quantity'];

            $cart->quantity = $data['quantity'];
            $cart->save();
        } else {
            $cart->delete();
        }

        return $subtotal;
    }

    public function clearCart($user_id)
    {
        UserCart::where('user_id', $user_id)->delete();
    }

    public function removeDeletedProductCart($deleted_attribute, $product_id, $type)
    {
        $array_ids = $deleted_attribute->get()->pluck('id')->toArray();
        $related_cart = UserCart::where('product_id', $product_id)->get();

        foreach ($related_cart as &$cart) {
            foreach (json_decode($cart->product_attribute_term) as $key => $value) {
                if ($type == 'attibute') {
                    if (in_array($key, $array_ids)) {
                        $cart->delete();
                    }
                } else {
                    if (in_array($value, $array_ids)) {
                        $cart->delete();
                    }
                }
            }
        }
    }
}
