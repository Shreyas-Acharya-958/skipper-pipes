<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionApplicationSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'icon',
        'title',
        'description',
        'image',
        'sequence',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
