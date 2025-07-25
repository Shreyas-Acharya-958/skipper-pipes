<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturingSectionOnesHead extends Model
{
    protected $table = 'manufacturing_section_ones_head';
    protected $fillable = [
        'title',
        'description',
    ];
}
