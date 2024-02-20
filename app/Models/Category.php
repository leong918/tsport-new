<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
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
        'SKIN CARE' => 'skin_care',
        'MAKEUP' => 'makeup',
        'HAIR & BODY' => 'hair_body'
    ];

    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'status',
        'sort',
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

    protected function categoryDescription()
    {
        return $this->hasMany(CategoryDescription::class);
    }

    protected function cnDescription()
    {
        return $this->hasOne(CategoryDescription::class)->where('language','cn');
    }

    protected function enDescription()
    {
        return $this->hasOne(CategoryDescription::class)->where('language','en');
    }
}
