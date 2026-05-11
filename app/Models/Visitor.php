<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_id',
        'ip_address',
        'page',
        'user_agent',
        'referrer',
        'is_new_visitor',
    ];

    protected $casts = [
        'is_new_visitor' => 'boolean',
    ];
}
