<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productDescription() : HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function productImage() : HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productRelated() : HasMany
    {
        return $this->hasMany(ProductRelated::class,'related_product_id');
    }

    public function productPrice() : HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getCurrencyParameters(string $currency)
    {
        return $this->productPrice->where('code',$currency)->first();
    }

    public function getParameters(string $params)
    {
        return $this->productDescription->where('language',$params)->first();
    } 

    public function checkProductRelated($product_id, $related_product_id)
    {
        return ProductRelated::where(['product_id' => $product_id, 'related_product_id' => $related_product_id])->exists();
    }

}
