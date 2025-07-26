<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSectionTwo extends Model
{
    use HasFactory;

    protected $table = 'news_section_twos';
    protected $fillable = [
        'title',
        'image',
        'description',
    ];
}
