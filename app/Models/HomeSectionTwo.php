<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionTwo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_title',
        'image_button',
        'link'
    ];
}
