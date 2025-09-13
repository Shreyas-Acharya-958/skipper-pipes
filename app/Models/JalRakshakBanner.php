<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakBanner extends Model
{
    protected $fillable = [
        'title',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
