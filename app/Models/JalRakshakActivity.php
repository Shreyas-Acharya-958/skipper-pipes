<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakActivity extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'sequence'
    ];
}