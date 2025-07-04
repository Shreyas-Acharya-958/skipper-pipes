<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'page_image',
        'status',
        'partner_type'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sectionOne()
    {
        return $this->hasOne(PartnerSectionOne::class);
    }

    public function sectionTwo()
    {
        return $this->hasOne(PartnerSectionTwo::class);
    }

    public function pipesOffers()
    {
        return $this->hasMany(PartnerPipesOffer::class);
    }
}
