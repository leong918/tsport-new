<?php

namespace App\Plugins\SalesOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class SalesOrder extends Model
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public const PAYMENT_METHOD = [
        'CREDIT CARD (STRIPE)' => 'stripe',
        'ALIPAY HK' => 'alipay',
        'DIRECT BANK TRANSFER (FPS)' => 'fps',
    ];

    public const ORDER_STATUS = [
        'ON HOLD' => 0,
        'COMPLETED' => 1,
        'PROCESSING' => 2,
        'FAILED' => -1,
        'CANCELLED' => -2,
        'REFUNDED' => -3,
    ];

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
        'delivery_partner',
        'stripe_payment_intent_id',
        'subtotal',
        'shipping',
        'discount',
        'total',
        'point_earned',
        'point_used',
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
        'customer_note',
        'level_change',
        'completed_at',
        'is_free_shipping',
        'is_pay_later',
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

    public function salesOrderProduct(): HasMany
    {
        return $this->hasMany(SalesOrderProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function salesOrderLog(): HasMany
    {
        return $this->hasMany(SalesOrderLog::class);
    }

    public function salesOrderTotal(): HasMany
    {
        return $this->hasMany(SalesOrderTotal::class)
            ->leftJoin('cart_rule', 'sales_order_total.cart_rule_id', '=', 'cart_rule.id')
            ->orderBy('sales_order_total.sort')
            ->orderBy('cart_rule.priority', 'desc')
            ->selectRaw('sales_order_total.*');
    }

    public function getSalesOrderTotal(string $title)
    {
        return $this->salesOrderTotal->where('title', $title)->get();
    }
}
