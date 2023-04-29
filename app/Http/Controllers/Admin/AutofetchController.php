<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\CuelinkCampaign;
use App\Models\CuelinkOffer;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;

class AutofetchController extends Controller
{
	
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
	}
	
	
	 public function autofetchcampaigns()
    {
		 $url = 'https://www.cuelinks.com/api/v2/campaigns/count.json';
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
		
		
		 $idd=100;
		 $chh=($dataw->campaigns->count)/$idd; 
		 $co=(int)round($chh,0)+1;
		
for($i=1;$i<=$co;$i++){
    $url = 'https://www.cuelinks.com/api/v2/campaigns.json?page='.$i.'&per_page='.$idd;
    $ch = curl_init($url);
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    $token = $this->apikey;
    $headers[] = "Authorization: Bearer ".$token;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

$data=json_decode($result);
if($data == NULL){
	 return redirect()->back()->with('error','Cuelink API is invalid.');
}
	
if(!$result){
	break;
}
$brands=$data->campaigns;	

			 $get_id=NULL;
			foreach($brands as $data){
				$get_id[] = $data->id;
			}
			if($get_id==NULL){
				$get_id=array();
			}


			$getjoinoffers=CuelinkCampaign::get();
			foreach($getjoinoffers as $offers){
				$key = array_search($offers->campaign_id, $get_id);
				if($key == FALSE){
					$getjoinoffers=CuelinkCampaign::FindorFail($offers->id);
					$getjoinoffers->status=0;
					$getjoinoffers->save();
				}
				
			}
		$count=0;
         $update=0;
	foreach($brands as $brand){
       $partner=CuelinkCampaign::where('campaign_id',$brand->id)->first();
		if(!$partner){
			$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, $brand->image);
			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Accept: image/gif'));
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			$response2 = curl_exec($ch2);
			curl_close($ch2);
			$dir='partner/';
			$img = base64_encode($response2);
			$base64_image = "data:image/jpeg;base64,".$img;

if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
          $data = substr($base64_image, strpos($base64_image, ',') + 1);

           $data = base64_decode($data);
	       if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $brand->id.".png", $data);
        

          }		
         foreach($brand->countries as $coun){
				
				$country[]=$coun->name;
			}
		 $partner1=Partner::where('name',$brand->domain)->first();
		if(!$partner1){	
	    $adv= new Partner();
		$adv->name=$brand->domain;
		$adv->status=0 ;
		$adv->regions=json_encode($country);
		$adv->affiliate_partner="cuelinks";
		$adv->status=0;
		$adv->image = $brand->id.".png";
		$adv->created_at=now();
		$adv->updated_at=now();
		$adv->save();
			$pp_id =$adv->id;
		}else{
			$pp_id=$partner1->id;
		}
		
		$partner= new CuelinkCampaign();
		$partner->campaign_id=$brand->id;
		$partner->adv_id=$pp_id;
		$partner->name=$brand->name;
		$partner->url=$brand->url;
		$partner->domain=$brand->domain;
		$partner->status=0;
		$partner->payout_type=$brand->payout_type;
		$partner->affiliate_partner="cuelinks";
		$partner->payout=$brand->payout;	
		$partner->category=$brand->categories[0]->name;
		$partner->category_id=$brand->categories[0]->id;
		$partner->created_at=now();
		$partner->updated_at=now();
		$partner->save();

        $cat=Category::where('cue_cat_id',$brand->categories[0]->id)->first();
		if(!$cat){
		$category= new Category();
		$category->name=$brand->categories[0]->name;
		$category->cue_cat_id=$brand->categories[0]->id;
		$category->save();	
		}  
			
			
        $count++;
		}
	}
}
		
		if($count==0){
			 return redirect()->back()->with('warning','No New Campaigns');
		}
       return redirect()->back()->withSuccess($count.' Campaigns added check Cuelinks->campaigns section.');
    }
	
				   
				   
