<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakGallery extends Model
{
    protected $fillable = [
        'image',
        'title',
        'sequence',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(JalRakshakPhotoCategory::class, 'category_id');
    }
}
