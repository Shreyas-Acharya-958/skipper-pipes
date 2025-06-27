<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'page_image',
        'product_overview',
        'product_overview_image',
        'features_benefits',
        'technical',
        'application',
        'faq',
        'brochure',
        'status'
    ];
}
