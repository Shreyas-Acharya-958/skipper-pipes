<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'long_description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->slug = $section->generateUniqueSlug($section->title);
        });

        static::updating(function ($section) {
            if ($section->isDirty('title')) {
                $section->slug = $section->generateUniqueSlug($section->title);
            }
        });
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '!=', $this->id)
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}