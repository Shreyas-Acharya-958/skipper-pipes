<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionFeaturesSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'icon',
        'title',
        'description',
        'sequence',
        'alert',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
