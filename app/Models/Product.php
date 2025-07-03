<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'title',
        'slug',
        'page_image',
        'home_image',
        'product_overview',
        'product_overview_image',
        'features_benefits',
        'technical',
        'application',
        'faq',
        'brochure',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productionOverviewSection()
    {
        return $this->hasOne(ProductionOverviewSection::class);
    }

    public function productionApplicationSections()
    {
        return $this->hasMany(ProductionApplicationSection::class);
    }

    public function productionFeaturesSections()
    {
        return $this->hasMany(ProductionFeaturesSection::class);
    }

    public function productionFaqSections()
    {
        return $this->hasMany(ProductionFaqSection::class);
    }
}
