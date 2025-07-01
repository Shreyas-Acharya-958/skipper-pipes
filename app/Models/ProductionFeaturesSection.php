<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionFeaturesSection extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'icon',
        'title',
        'description',
        'sequence',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
