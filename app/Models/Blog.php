<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Blog extends Model
{
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
    public static $rules = [];

    protected $table = 'blog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'sort',
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

    protected function blogDescription(): HasMany
    {
        return $this->hasMany(BlogDescription::class);
    }

    protected function blogComment(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    public function firstLayerBlogComment()
    {
        return $this->blogComment()->whereNull('parent_id')->orderBy('created_at', 'desc')->get();
    }

    public function getParameters(string $params)
    {
        return $this->blogDescription->where('language', $params)->first();
    }

    public function publishedDate()
    {
        return Carbon::parse($this->published_at)->format('M j, Y');
    }
}
