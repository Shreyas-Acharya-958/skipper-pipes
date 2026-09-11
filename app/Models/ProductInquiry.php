<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInquiry extends Model
{
 protected $fillable = ['product_id','brochure_type','name',
    'email',
    'mobile',
    'pincode',
    'user_agent',
    'device_type',
    'browser',
    'platform'];

    public function product(){
        return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
}
