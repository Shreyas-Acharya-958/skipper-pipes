<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturingSectionOne extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'image',
        'description'
    ];
}
