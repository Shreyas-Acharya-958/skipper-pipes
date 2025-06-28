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
        'short_description',
        'long_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_active'
    ];
}
