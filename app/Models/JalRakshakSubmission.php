<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'water_saving_commitment'
    ];
}
