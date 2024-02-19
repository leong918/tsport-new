<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function blogDetail()
    {
        return $this->hasMany(BlogDetail::class);
    }

    protected function enBlogDetail()
    {
        return $this->hasOne(BlogDetail::class)->where('language','en');
    }

    protected function cnBlogDetail()
    {
        return $this->hasOne(BlogDetail::class)->where('language','cn');
    }
}
