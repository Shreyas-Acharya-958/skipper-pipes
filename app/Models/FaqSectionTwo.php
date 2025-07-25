<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSectionTwo extends Model
{
    use HasFactory;

    protected $table = 'faq_section_twos';
    protected $fillable = [
        'title',
        'image',
        'description',
    ];
}
