<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Partner;
use App\Models\Category;
use App\Models\CuelinkCampaign;
use App\Models\Offer;
use App\Models\Banner;
use App\Models\HomeAdv;
use App\Models\Coupon;
use App\Models\AdNetwork;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class AdmobController extends Controller
{

   public function fbads()
    {
        $fbads=DB::table('fb_ads')->get();
		$ad_net=array();
		$ads=array();
		foreach($fbads as $ad){
			if($ad->ad_type=="banner"){
				
				$banner[]=$ad;
				$ads['banner']=$banner;
			}
			
			if($ad->ad_type=="native"){
				$banner1[]=$ad;
				$ads['native']=$banner1;
			}
			
			if($ad->ad_type=="interstitial"){
			
				$banner2[]=$ad;
				$ads['interstitial']=$banner2;
			}
			
			if($ad->ad_type=="rewards"){
				
				$banner3[]=$ad;
				$ads['rewards']=$banner3;
			}
		}
        $arr = array('status'=>1, 'data'=>$ads);
        return response()->json($arr);
    }
    
    public function admobs()
    {
        $admo=DB::table('admob_ads')->get();
		$ad_net=array();
		$ads=array();
		foreach($admo as $ad){
			if($ad->ad_type=="banner"){
				
				$banner[]=$ad;
				$ads['banner']=$banner;
			}
			
			if($ad->ad_type=="native"){
				$banner1[]=$ad;
				$ads['native']=$banner1;
			}
			
			if($ad->ad_type=="interstitial"){
			
				$banner2[]=$ad;
				$ads['interstitial']=$banner2;
			}
			
			if($ad->ad_type=="rewards"){
				
				$banner3[]=$ad;
				$ads['rewards']=$banner3;
			}
		}
        $arr = array('status'=>1, 'data'=>$ads);
        return response()->json($arr);
    }
   

    
    
}
