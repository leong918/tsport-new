<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'phone_no' => 'required',
        'password' => 'required',
    ];

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level_id',
        'country_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone_no',
        'dob',
        'password',
        'referral_email',
        'referral_phone_no',
        'point',
        'status',
        'address_first_name',
        'address_last_name',
        'company_name',
        'address_phone_no',
        'address_email',
        'country',
        'postcode',
        'state',
        'city',
        'address',
        'remember_token',
        'email_verified_at',
        'level_upgrade_at',
        'level_validity',
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

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    public function level(): HasOne
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }
}
