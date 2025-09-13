<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakConservation extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'sequence'
    ];
}