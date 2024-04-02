<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopBar extends Model
{
    use HasFactory;
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

    protected $table = 'top_bar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'background_colour',
        'status',
        'content',
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
}
