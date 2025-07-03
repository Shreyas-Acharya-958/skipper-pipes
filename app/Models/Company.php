<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'title',
        'slug',
        'page_image',
        'short_description',
        'long_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_active'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_active' => 'boolean'
    ];
}
