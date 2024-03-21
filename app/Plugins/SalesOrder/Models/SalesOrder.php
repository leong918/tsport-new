<?php

namespace App\Plugins\SalesOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SalesOrder extends Model
{
    use SoftDeletes;

    protected $table = 'sales_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'address_id',
        'sales_order_id',
        'payment_method',
        'stripe_payment_intent_id',
        'subtotal',
        'shipping',
        'discount',
        'total',
        'point',
        'status',
        'first_name',
        'last_name',
        'company_name',
        'phone_no',
        'email',
        'country',
        'postcode',
        'state',
        'city',
        'address',
        'completed_at',
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
