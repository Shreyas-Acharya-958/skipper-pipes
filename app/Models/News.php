<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'press_release',
        'file',
        'sequence',
        'status'
    ];

    protected $casts = [
        'press_release' => 'date',
        'sequence' => 'integer',
        'status' => 'boolean'
    ];
}
