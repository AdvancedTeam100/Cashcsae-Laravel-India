<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api_Advcampaign extends Model
{
    use HasFactory;
   protected $table = 'api_advcampaigns';
   protected $fillable = [
    'name','ad_id','adv_id','image', 'name_aliases', 'site_url', 'description', 'raw_description', 'currency', 'rating','cat_id','cr_trend','epc_trend','ecpc_trend','country','exclusive','activation_date','modified_date','denynewwms','goto_cookie_lifetime','retag','show_products_links','landing_code','landing_title','geotargeting','max_hold_time','avg_hold_time','avg_money_transfer_time','allow_deeplink','coupon_iframe_denied','action_testing_limit','mobile_device_type','mobile_os','mobile_os_type','allow_actions_all_countries','connected','gotourl'
];


  public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'adv_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

}
