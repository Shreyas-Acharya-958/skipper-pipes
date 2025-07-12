<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerEnquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'firm_name',
        'gst',
        'pincode',
        'occupation',
        'experience',
        'dealership_type',
        'description',
        'partner_id'
    ];
}
