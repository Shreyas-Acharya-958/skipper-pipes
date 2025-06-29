<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'page_image',
        'short_description',
        'long_description',
        'section_1',
        'section_2',
        'section_3',
        'section_4',
        'section_5',
        'section_6',
        'section_7',
        'section_8',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_active'
    ];
}
