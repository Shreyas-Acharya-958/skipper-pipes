<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerWhySkipper extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
