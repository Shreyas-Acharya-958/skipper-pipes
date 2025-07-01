<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionApplicationSection extends Model
{
    protected $fillable = [
        'product_id',
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