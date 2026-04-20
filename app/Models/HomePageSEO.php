<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSEO extends Model
{
    protected $table = 'homepageseo';
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_card',
        'schema_json',
        'custom_schema_json',
        'faq_json'
    ];
}
