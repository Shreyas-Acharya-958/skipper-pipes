<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'title',
        'page_image',
        'image_1',
        'image_2',
        'slug',
        'short_description',
        'long_description',
        'status',
        'published_at'
    ];
}
