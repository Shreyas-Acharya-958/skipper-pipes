<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionOverviewSection extends Model
{
    protected $fillable = [
        'product_id',
        'product_category_id',
        'overview_description',
        'overview_image',
    ];

    protected $casts = [
        'overview_image' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
