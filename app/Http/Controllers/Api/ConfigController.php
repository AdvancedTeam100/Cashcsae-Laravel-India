<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\AdNetwork;
use App\Models\User;
use App\Models\Click;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{

    public function configuration()
    {
		
		$chck=BusinessSetting::where(['key' => 'currency'])->first()->value;
		$curren=Currency::where('currency_code',$chck)->first();
		
        return response()->json([
			'admob' => AdNetwork::where(['key' => 'admob'])->first()->value,
			'facebook_ad' => AdNetwork::where(['key' => 'facebookad'])->first()->value,
            'business_name' => BusinessSetting::where(['key' => 'business_name'])->first()->value,
			'per_order_refer_percentage' => BusinessSetting::where(['key' => 'per_order_refer_percentage'])->first()->value,
			'signup_referrer_earning' => BusinessSetting::where(['key' => 'signup_refer'])->first()->value,
            'logo' => BusinessSetting::where(['key' => 'logo'])->first()->value,
			'minimum_redeem_value' => BusinessSetting::where(['key' => 'minimum_redeem'])->first()->value,
			'phone_code' => BusinessSetting::where(['key' => 'phone_code'])->first()->value,
			'country' => BusinessSetting::where(['key' => 'country'])->first()->value,
			'currency' => $curren->currency_symbol,
            'base_urls' => [
				'order_image_url' => asset('storage/app/public/order'),
				'notification_image_url' => asset('storage/app/public/notification'),
				'faq_image_url' => asset('storage/app/public/faq'),
                'offer_image_url' => asset('storage/app/public/offer'),
                'partner_image_url' => asset('storage/app/public/partner'),
				'banner_image_url' => asset('storage/app/public/banner'),
                'user_image_url' => asset('storage/app/public/user'),
                'category_image_url' => asset('storage/app/public/category'),
                'business_logo_url' => asset('storage/app/public/info'),
				'coupon_banner_url' => asset('storage/app/public/coupon'),
                'product_image_url' => asset('storage/app/public/product'),
                'product_site_url' => asset('storage/app/public/partner'),

            ]
        ]);
    }

   public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'user_id'=>'required',
            'name' => 'required',
            'email' => 'required',
			'phone' => 'required'
        ], [
			'user_id.required' => 'user_id is required!',
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
			'phone.required' => 'Phone is required!',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
	   $users=User::where('email',$request->email)->where('id','!=',$request->user_id)->first();
	   if($users){
		   return response()->json(['status'=>0, 'message' => 'email already exists with other account'], 403);
	   }
        $user=User::where('id',$request->user_id)->first();
        $image = $request->file('user_profile');
  
        if ($request->has('user_profile')) {
            $imageName = Helpers::update('user/', $user->image, 'png', $request->file('user_profile'));
        } else {
            $imageName = $user->image;
        }

        if ($request['password'] != null && strlen($request['password']) > 5) {
            $pass = bcrypt($request['password']);
        } else {
            $pass = $user->password;
        }

        $userDetails = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $imageName,
            'password' => $pass,
            'updated_at' => now()
        ];

         $uu = User::where(['id' => $request->user_id])->update($userDetails);
	   $user=User::where(['id' => $request->user_id])->first();
        if($uu){
        return response()->json(['status'=>1,'message' => 'successfully updated' , 'data'=>$user], 200);
		}else{
			return response()->json(['status'=>0, 'message' => 'nothing to update'], 200);
		}
    }
	

	 public static function get_settings($name)
    {
        $config = null;
        $data = BusinessSetting::where(['key' => $name])->first();
        if (isset($data)) {
            $config = json_decode($data['value'], true);
            if (is_null($config)) {
                $config = $data['value'];
            }
        }
        return $config;
    }
	
	 public function about_us()
    {
		 $about_us= BusinessSetting::where(['key' => 'about_us'])->first()->value;
		
       $arr = array('status'=>1, 'data'=>$about_us);
        return response()->json($arr);
    }
	
	 public function privacy_policy()
    {
		 $about_us= BusinessSetting::where(['key' => 'privacy_policy'])->first()->value;
		
       $arr = array('status'=>1, 'data'=>$about_us);
        return response()->json($arr);
    }
	
	
	 public function deleteclicks(Request $request)
    {
		 
        $validator = Validator::make($request->all(), [
			'user_id'=>'required'
        ], [
			'user_id.required' => 'user_id is required!'
        ]);
     
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
		 $user_id=$request->user_id;
		 $clicks= Click::where('created_at', '<=', Carbon::now()->subDays(10)->toDateTimeString())
			 ->where('user_id',$user_id)->delete();
		
        if($clicks){
        return response()->json(['status'=>1,'message' => 'successfully deleted clicks older then 10 days'], 200);
		}else{
			return response()->json(['status'=>1, 'message' => 'nothing to delete'], 200);
		}
    }
	
	
	
	 public function deleteallclicks(Request $request)
    {
		 
        $validator = Validator::make($request->all(), [
			'user_id'=>'required'
        ], [
			'user_id.required' => 'user_id is required!'
        ]);
     
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
		 $user_id=$request->user_id;
		 $clicks= Click::where('user_id',$user_id)->delete();
		
        if($clicks){
        return response()->json(['status'=>1,'message' => 'successfully deleted clicks older then 10 days'], 200);
		}else{
			return response()->json(['status'=>1, 'message' => 'nothing to delete'], 200);
		}
    }
}
