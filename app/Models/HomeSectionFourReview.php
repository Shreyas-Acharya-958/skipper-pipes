<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionFourReview extends Model
{
    protected $fillable = [
        'section_four_id',
        'person_image',
        'person_name',
        'person_role',
        'star',
        'sequence'
    ];

    public function section()
    {
        return $this->belongsTo(HomeSectionFour::class, 'section_four_id');
    }
}
