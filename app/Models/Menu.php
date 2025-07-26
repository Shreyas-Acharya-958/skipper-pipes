<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'link',
        'sequence',
        'parent_id',
        'status',
        'is_active'
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Get the parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Get the child menus
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->orderBy('sequence')
            ->with('children'); // Eager load nested children
    }

    // Get all descendants
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    // Get SEO metadata for this menu
    public function seoMetadata()
    {
        return $this->hasOne(MenuSeoMetadata::class);
    }

    // Get root level menus
    public static function root()
    {
        return static::whereNull('parent_id')
            ->orderBy('sequence')
            ->with('children') // Eager load children
            ->get();
    }

    // Get nested array of all menus
    public static function tree()
    {
        return static::with(['children' => function ($query) {
            $query->orderBy('sequence');
        }])
            ->whereNull('parent_id')
            ->orderBy('sequence')
            ->get();
    }
}
