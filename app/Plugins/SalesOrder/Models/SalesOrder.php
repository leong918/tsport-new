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
        'PENDING' => 0,
        'COMPLETED' => 1,
        'PROCESSING' => 2,
        'ONHOLD' => 3,
        'CANCELLED' => -1,
        'FAILED' => -2,
        'REFUNDED' => -3,
    ];

    public const PAYMENT_STATUS = [
        'UNPAID' => 0,
        'PAID' => 1,
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
        'customer_note',
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

    public function salesOrderProduct() : HasMany
    {
        return $this->hasMany(SalesOrderProduct::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function salesOrderLog() : HasMany
    {
        return $this->hasMany(SalesOrderLog::class);
    }
}
