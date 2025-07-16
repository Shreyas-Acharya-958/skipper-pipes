<?php
// app/Models/CareerApplication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'phone',
        'dob',
        'resume_path',
        'address'
    ];
}