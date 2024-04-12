<?php

namespace App\Plugins\SalesOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CartRule extends Model
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    public const TYPE = [
        'Discount' => 'discount',
        'Coupon' => 'coupon',
        'Insider Discount' => 'insider_discount',
        'Core Discount' => 'core_discount',
        'Referral Discount' => 'referral_discount',
        'Referree Discount' => 'referree_discount',
    ];

    public const TARGET = [
        'Whole Cart Discount' => 'whole',
        'Specific Category' => 'category',
        'Specific Brand' => 'brand',
        'Specific Product' => 'product',
    ];

    public const DISCOUNT_TYPE = [
        'Deduct' => 'deduct',
        'Percentage' => 'percentage',
    ];

    protected $table = 'cart_rule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_id',
        'name',
        'coupon_code',
        'type',
        'target_table',
        'discount_type',
        'value',
        'priority',
        'status',
        'start_date',
        'end_date',
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
}
