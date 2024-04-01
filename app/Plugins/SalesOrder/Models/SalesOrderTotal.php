<?php

namespace App\Plugins\SalesOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SalesOrderTotal extends Model
{
    use SoftDeletes;

    protected $table = 'sales_order_total';

    public const TOTAL_SORT = [
        'SUBTOTAL' => 1,
        'DISCOUNT' => 2,
        'COUPON' => 3,
        'POINT_REDEMPTION' => 4,
        'SHIPPING_FEE' => 5,
        'TOTAL' => 6,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sales_order_id',
        'user_id',
        'cart_rule_id',
        'title',
        'code',
        'value',
        'text',
        'sort',
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
