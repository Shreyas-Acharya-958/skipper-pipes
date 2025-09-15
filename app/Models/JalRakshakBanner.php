<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakBanner extends Model
{
    protected $fillable = [
        'title',
        'images',
        'mobile_image'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
