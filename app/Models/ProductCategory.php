<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'hero_image',
        'icon',
        'brochure',
        'technical_brochure',
        'guide_content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_type',
        'twitter_title',
        'twitter_description',
        'twitter_card',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productionOverviewSection()
    {
        return $this->hasOne(ProductionOverviewSection::class);
    }

    public function productionApplicationSections()
    {
        return $this->hasMany(ProductionApplicationSection::class)->orderBy('sequence');
    }

    public function productionFeaturesSections()
    {
        return $this->hasMany(ProductionFeaturesSection::class)->orderBy('sequence');
    }

    public function productionFaqSections()
    {
        return $this->hasMany(ProductionFaqSection::class)->orderBy('sequence');
    }
}
