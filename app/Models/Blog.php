<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'title',
        'page_image',
        'image_1',
        'image_2',
        'slug',
        'short_description',
        'long_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'sequence',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'sequence' => 'integer'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'cat_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag', 'blog_id', 'tag_id');
    }
}
