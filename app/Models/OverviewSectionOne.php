<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverviewSectionOne extends Model
{
    protected $fillable = [
        'company_id',
        'information',
        'image',
        'description'
    ];
}
