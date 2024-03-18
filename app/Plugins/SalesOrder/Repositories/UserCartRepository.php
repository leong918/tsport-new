<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\UserCart;
use App\Repositories\BaseRepository;

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

        // when guest add cart
        if (!$data['user_id']) {
            $cart->where('user_ip', $data['user_ip'])->whereNull('user_id');
        } else {
            $cart->where('user_id', $data['user_id']);
        }

        // when product have attribute
        if (isset($data['product_attribute_term_id'])) {
            $cart->where('product_attribute_term_id', $data['product_attribute_term_id']);
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

    public function countCartByItem($data)
    {
        if (!$data['user_id']) {
            $count = UserCart::where('user_ip', $data['user_ip'])->whereNull('user_id')->count();
        } else {
            $count = UserCart::where('user_id', $data['user_id'])->count();
        }

        return $count;
    }
}
