<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSectionTwo extends Model
{
    use HasFactory;

    protected $table = 'media_section_twos';
    protected $fillable = [
        'title',
        'image',
        'description',
    ];
}
