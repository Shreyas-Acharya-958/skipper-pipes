<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakPhotoCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function galleries()
    {
        return $this->hasMany(JalRakshakGallery::class, 'category_id');
    }
}
