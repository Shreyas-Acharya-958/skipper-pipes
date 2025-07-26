<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSectionTwo extends Model
{
    use HasFactory;

    protected $table = 'blog_section_twos';
    protected $fillable = [
        'title',
        'image',
        'description',
    ];
}
