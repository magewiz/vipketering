<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    protected $casts = [
        'dishes' => 'array',
        'included' => 'array',
        'is_published' => 'boolean',
    ];
}
