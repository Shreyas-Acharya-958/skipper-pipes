<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakMenu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'sequence'
    ];
}