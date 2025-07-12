<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhySkipperPipeSectionFive extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'sequence'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
