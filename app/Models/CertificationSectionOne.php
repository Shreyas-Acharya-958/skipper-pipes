<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationSectionOne extends Model
{
    protected $fillable = [
        'company_id',
        'image',
        'title',
        'short_description',
        'long_description',
        'link'
    ];
}
