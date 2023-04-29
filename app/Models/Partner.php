<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Partner extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }
    public function ads()
    {
        return $this->hasMany(Offer::class,'partner_id');
    }
	public function cuecampaigns()
    {
        return $this->hasMany(CuelinkCampaign::class,'adv_id','id');
    }
	 public function homeadv()
    {
        return $this->hasOne(HomeAdv::class, 'p_id');
    }
	public function coupon()
    {
        return $this->hasMany(Coupon::class,'adv_id','id');
    }
}
