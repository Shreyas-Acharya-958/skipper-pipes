<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionFaqSection extends Model
{
    protected $fillable = [
        'product_id',
        'product_category_id',
        'title',
        'description',
        'sequence',
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
