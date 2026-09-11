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
}
