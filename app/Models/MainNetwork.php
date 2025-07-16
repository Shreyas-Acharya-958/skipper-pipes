<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainNetwork extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'overview'
    ];
}
