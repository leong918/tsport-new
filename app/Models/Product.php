<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'sku',
        'alias',
        'status',
        'sort',
        'is_best_seller',
        'is_new',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    public function productDescription()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productRelated()
    {
        return $this->hasMany(ProductRelated::class);
    }

    public function cnDescription()
    {
        return $this->hasOne(ProductDescription::class)->where('language','cn');
    }

    public function enDescription()
    {
        return $this->hasOne(ProductDescription::class)->where('language','en');
    }

    public function checkProductRelated($product_id, $related_product_id)
    {
        return ProductRelated::where(['product_id' => $product_id, 'related_product_id' => $related_product_id])->exists();
    }
}
