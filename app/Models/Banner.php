<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Banner extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

    public function cuelinkoffer()
    {
        return $this->belongsTo(CuelinkOffer::class, 'offer_id');
    }

}