<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
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
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sequence');
    }

    // Get all descendants
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    // Get root level menus
    public static function root()
    {
        return static::whereNull('parent_id')->orderBy('sequence')->get();
    }

    // Get nested array of all menus
    public static function tree()
    {
        return static::with('descendants')
            ->whereNull('parent_id')
            ->orderBy('sequence')
            ->get();
    }
}
