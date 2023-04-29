<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CuelinkCampaign extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'adv_id');
    }
	 public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','cue_cat_id');
    }
	public function coupon()
    {
        return $this->hasMany(Partner::class, 'adv_id');
    }

    
}