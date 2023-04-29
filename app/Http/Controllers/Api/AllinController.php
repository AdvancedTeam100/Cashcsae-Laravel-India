<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\AllinCampaign;
use App\Models\CuelinkCampaign;
use App\Models\Api_Advcampaign;

use App\Models\Faq;
use App\Models\Coupon;
use App\Models\CuelinkOffer;
use App\Models\Offer;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use stdClass;

class AllinController extends Controller
{
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
		$admitad=DB::table('admitad')->first();
		$this->client_id = $admitad->client_id;  
		$this->client_secret = $admitad->client_secret;
		$this->base64code = $admitad->base64code;
		$this->website_id = $admitad->website_id;
		$this->scope="advcampaigns_for_website deeplink_generator advcampaigns banners websites manage_opt_codes";
	}

	public function allin(Request $request)
    {
		$offset=1;
		
		$partners=AllinCampaign::get();
		if(count($partners)>0){
		foreach($partners as $partner){
			$cc=CuelinkCampaign::where('id',$partner->campaign_id)->first();
			$impact=Offer::where('id',$partner->impact_id)->first();
			$admited=Api_Advcampaign::where('id',$partner->admited_id)->first();
			
			if($admited){	
			if($request->user_id != NULL){
				  $curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => 'https://api.admitad.com/token/',
					CURLOPT_POST => true,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_POSTFIELDS => http_build_query([
						'client_id' =>  $this->client_id,
						'client_secret' => $this->client_secret,
						'grant_type' => 'client_credentials',
						'scope' => $this->scope,
					]),
				));

			   $headers =  array(
				  "Accept: application/json",
				  "Authorization: Basic ".$this->base64code,
			   );
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$resp = curl_exec($curl);
				curl_close($curl);
				$re = json_decode($resp);
				 $token = $re->access_token;
        if($token) {
    
            $url = "https://api.admitad.com/deeplink/".$this->website_id."/advcampaign/".$admited->ad_id."/?subid=".$request->user_id."&ulp=".$admited->gotourl;
			
    
                $curl1 = curl_init($url);
                curl_setopt($curl1, CURLOPT_URL, $url);
                curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
                $headers =  array(
                    "Accept: application/json",
                    "Authorization: Bearer $token",
                );
                curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl1, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);
    
                $resp1 = curl_exec($curl1);
                curl_close($curl1);
                $res=  json_decode($resp1);   
			   
			    $admited->tracking_url=$res[0];
				
				 
			}else{
				$admited->tracking_url =$admited->site_url;
			}
				
		    $admi_data = new stdClass();
			$admi_data->id=$admited->id;
			$admi_data->campaign_id=$admited->ad_id;
			$admi_data->adv_id=$admited->adv_id;
			$admi_data->name=$admited->name;
			$admi_data->domain=$admited->site_url;
			$admi_data->url=$admited->site_url;
			$admi_data->payout_type=NULL;
			$admi_data->payout=NULL;
			$admi_data->image=$admited->image;
			$admi_data->category=$admited->category->name;
			$admi_data->category_id=$admited->category->id;
			$admi_data->status=$admited->status;
			$admi_data->button_text="Grab Now";
			$admi_data->affiliate_partner=$admited->affiliate_partner;
			$admi_data->description=$admited->description;
			$admi_data->campaigns=$admited->ad_id;
			$admi_data->notify=$admited->notify;
			$admi_data->created_at=$admited->created_at;
			$admi_data->updated_at=$admited->updated_at;
			$admi_data->tracking_url=$admited->tracking_url;
			$admi_data->tab_color=$admited->tab_color;
			$admi_data->search_url=$admited->search_url;
			$check[]= $admi_data;
				
			}
		 }	
			if($impact){				
			if($request->user_id != NULL){
				$today=now();		
				$client_id = $this->sid;
				$secret =$this->token;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Programs/'.$impact->c_id.'/TrackingLinks');
			
				curl_setopt($ch, CURLOPT_POST, 1);
				 curl_setopt($ch, CURLOPT_POSTFIELDS,
					"DeepLink=".$impact->landing_page."&Type=regular&subId1=".$request->user_id);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec($ch);
				curl_close($ch);
				$data=json_decode($response);
				
				$impact->tracking_url =$data->TrackingURL;
				
			}else{
				$impact->tracking_url =$impact->url;
			}
			$impact->tab_color=$partner->tab_color;
			$impact->search_url=$partner->search_url;
			$check[]=$impact;
				
			}
			
			if($cc){
				
			if($request->user_id != NULL){
			 $url = 'https://www.cuelinks.com/api/v2/links.json?url='.$cc->url.'&shorten=true&subid='.$request->user_id;
			$ch2 = curl_init($url);
			$headers = [];
			$headers[] = 'Content-Type:application/json';
			$token = $this->apikey;
			$headers[] = "Authorization: Bearer ".$token;
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
			$result1 = curl_exec($ch2);
			curl_close($ch2);
			$dataw=json_decode($result1); 
				$cc->tracking_url =$dataw->affiliate_url;
				
			}else{
				$cc->tracking_url =$cc->url;
			}
			$cc->tab_color=$partner->tab_color;
			$cc->search_url=$partner->search_url;
			$check[]=$cc;
			}

		}
			
		 $arr = array('status'=>1, 'data'=>$check);
        return response()->json($arr);
		}else{
			$arr1 = array('status'=>1, 'data'=>[]);
            return response()->json($arr1);
		}
     }
	
	public function faq(Request $request)
    {
		$offset=1;
		$faqs=Faq::get();
	    $arr = array('status'=>1, 'data'=>$faqs);
        return response()->json($arr);
		
    }
   public function search(Request $request)
    {
		$offset=1;
	   $keyword=$request->keyword;
		$campaigns=CuelinkCampaign::where('name', 'like', '%'.$keyword.'%')->get();
	    $ads=Offer::where('name', 'like', '%'.$keyword.'%')->get();
	    $partners=Partner::with('cuecampaigns','ads')->where('name', 'like', '%'.$keyword.'%')->get();
	   $offer=CuelinkOffer::with('category')->where('name', 'like', '%'.$keyword.'%')->get();
		
		 $arr = array('status'=>1,'advertisers'=>$partners, 'campaign'=>$campaigns, 'ads'=>$ads, 'offer'=>$offer);
        return response()->json($arr);
		
     }
	
	public function coupon(Request $request)
    {
		$offset=1;
		$check=DB::table('cuelink')->first();
	   $coupons=NULL;
		if($check->status==1){
		$coupon=Coupon::Active()->Status()->with('offers','offers.category')->get();
			foreach($coupon as $cou){
				if($cou->offers != NULL){
				$campaign=CuelinkCampaign::with('partner')->where('campaign_id',$cou->offers->campaign_id)->first();
				$cou->partner=$campaign->name;
				}
				else{
					$part=Partner::with('cuecampaigns')->where('id',$cou->adv_id)->first();
					 $cou->partner=$part->cuecampaigns[0]->name;
				}
				$coupons[]=$cou;
			 }
		}else{
			$coupon=Coupon::Active()->Status()->with('offers','offers.category')->get();
			foreach($coupon as $cou){
				if($cou->offers == NULL){
			
					$part=Partner::with('cuecampaigns')->where('id',$cou->adv_id)->first();
					 $cou->partner=$part->cuecampaigns[0]->name;
				}
				$coupons[]=$cou;
			 }
		}
		
		if($coupons==NULL){
			$coupons=[];
		}
	    $arr = array('status'=>1, 'data'=>$coupons);
        return response()->json($arr);
		
    }
	
	
}
