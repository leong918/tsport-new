<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminMenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'admin_menu';

    protected $fillable = [
        'parent_id',
        'title',
        'icon',
        'url',
        'type',
        'sort',
        'status',
        'key',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];
}
