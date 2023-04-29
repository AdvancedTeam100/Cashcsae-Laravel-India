<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Order;
use App\Models\Click;
use App\Models\Earning;
use App\Models\BankDetail;
use App\Models\WithdrawalReq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class UserController extends Controller
{
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
		$this->channel_id=$cuelink->channel_id;
		$admitad=DB::table('admitad')->first();
		$this->client_id = $admitad->client_id;  
		$this->client_secret = $admitad->client_secret;
		$this->base64code = $admitad->base64code;
		$this->website_id = $admitad->website_id;
		$this->scope="advcampaigns_for_website deeplink_generator advcampaigns banners websites manage_opt_codes";
	}

    public function add_bank_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'holder_name' => 'required',
			'ac_no' => 'required|unique:bank_details|max:100',
            'bank_name' => 'required',
			'ifsc'=>'required',
           
        ], [
			'user_id.required'=>'user id is required',
			'holder_name.required' => 'Account holder Name is required!',
			'ac_no.required' =>'Account number is required',
			'bank_name.required' =>'Bank Name is required',
			'ifsc.required'=>'IFSC code is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
		if($bankdetails){
					$bank=BankDetail::find($bankdetails->id);
					$bank->user_id = $request->user_id;
					$bank->ac_holder_name = $request->holder_name;
					$bank->ac_no = $request->ac_no;
					$bank->bank_name =$request->bank_name;
					$bank->ifsc = $request->ifsc;
					$bank->upi = $request->upi;		
					$bank->paytm_no = $request->paytm_no;	
					$bank->created_at = now();		
					$bank->updated_at = now();	
					$bank->save();
		}else{
					$bank = new BankDetail();
					$bank->user_id = $request->user_id;
					$bank->ac_holder_name = $request->holder_name;
					$bank->ac_no = $request->ac_no;
					$bank->bank_name =$request->bank_name;
					$bank->ifsc = $request->ifsc;
					$bank->upi = $request->upi;		
					$bank->paytm_no = $request->paytm_no;	
					$bank->created_at = now();		
					$bank->updated_at = now();	
					$bank->save();
		}
        $arr = array('status'=>1, 'data'=>'Bank Details Added/Updated Successfully', 'data'=>$bank);
        return response()->json($arr);
    }
	
	
	
	
	   public function add_upi_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'upi' => 'required'
        ], [
			'user_id.required'=>'user id is required',
			'upi.required'=>'UPI code is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
		if($bankdetails){
					$bank=BankDetail::find($bankdetails->id);
					$bank->user_id = $request->user_id;
					$bank->upi = $request->upi;			
					$bank->updated_at = now();	
					$bank->save();
		}else{
					$bank = new BankDetail();
					$bank->user_id = $request->user_id;
					$bank->upi = $request->upi;
					$bank->created_at = now();		
					$bank->updated_at = now();	
					$bank->save();
		}
        $arr = array('status'=>1, 'data'=>'UPI Added/Updated Successfully' , 'data'=>$bank);
        return response()->json($arr);
    }
	
	
	 public function add_paytm_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'paytm_no' => 'required'
        ], [
			'user_id.required'=>'user id is required',
			'paytm_no.required'=>'Paytm Number is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
		if($bankdetails){
					$bank=BankDetail::find($bankdetails->id);
					$bank->user_id = $request->user_id;
					$bank->paytm_no = $request->paytm_no;			
					$bank->updated_at = now();	
					$bank->save();
		}else{
					$bank = new BankDetail();
					$bank->user_id = $request->user_id;
					$bank->paytm_no = $request->paytm_no;
					$bank->created_at = now();		
					$bank->updated_at = now();	
					$bank->save();
		}
        $arr = array('status'=>1, 'data'=>'Paytm Number Added/Updated Successfully', 'data'=>$bank);
        return response()->json($arr);
    }
	
	 public function add_amazon_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'amazon_no' => 'required'
        ], [
			'user_id.required'=>'user id is required',
			'amazon_no.required'=>'Amazon Pay Number is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
		if($bankdetails){
					$bank=BankDetail::find($bankdetails->id);
					$bank->user_id = $request->user_id;
					$bank->amazon_no = $request->amazon_no;			
					$bank->updated_at = now();	
					$bank->save();
		}else{
					$bank = new BankDetail();
					$bank->user_id = $request->user_id;
					$bank->amazon_no = $request->amazon_no;
					$bank->created_at = now();		
					$bank->updated_at = now();	
					$bank->save();
		}
        $arr = array('status'=>1, 'data'=>'Amazon Number Added/Updated Successfully', 'data'=>$bank);
        return response()->json($arr);
    }
	  public function get_bank_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required'
           
        ], [
			'user_id.required'=>'user id is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
        $arr = array('status'=>1, 'data'=>$bankdetails);
        return response()->json($arr);
    }
	
	 public function get_tracking_link(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
			'url'=>'required',
            'type'=>'required',
			'c_id'=>'required_if:type,impact,admitad',
           
        ], [
			'user_id.required'=>'user id is required',
			 'url.required'=>'url is required',
			 'type.required'=>'Type is required',
			 'c_id.required'=>'c_id is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		if($request->type == "impact" || $request->type == "Impact" || $request->type == "IMPACT"){
		$today=now();		
		$client_id = $this->sid;
		$secret =$this->token;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/Programs/'.$request->c_id.'/TrackingLinks');
		curl_setopt($ch, CURLOPT_POST, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS,
            "DeepLink=".$request->url."&Type=regular&subId1=".$request->user_id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		$data=json_decode($response);	 
        $arr = array('status'=>1, 'tracking_link'=>$data->TrackingURL);
        return response()->json($arr);
		}elseif($request->type == "admitad" || $request->type == "Admitad" || $request->type == "ADMITAD"){

			
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
    
            $url = "https://api.admitad.com/deeplink/".$this->website_id."/advcampaign/".$request->c_id."/?subid=".$request->user_id."&ulp=".$request->url;
    
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
				$arr = array('status'=>1, 'tracking_link'=>$res[0]);
				return response()->json($arr); 
				 
			}
		 }else{
	 $url = 'https://www.cuelinks.com/api/v2/links.json?url='.$request->url.'&channel_id='.$this->channel_id.'&shorten=true&subid='.$request->user_id;
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
        $arr = array('status'=>1, 'tracking_link'=>$dataw->affiliate_url);
        return response()->json($arr);
    }
	 }
	

	
	
	 
	
	
	public function add_click(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'name' => 'required',
			'image'=> 'required',
		     'tracking_link'=>'required'
        ], [
			'user_id.required'=>'user id is required',
			'name.required'=>'name required',
			'image.required'=>'image required',
			 'tracking_link.required'=>'tracking link required',
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		

					$click = new Click();
					$click->user_id = $request->user_id;
					$click->name = $request->name;
					$click->image = $request->image;
		            $click->tracking_link = $request->tracking_link;
					$click->created_at = now();		
					$click->updated_at = now();	
					$click->save();
		
        $arr = array('status'=>1, 'data'=>'Click updated Successfully');
        return response()->json($arr);
    }
	
	public function get_click(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required'
        ], [
			'user_id.required'=>'user id is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		

		$click = Click::where('user_id',$request->user_id)->orderBy('id','desc')->get();
		
		
        $arr = array('status'=>1, 'data'=>'User Clicks','data'=>$click);
        return response()->json($arr);
    }
	
	public function my_profile(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required'
        ], [
			'user_id.required'=>'user id is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		

		$click = User::with('earning','withdrawal_request','bank_detail')->where('id',$request->user_id)->orderBy('id','desc')->first();
		
		
        $arr = array('status'=>1, 'data'=>'User Clicks','data'=>$click);
        return response()->json($arr);
    }
	
	public function send_withdrawal_request(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
			'medium'=>'required'
        ], [
			'user_id.required'=>'user id is required',
			'medium.required'=>'withdrawal medium is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		
		$check=WithdrawalReq::where('user_id',$request->user_id)->where('approved',0)->first();
		if($check){
			$arr = array('status'=>0, 'data'=>'One Withdrawal request is in pending state wait for it is getting approved.');
              return response()->json($arr);
		}
		$earning=Earning::where('user_id',$request->user_id)->first();
		
        $min = BusinessSetting::where(['key' => 'minimum_redeem'])->first()->value;
		if($min > $earning->rem_earning){
		$arr = array('status'=>0, 'data'=>'You cannot send withdrawal request if you have remaining earning is less than '.$min);
        return response()->json($arr);
		}  
		$earnings=Earning::find($earning->id);
		$earnings->rem_earning=$earning->rem_earning-$earning->rem_earning;
		$earnings->sent_for_withdrawal=$earning->rem_earning;
		$earnings->save();
		$bank=BankDetail::where('user_id',$request->user_id)->first();
		if($request->medium == "bank" || $request->medium == "Bank" || $request->medium == "BANK"){
			$medium="Bank";
			$details="<b> Bank name = </b>".$bank->bank_name.",<br><b> Account Number = </b>".$bank->ac_no.", <br><b> Account Holder Name = </b>".$bank->ac_holder_name.",<br><b> IFSC = </b>".$bank->ifsc;
			
		}else if($request->medium == "upi" || $request->medium == "Upi" || $request->medium == "UPI"){
			$medium="UPI";
			$details="<b>UPI = </b>".$bank->upi;
			
		}else if($request->medium == "paypal" || $request->medium == "Paypal" || $request->medium == "PAYPAL"){
			$medium="Paypal";
			$details="<b>Paypal Email = </b>".$bank->paypal_email;
			
		}else if($request->medium == "amazon" || $request->medium == "Amazon" || $request->medium == "AMAZON"){
			$medium="Amazon";
			$details="<b>Amazon Pay Number = </b>".$bank->amazon_no;
			
		}else{
			$medium="Paytm";
			$details="<b>Paytm Number = </b>".$bank->paytm_no;
			
		}
		$wr=WithdrawalReq::where('user_id',$request->user_id)->where('approved',0)->first();
		if($wr){
		 $arr = array('status'=>1, 'data'=>'Withrawal request already sent! wait till it gets approved/rejected');
           return response()->json($arr);
		}
		$withdrawals=new WithdrawalReq();
		$withdrawals->user_id=$request->user_id;
		$withdrawals->amount=$earning->rem_earning;
		$withdrawals->medium=$medium;
		$withdrawals->medium_details=$details;
		$withdrawals->approved=0;
		$withdrawals->created_at=now();
		$withdrawals->updated_at=now();
		$withdrawals->save();
		
        $arr = array('status'=>1, 'data'=>'Withrawal request sent');
        return response()->json($arr);
    }
	
	public function payment_history(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required'
		 ], [
			'user_id.required'=>'user id is required'
		 ]);
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		
		$history=WithdrawalReq::with('user')->where('user_id',$request->user_id)->whereIn('approved',[1,2])->orderBy('id','desc')->get();
		$arr = array('status'=>1, 'data'=>'Payment History', 'data'=>$history);
        return response()->json($arr);
		
	}
	public function order_history(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required'
		 ], [
			'user_id.required'=>'user id is required'
		 ]);
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		
		$history=Order::with('user')->where('user_id',$request->user_id)->orderBy('id','desc')->get();
		$arr = array('status'=>1, 'data'=>'Payment History', 'data'=>$history);
        return response()->json($arr);
		
	}
	
	  public function add_paypal_detail(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'paypal_email' => 'required'
        ], [
			'user_id.required'=>'user id is required',
			'paypal_email.required'=>'Paypal Email is required'
		 ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$bankdetails=BankDetail::where('user_id',$request->user_id)->first();
		if($bankdetails){
					$paypal=BankDetail::find($bankdetails->id);
					$paypal->user_id = $request->user_id;
					$paypal->paypal_email = $request->paypal_email;			
					$paypal->updated_at = now();	
					$paypal->save();
		}else{
					$paypal = new BankDetail();
					$paypal->user_id = $request->user_id;
					$paypal->paypal_email = $request->paypal_email;
					$paypal->created_at = now();		
					$paypal->updated_at = now();	
					$paypal->save();
		}
        $arr = array('status'=>1, 'data'=>'Paypal Details Added/Updated Successfully' , 'data'=>$paypal);
        return response()->json($arr);
    }
	
	
	 public function remove_user(Request $request)
    {
		 if (!$request->hasHeader('userId')) {
            $errors = [];
            array_push($errors, ['code' => 'userId', 'message' => 'User Id is required']);
            return response()->json([
                'errors' => $errors
            ], 403);
        }
		$user_id=$request->hasHeader('userId');
      
		$bankdetails=BankDetail::where('user_id',$user_id)->delete();
		$user=User::where('id',$user_id)->delete();
		$click=Click::where('user_id',$user_id)->delete();
		$wr=WithdrawalReq::where('user_id',$user_id)->delete();
		$or=Order::where('user_id',$user_id)->delete();
		
        $arr = array('status'=>1, 'data'=>'Your Account has been removed Successfully');
        return response()->json($arr);
    }


   
}