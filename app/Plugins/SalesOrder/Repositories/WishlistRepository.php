<?php

namespace App\Plugins\SalesOrder\Repositories;

use App\Plugins\SalesOrder\Models\Wishlist;
use App\Repositories\BaseRepository;

class WishlistRepository extends BaseRepository
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
        return Wishlist::class;
    }

    public function toggleWishlist($data)
    {
        if($data['is_wishlist'] != 1){
            $wishlist = new Wishlist();
            $wishlist->fill($data);
            $wishlist->save();
        } else {
            $this->removeWishlist($data['user_id'], $data['product_id']);
        }
    }

    public function getWishlistByUser(int $id)
    {
        return Wishlist::leftJoin('product', 'wishlist.product_id', 'product.id')
                ->where('user_id', $id)->get();
    }

    public function removeWishlist(int $user_id, int $product_id)
    {
        Wishlist::where(['user_id' => $user_id, 'product_id' => $product_id])->delete();
    }
}
