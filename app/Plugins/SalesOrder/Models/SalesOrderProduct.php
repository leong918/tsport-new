<?php

namespace App\Plugins\SalesOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\ProductAttributeTerm;

class SalesOrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'sales_order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sales_order_id',
        'product_id',
        'product_attribute_term',
        'product_name',
        'product_attribute_term_name',
        'price',
        'quantity',
        'total_price',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductAttributeTerm()
    {
        $attributeTermIDList = [];
        $attributeIDList = [];
    
        // Decode the JSON string
        $attributes = json_decode($this->product_attribute_term, true);

        // Check if decoding was successful
        if ($attributes) {
            // Extract attribute IDs and term IDs
            foreach ($attributes as $key => $product_attribute_term) {
                $attributeIDList[] = $key;
                $attributeTermIDList[] = $product_attribute_term;
            }

            // Retrieve product attribute terms based on the extracted IDs
            return ProductAttributeTerm::whereIn('id', $attributeTermIDList)
                ->whereIn('product_attribute_id', $attributeIDList)
                ->get();
        } else {
            // Handle case where JSON decoding fails
            return [];
        }
    }

    public function getProductAttributeTermSKU()
    {   
        $sku = "";
        $data = $this->getProductAttributeTerm();

        foreach($data as $index => $item)
        {
            $sku = $index == count($data) - 1 ? $sku.= $item->sku : $sku.= $item->sku.", ";
        }
        return $sku;
    }
}
