<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $guarded = [];

    protected $casts = [
        'event_date' => 'date',
        'is_read' => 'boolean',
    ];
}
