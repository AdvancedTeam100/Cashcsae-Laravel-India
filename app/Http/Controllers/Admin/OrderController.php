<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\CuelinkCampaign;
use App\Models\CuelinkOffer;
use App\Models\Offer;
use App\Models\User;
use App\Models\Order;
use App\Models\Earning;
use App\Models\Coupon;
use App\Models\Referral;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
	
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
	}
	
	public function impactautofetchorders()
    {
		$today=now();		
		$client_id = $this->sid;
		$secret =$this->token;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Actions');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		$data=json_decode($response); 
		$checkee=$data->Actions;
		foreach($checkee as $check){
			if($check->SubId1 != NULL && $check->SubId1 != ''){
			 $ads=Offer::where('ad_id',$check->AdId)->first();
	   if($ads){
	  $partner= Partner::where('id',$ads->partner_id)->first();
	  if($partner){
		  $adv_name=$partner->name;
		  $adv_logo=$partner->image;
          $perc=$partner->comission_percentage;
		  $comtype=$partner->comission_type;
	  }else{
		   $ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Campaigns/'.$check->CampaignId.'/Logo');
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
            Storage::disk('public')->put($dir . $check->CampaignId.".png", $data);
        

          }
		  
		  $adv_name=$check->CampaignName;
		  $adv_logo=$check->CampaignId.".png";
		    $amount = BusinessSetting::where(['key' => 'default_commision'])->first();
		   $perc=$amount->value;
		  $comtype=1;
	  }
	   }else{
		   $ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Campaigns/'.$check->CampaignId.'/Logo');
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
            Storage::disk('public')->put($dir . $check->CampaignId.".png", $data);
        

          }
		  
		  $adv_name=$check->CampaignName;
		  $adv_logo=$check->CampaignId.".png";
		   $amount = BusinessSetting::where(['key' => 'default_commision'])->first();
		   $perc=$amount->value;
		   $comtype=1;
	   }
			
			
			
			
		$checkit=Order::where('partner_order_id',$check->Id)->first();
		
		$ex_rate = BusinessSetting::where(['key' => 'impact_rate'])->first()->value;
		$admin_earn=$check->Payout * $ex_rate;
		$calc=($perc*$admin_earn)/100;
			
        $actual_earn=$calc;
		
	 if($check->State=="PENDING"){
			 $status=0;
		 }elseif($check->State=="APPROVED"){
			 $status=1;
		 }else{
			 $status=2;
		 }
		 
	 
	$customer=User::where('id',$check->SubId1)->first();
	  if(!$checkit){
		 	
	   
		$insert=new Order();
		$insert->partner_order_id=$check->Id;
		$insert->advertisers=$adv_name;
		$insert->c_id=$check->CampaignId;
		$insert->logo=$adv_logo;
		$insert->affiliate_partner='impact';
		$insert->order_amount=(int)($check->Amount*$ex_rate);
		$insert->admin_earn=(int)$admin_earn;
		$insert->earning_amount=(int)$actual_earn;
		$insert->order_status=$status;
		$insert->user_id=$check->SubId1;
		$insert->refer_date=date('Y-m-d H:i:s', strtotime($check->ReferringDate));
		$insert->event_date=date('Y-m-d H:i:s', strtotime($check->EventDate));
		$insert->locking_date=date('Y-m-d H:i:s', strtotime($check->EventDate));
		$insert->created_at=now();
		$insert->updated_at=now();
		$insert->save();
		 if($check->State == 'PENDING'){
			  if($comtype==0){
				   $rewards=$calc;
				    $ty="Rewards";
			   }else{
				   $rewards=0;
				    $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->SubId1)->first();
			  $earning->pending_earnings=$earning->pending_earnings+(int)$actual_earn;
			  $earning->updated_at=now();
			  $earning->save();
			  
			  if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Tracked',
                        'description' => $ty.' of '.$actual_earn.' has been tracked.Check My Orders section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		  
		if($check->State != 'REJECTED'){
			
		      $earning4=Earning::where('user_id',$check->SubId1)->first();
			  
			  $earning3=Earning::FindorFail($earning4->id);
			  $earning3->pending_earnings=$earning3->pending_earnings+$calc;
			  $earning3->updated_at=now();
			  $earning3->save();
			 
			   if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => 'Purchase Tracked',
                        'description' => 'New Purchase Tracked Check My Order Section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
			
		}
		  if($check->State == 'APPROVED'){
			  if($comtype==0){
				   $rewards=$calc;
				    $ty="Rewards";
			   }else{
				   $rewards=0;
				    $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->SubId1)->first();
			  $earning->total_earnings=$earning->total_earnings+(int)$actual_earn;
			  $earning->pending_earnings=$earning->pending_earnings-(int)$actual_earn;
			  $earning->rem_earning=$earning->rem_earning+(int)$actual_earn;
			  $earning->reward_earning=$earning->reward_earning+$rewards;
			  $earning->updated_at=now();
			  $earning->save();
			  
			$referral=Referral::where('referred_user_id',$check->SubId1)->first();
			if($referral){
			$per_order = BusinessSetting::where(['key' => 'per_order_refer_percentage'])->first();
			if($per_order){
				       $referral_earning=($per_order->value*$actual_earn)/100;
				       $earning1=Earning::where('user_id',$referral->user_id)->first();
					  $earning1->total_earnings=$earning1->total_earnings+$referral_earning;
					  $earning1->rem_earning=$earning1->rem_earning+$referral_earning;
				      $earning1->referral_earning=$earning1->referral_earning+$referral_earning;
					  $earning1->updated_at=now();
					  $earning1->save();
		         	}
		      }
			  
			  if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Approved',
                        'description' => $ty.' of '.$actual_earn.' has been approved.Check My Earnings or My profile section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		  

		
		}else{
		  if($checkit->order_status != $status){
			  $insert2=Order::FindorFail($checkit->id);
			  $insert2->order_status=$status;
			  $insert2->updated_at=now();
			  $insert2->save(); 
		   
		   if($check->State == 'APPROVED'){
			   if($comtype==0){
				   $rewards=$calc;
				   $ty="Rewards";
			   }else{
				   $rewards=0;
				   $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->SubId1)->first();
			  $earning->total_earnings=$earning->total_earnings+(int)$actual_earn;
			  $earning->rem_earning=$earning->rem_earning+(int)$actual_earn;
			  $earning->pending_earnings=$earning->pending_earnings-(int)$actual_earn;
			  $earning->reward_earning=$earning->reward_earning+(int)$rewards;
			  $earning->updated_at=now();
			  $earning->save();
			   
			$referral=Referral::where('referred_user_id',$check->SubId1)->first();
			if($referral){
			$per_order = BusinessSetting::where(['key' => 'per_order_refer_percentage'])->first();
			if($per_order){
				       $referral_earning=($per_order->value*$actual_earn)/100;
				       $earning1=Earning::where('user_id',$referral->user_id)->first();
					  $earning1->total_earnings=$earning1->total_earnings+$referral_earning;
					  $earning1->rem_earning=$earning1->rem_earning+$referral_earning;
				      $earning1->referral_earning=$earning1->referral_earning+$referral_earning;
					  $earning1->updated_at=now();
					  $earning1->save();
		         	}
		        }
				if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Approved',
                        'description' => $ty.' of '.$actual_earn.' has been approved.Check My Earnings or My profile section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		  if($check->State == 'REJECTED'){
			   if($comtype==0){
				   $rewards=$calc;
				    $ty="Rewards";
			   }else{
				   $rewards=0;
				    $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->SubId1)->first();
			  $earning->pending_earnings=$earning->pending_earnings-$calc;
			  $earning->updated_at=now();
			  $earning->save();
			  
			  if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Rejected',
                        'description' => $ty.' of '.$calc.' has been rejected.You can raise complaint from my order section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		}
	    }
		}	
		}
		return true;

	}
	
	public function cuelinkautofetchorders()
    {
		$end_date = Date('Y-m-d');
        $start_date = date('Y-m-d', strtotime($end_date.' - '.'7'.' days'));
	$today=now();		
	$url = 'https://www.cuelinks.com/api/v2/transactions.json?start_date='.$start_date.'&end_date='.$end_date;
    $ch2 = curl_init($url);
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    $token = $this->apikey;
    $headers[] = "Authorization: Bearer ".$token;
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $result1 = curl_exec($ch2);
    curl_close($ch2);
	$data=json_decode($result1); 
		if($data != NULL){
	$checkee=$data->transactions; 

		
		foreach($checkee as $check){
			$customer=User::where('id',$check->aff_sub)->first();
		 $ads=CuelinkCampaign::where('campaign_id',$check->campaign_id)->first();
	   if($ads){
	  $partner= Partner::where('id',$ads->adv_id)->first();
	  if($partner){
		  $adv_name=$check->store_name;
		  $adv_logo=$partner->image;
		  $perc=$partner->comission_percentage;
		    $comtype=$partner->comission_type;
	  }else{
		  $adv_name=$check->store_name;
		  $adv_logo=NULL;
		    $amount = BusinessSetting::where(['key' => 'default_commision'])->first();
		   $perc=$amount->value;
		    $comtype=1;
	  }
	   }else{
		  $adv_name=$check->store_name;
		  $adv_logo=NULL;
		     $amount = BusinessSetting::where(['key' => 'default_commision'])->first();
		   $perc=$amount->value;
		     $comtype=1;
	  }
		$checkit=Order::where('partner_order_id',$check->id)->first();
		$amount = BusinessSetting::where(['key' => 'default_commision'])->first();
		$perc=$amount->value;
		$ex_rate = BusinessSetting::where(['key' => 'cuelinks_rate'])->first()->value;	
		$uc=$check->user_commission*$ex_rate;
		$calc=($perc*$uc)/100;
		
        $actual_earn=$calc;
		if($check->status=="pending" || $check->status=="validated" ){
			 $status=0;
		 }elseif($check->status=="payable" || $check->status=="claimed"){
			 $status=1;
		 }else{
			 $status=2;
		 }	
	  if(!$checkit){
		$insert=new Order();
		$insert->advertisers=$adv_name;
		$insert->logo=$adv_logo;
		$insert->partner_order_id=$check->id;
		$insert->affiliate_partner='cuelinks';
		$insert->c_id=$check->campaign_id;
		$insert->order_amount=(int)($check->sale_amount*$ex_rate);
		$insert->earning_amount=(int)$actual_earn;
		$insert->admin_earn=(int)$uc;
		$insert->order_status=$status;
		$insert->user_id=$check->aff_sub;   ////sadfsdfdasfsd/fsdfsdfsdfsdf
		$insert->refer_date=date('Y-m-d H:i:s', strtotime($check->transaction_date));
		$insert->event_date=date('Y-m-d H:i:s', strtotime($check->transaction_date));
		$insert->locking_date=date('Y-m-d H:i:s', strtotime($check->transaction_date));
		$insert->created_at=now();
		$insert->updated_at=now();
		$insert->save();
		 
		if($check->status == 'pending' || $check->status=="validated" ){
			  if($comtype==0){
				   $rewards=$calc;
				    $ty="Rewards";
			   }else{
				   $rewards=0;
				    $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->aff_sub)->first();
			  $earning->pending_earnings=$earning->pending_earnings+(int)$actual_earn;
			  $earning->updated_at=now();
			  $earning->save();
			  
			  if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Tracked',
                        'description' => $ty.' of '.$actual_earn.' has been tracked.Check My Orders section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		if($check->status != 'rejected'){
		      $earning3=Earning::where('user_id',$check->aff_sub)->first();
			  $earning3->pending_earnings=$earning3->pending_earnings+$calc;
			  $earning3->updated_at=now();
			  $earning3->save();
			   if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => 'Purchase Tracked',
                        'description' => 'New Purchase Tracked Check My Order Section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		}
		  if($check->status=="payable" || $check->status=="claimed"){
			   if($comtype==0){
				   $rewards=$calc;
				   $ty="Rewards";
			   }else{
				   $rewards=0;
				   $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->aff_sub)->first();
			  $earning->total_earnings=$earning->total_earnings+(int)$actual_earn;
			  $earning->rem_earning=$earning->rem_earning+(int)$actual_earn;
			  $earning->pending_earnings=$earning->pending_earnings-(int)$actual_earn;
			  $earning->reward_earning=$earning->reward_earning+$rewards;
			  $earning->updated_at=now();
			  $earning->save();
			  $referral=Referral::where('referred_user_id',$check->aff_sub)->first();
	     	if($referral){
			$per_order = BusinessSetting::where(['key' => 'per_order_refer_percentage'])->first();
			if($per_order){
				
				      $referral_earning=($per_order->value*$actual_earn)/100;
				      $earning1=Earning::where('user_id',$referral->user_id)->first();
					  $earning1->total_earnings=$earning1->total_earnings+$referral_earning;
					  $earning1->rem_earning=$earning1->rem_earning+$referral_earning;
				      $earning1->referral_earning=$earning1->referral_earning+$referral_earning;
					  $earning1->updated_at=now();
					  $earning1->save();
		         	}
		        }
				
				if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Approved',
                        'description' => $ty.' of '.$actual_earn.' has been approved.Check My Earnings or My profile section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		   
		    return true;
		}else{
		  if($checkit->order_status != $status){
			  $insert=Order::find($checkit->id);
			  $insert->order_status=$status;
			  $insert->updated_at=now();
			  $insert->save(); 
	
		   if($check->status=="payable" || $check->status=="claimed"){
			    if($comtype==0){
				   $rewards=$calc;
				   $ty="Rewards";
			   }else{
				   $rewards=0;
				   $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->aff_sub)->first();
			  $earning->total_earnings=$earning->total_earnings+(int)$actual_earn;
			  $earning->rem_earning=$earning->rem_earning+(int)$actual_earn;
			  $earning->reward_earning=$earning->reward_earning+(int)$rewards;
			  $earning->updated_at=now();
			  $earning->save();
			   $referral=Referral::where('referred_user_id',$check->aff_sub)->first();
		    if($referral){
			$per_order = BusinessSetting::where(['key' => 'per_order_refer_percentage'])->first();
			if($per_order){
				      $referral_earning=($per_order->value*$actual_earn)/100;
				      $earning1=Earning::where('user_id',$referral->user_id)->first();
					  $earning1->total_earnings=$earning1->total_earnings+$referral_earning;
					  $earning1->rem_earning=$earning1->rem_earning+$referral_earning;
				      $earning1->referral_earning=$earning1->referral_earning+$referral_earning;
					  $earning1->updated_at=now();
					  $earning1->save();
		         	}
		        }
				
				if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Approved',
                        'description' => $ty.' of '.$actual_earn.' has been approved.Check My Earnings or My profile section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		  if($check->status == 'rejected'){
			   if($comtype==0){
				   $rewards=$calc;
				   $ty="Rewards";
			   }else{
				   $rewards=0;
				   $ty="Cashback";
			   }
			  $earning=Earning::where('user_id',$check->aff_sub)->first();
			  $earning->pending_earnings=$earning->pending_earnings-$calc;
			  $earning->updated_at=now();
			  $earning->save();
			  
			   if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => $ty.' Rejected',
                        'description' => $ty.' of '.$calc.' has been rejected.You can raise complaint from my order section.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
		  }
		  }
	    }
			
		}
		return true;

	}else{
			return false;
		}
	}
	
	
}