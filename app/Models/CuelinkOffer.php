<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CuelinkOffer extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'integer'
    ];
   public function scopeOngoing($query)
    {
        return $query->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>', date('Y-m-d')) ;
    }
    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }
	public function scopeExclusive($query)
    {
        return $query->where('exclusive', '=', 1);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','cue_cat_id');
    }
	public function banner()
    {
        return $this->belongsTo(Banner::class, 'offer_id');
    }

    
}