public function autofetchoffers()
    {
    $url = 'https://www.cuelinks.com/api/v2/offers.json';
        
    $ch = curl_init($url);
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    $token = $this->apikey;
    $headers[] = "Authorization: Bearer ".$token;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

$data=json_decode($result);
if($data == NULL){
	 return redirect()->back()->with('warning','Cuelink API is invalid.');
}
$brands=$data->offers;	
 $get_id=NULL;
			foreach($brands as $data){
				$get_id[] = $data->id;
			}
			if($get_id==NULL){
				$get_id=array();
			}


			$getjoinoffers=CuelinkOffer::get();
			foreach($getjoinoffers as $offers){
				$key = array_search($offers->offer_id, $get_id);
				if($key == FALSE){
					$getjoinoffers=CuelinkOffer::FindorFail($offers->id);
					$getjoinoffers->status=0;
					$getjoinoffers->save();
				}
				
			}		  
		$count=0;
         $update=0;
	$update2=0;
	$delete=0;
	foreach($brands as $brand){
       $partner=CuelinkOffer::where('offer_id',$brand->id)->first();
		if($brand->status=="live"){
		if(!$partner){
			$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, $brand->image_url);
			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Accept: image/gif'));
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			$response2 = curl_exec($ch2);
			curl_close($ch2);
			$dir='offer/';
			$dir2='partner/';
			$img = base64_encode($response2);
			$base64_image = "data:image/jpeg;base64,".$img;

if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
          $data = substr($base64_image, strpos($base64_image, ',') + 1);

           $data = base64_decode($data);
	       if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
	        if (!Storage::disk('public')->exists($dir2)) {
                Storage::disk('public')->makeDirectory($dir2);
            }
            Storage::disk('public')->put($dir . $brand->id.".png", $data);
        
             Storage::disk('public')->put($dir2 . $brand->id.".png", $data);
          }		
       $allKeysOfEmployee = array_keys((array)$brand->categories);

foreach($allKeysOfEmployee as &$tempKey){
	$tempKey=$tempKey;

}
		$partner= new CuelinkOffer();
		$partner->campaign_id=$brand->camapign_id;		
		$partner->campaign_name=$brand->campaign;
		$partner->name=$brand->title;
		$partner->offer_id=$brand->id;
		$partner->url=$brand->url;
		$partner->affiliate_url=$brand->affiliate_url;
		$partner->status=0;
		$partner->description=$brand->description;
		$partner->terms=$brand->terms_and_condition;
		$partner->affiliate_partner="cuelinks";
		$partner->coupon_code=$brand->coupon_code;	
		$partner->start_date=$brand->start_date;
		$partner->end_date=$brand->end_date;	
		$partner->coupon_code=$brand->coupon_code;	
		$partner->category_id=$tempKey;
		$partner->category=$brand->categories->$tempKey;
		$partner->image = $brand->id.".png";
		$partner->created_at=now();
		$partner->updated_at=now();
		$partner->save();

        $cat=Category::where('cue_cat_id',$tempKey)->first();
		if(!$cat){
			$category= new Category();
		$category->name=$brand->categories->$tempKey;
		$category->cue_cat_id=$tempKey;
		$category->save();	
		}  
			
			
        $count++;
			
				if($brand->coupon_code != "" && $brand->coupon_code != NULL){

				$coupon = new Coupon();
				$coupon->name = $brand->campaign;
				$coupon->code = $brand->coupon_code;
				$coupon->image =$brand->image;
				$coupon->url=$brand->url;
				$coupon->adv_id = NULL;
				$coupon->heading = $brand->campaign;		
				$coupon->description = $brand->title;	
				$coupon->start_date = $brand->start_date;		
				$coupon->end_date = $brand->end_date;	
				$coupon->affiliate_partner = "cuelinks";
				$coupon->save();
					$update++;
				}
		}
			
			
		}
		if($partner && (strtotime($partner->end_date)< strtotime(date('Y-m-d'))) || ($brand->status != "live")){
			$partdelete=CuelinkOffer::where('offer_id',$brand->id)->update(['status'=>0]);
			$delete++;
			if($brand->coupon_code != "" && $brand->coupon_code != NULL){
				$partd=Coupon::where('code',$brand->coupon_code)->update(['status'=>0]);
				$update2++;
			}
		}
		
		
		
		
	
	}
		
		if($count==0 && $delete==0){
			 return redirect()->back()->with('warning','No New Offers');
		}
       return redirect()->back()->withSuccess($count.' Offers added and '.$delete.' expired offers status updated to inactive! Check Cuelinks->offers section and '.$update.' coupons has been added and '.$update2.' expired coupons status updated to inactive! Check coupon list section.');
    }
	

    public function autofetchbrands()
    {
		
$client_id = $this->sid;
$secret =$this->token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Campaigns');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$data=json_decode($response);
$brands=$data->Campaigns;		
		$count=0;
         $update=0;
	foreach($brands as $brand){
       $partner=Partner::where('adv_id',$brand->AdvertiserId)->first();
		if(!$partner && $brand->ContractStatus=="Active"){
			
			$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Campaigns/'.$brand->CampaignId.'/Logo');
			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Accept: image/gif'));
			curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch2, CURLOPT_USERPWD, $client_id.':'.$secret);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			$response2 = curl_exec($ch2);
			curl_close($ch2);
			$dir='partner/';
			$img = base64_encode($response2);
			$base64_image = "data:image/jpeg;base64,".$img;

if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
          $data = substr($base64_image, strpos($base64_image, ',') + 1);

           $data = base64_decode($data);
	       if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $brand->AdvertiserId.".png", $data);
        

          }		

		
		$partner= new Partner();
		$partner->name=$brand->AdvertiserName;
		$partner->adv_id=$brand->AdvertiserId;
		$partner->status=$brand->ContractStatus=="Active"? 1:0 ;
		$partner->regions=json_encode($brand->ShippingRegions);
		$partner->affiliate_partner="impact";
		$partner->status=0;
		$partner->image = $brand->AdvertiserId.".png";
		$partner->created_at=now();
		$partner->updated_at=now();
		$partner->save();
			
        $count++;
		}

       if($partner && $brand->ContractStatus != "Active"){
			$partner=Partner::where('adv_id',$brand->AdvertiserId)->update(['status'=>0]);
			$update++;
		}
	
	}
		DB::table('impact')->update([
			'click'=>1
        ]);
		if($count==0 && $update==0){
			 return redirect()->back()->with('warning','No New Advertisers');
		}
		
       return redirect()->back()->withSuccess($count.' Advertisers addded and '.$update.' Advertisers updated successfully check Advertisers section.');
    }
	
	
	
	public function autofetchads()
    {
$today=now();		
$client_id = $this->sid;
$secret =$this->token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Ads');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$data=json_decode($response);
$brands=$data->Ads;	
		
$get_id=NULL;
			foreach($brands as $data){
				$get_id[] = $data->Id;
			}
			if($get_id==NULL){
				$get_id=array();
			}


			$getjoinoffers=Offer::get();
			foreach($getjoinoffers as $offers){
				$key = array_search($offers->ad_id, $get_id);
				if($key == FALSE){
					$getjoinoffers=Offer::FindorFail($offers->id);
					$getjoinoffers->status=0;
					$getjoinoffers->save();
				}
				
			}
		$count=0;
         $update=0;
	foreach($brands as $brand){
       $partner=Offer::where('ad_id',$brand->Id)->first();
		 $partnercheck=Partner::where('adv_id',$brand->AdvertiserId)->first();
		if($partnercheck){
		if($brand->EndDate=='' || $brand->EndDate==NULL){
			$endate=$today;
		}else{
			$endate=$brand->EndDate;
		}
		if((!$partner && $brand->MobileReady=="true" && strtotime($today) >= strtotime($brand->StartDate) && strtotime($today)<=strtotime($endate) && $brand->Type != "TEXT_LINK" && $brand->Type != "COUPON") && (($brand->Width == $brand->Height) || ($brand->Height>$brand->Width/2 && $brand->Height<=$brand->Width))){
			
			$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, 'https:'.$brand->CreativeUrl);
			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Accept: image/gif'));
			curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch2, CURLOPT_USERPWD, $client_id.':'.$secret);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			$response2 = curl_exec($ch2);
			curl_close($ch2);
			$dir='offer/';
			$img = base64_encode($response2);
			$base64_image = "data:image/jpeg;base64,".$img;

if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
          $data = substr($base64_image, strpos($base64_image, ',') + 1);

           $data = base64_decode($data);
	       if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $brand->Id.".png", $data);
        

          }		

		
		$partner= new Offer();
		$partner->adv_name=$brand->AdvertiserName;
		$partner->adv_id=$brand->AdvertiserId;
		$partner->c_id=$brand->CampaignId;
		$partner->name=$brand->Name;
		$partner->ad_id=$brand->Id;
		$partner->tracking_link=$brand->TrackingLink;
		$partner->description=$brand->Description;
		$partner->partner_id=$partnercheck->id;
		$partner->type=strtolower($brand->Type);
		$partner->landing_page=$brand->LandingPageUrl;
		$partner->status=0;
		$partner->affiliate_partner="impact";
		$partner->image = $brand->Id.".png";
		$partner->created_at=now();
		$partner->updated_at=now();
		$partner->save();
			
        $count++;
		}

       if(($partner) && ($brand->MobileReady=="false" || strtotime($today) < strtotime($brand->StartDate) || strtotime($today) > strtotime($endate))){
			$partner=Offer::where('ad_id',$brand->Id)->update(['status'=>0]);
			$update++;
		}
	
	}
	}
		DB::table('impact')->update([
			'click'=>1
        ]);
		if($count==0 && $update==0){
			 return redirect()->back()->with('warning','No New Ads');
		}
       return redirect()->back()->withSuccess($count.' Ads addded and '.$update.' Ads updated successfully check Ads section.');
    }

  
	

}
