<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Coupon extends Model
{
    use HasFactory;

	
	   protected $fillable = [
    'name','status','code','adv_id','admi_coupon_id','image', 'description', 'heading', 'url', 'start_date', 'end_date', 'affiliate_partner','banner_image','button_text','created_at','updated_at'
]; 
	
	
	public function scopeStatus($query)
    {
        return $query->where('status', '=', 1);
    }
 
    public function scopeExpired($query)
    {
        return $query->whereDate('end_date', '<', date('Y-m-d'));
    }
	public function scopeInactive($query)
    {
        return $query->whereDate('start_date', '>', date('Y-m-d'));
    }
    public function scopeActive($query)
    {
        return $query->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('end_date', '>=', date('Y-m-d')) ;
    }
    public function advertisers()
    {
        return $this->belongsTo(Partner::class, 'adv_id');
    }
	 public function offers()
    {
		 return $this->belongsTo(CuelinkOffer::class, 'code','coupon_code');
    }

}