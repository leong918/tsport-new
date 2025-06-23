<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    protected $table = 'blog';

    public $translatedAttributes = [
        'title',
        'content',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'thumbnail',
        'sort',
        'status',
        'published_at',
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

    public function publishedDate()
    {
        return Carbon::parse($this->published_at)->format('M j, Y');
    }
}
