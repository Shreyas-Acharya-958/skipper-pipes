<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionFour extends Model
{
    protected $fillable = ['image', 'title', 'description'];

    public function reviews()
    {
        return $this->hasMany(HomeSectionFourReview::class, 'section_four_id');
    }
}
