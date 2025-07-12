<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqList extends Model
{
    use HasFactory;

    protected $fillable = [
        'faq_master_id',
        'question',
        'answer',
        'sequence',
        'status'
    ];

    protected $casts = [
        'sequence' => 'integer',
        'status' => 'boolean'
    ];

    public function faqMaster()
    {
        return $this->belongsTo(FaqMaster::class);
    }
}
