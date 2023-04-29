<?php

namespace App\Http\Controllers\Api\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\BusinessSetting;
use App\Models\EmailVerifications;
use App\Models\User;
use App\Models\Referral;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\AddCustomerMail;

class CustomerAuthController extends Controller
{
    public function verify_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' =>'required|min:10|max:14',
            'otp'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
        $user = User::where('phone', $request->phone)->first();
        if($user) {
          

            $data = DB::table('phone_verifications')->where([
                'phone' =>$request['phone'],
                'token' =>$request['otp'],
            ])->first();

            if($data) {
			 if($user->is_phone_verified == "0"){
                DB::table('phone_verifications')->where([
                    'phone' =>$request['phone'],
                    'token' =>$request['otp'],
                ])->delete();
                $user->is_phone_verified = 1;
				$user->cm_firebase_token = $request->device_id;
                $user->save();
                 $token = $user->createToken('StoreCustomerAuth')->accessToken;
              
				$newuser = User::where('phone', $request->phone)->first();
				 if($request->referral_user_id != NULL){
					  $order_amount=BusinessSetting::where('key','signup_refer')->first();
				if($order_amount){
                 $amount=$order_amount->value;
				}
				else{
				  $amount=1;
				  }
				$referral=new Referral();
				$referral->user_id=$request->referral_user_id;
				$referral->earn=$amount;
				$referral->referred_user_id=$user->id;
				$referral->save();
					$prevearning=DB::table('earnings')->where('user_id',$request->referral_user_id)->first();
				   $earning=DB::table('earnings')->where('user_id',$request->referral_user_id)->Update([
							'total_earnings'=>$prevearning->total_earnings+$amount,
					         'rem_earning'=>$prevearning->rem_earning+$amount,
					        'referral_earning'=>$prevearning->referral_earning+$amount,
							'updated_at'=>now()
							]);
				 }
				 
                  $earning=DB::table('earnings')->Insert([
							'user_id'=>$user->id,
							'created_at'=>now(),
							'updated_at'=>now()
							]);
				
                  return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
                }else{
				 $user->is_phone_verified = 1;
				$user->cm_firebase_token = $request->device_id;
                $user->save();
                 $token = $user->createToken('StoreCustomerAuth')->accessToken;
					$earning=Earning::where('user_id',$user->id)->first();
					if(!$earning){
						     $earning=DB::table('earnings')->Insert([
							'user_id'=>$user->id,
							'created_at'=>now(),
							'updated_at'=>now()
							]);
					}
                     return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
                }
               
           }else{
                return response()->json([
                    'message' =>'phone_number_and_otp_not_matched'
                ], 404);
            }
           
        }
        return response()->json([
            'message' =>'Not Found'
        ], 404);

    }
	
	
	
	public function verify_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required',
            'otp'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
        $user = User::where('email', $request->email)->first();
        if($user) {
          

            $data = DB::table('phone_verifications')->where([
                'email' =>$request['email'],
                'token' =>$request['otp'],
            ])->first();

            if($data) {
			 if($user->is_phone_verified == "0"){
                DB::table('phone_verifications')->where([
                    'email' =>$request['email'],
                    'token' =>$request['otp'],
                ])->delete();
                $user->is_phone_verified = 1;
				$user->cm_firebase_token = $request->device_id;
                $user->save();
                 $token = $user->createToken('StoreCustomerAuth')->accessToken;
              
				$newuser = User::where('email', $request->email)->first();
				 if($request->referral_user_id != NULL){
					  $order_amount=BusinessSetting::where('key','signup_refer')->first();
				if($order_amount){
                 $amount=$order_amount->value;
				}
				else{
				  $amount=1;
				  }
				$referral=new Referral();
				$referral->user_id=$request->referral_user_id;
				$referral->earn=$amount;
				$referral->referred_user_id=$user->id;
				$referral->save();
					$prevearning=DB::table('earnings')->where('user_id',$request->referral_user_id)->first();
				   $earning=DB::table('earnings')->where('user_id',$request->referral_user_id)->Update([
							'total_earnings'=>$prevearning->total_earnings+$amount,
					         'rem_earning'=>$prevearning->rem_earning+$amount,
					        'referral_earning'=>$prevearning->referral_earning+$amount,
							'updated_at'=>now()
							]);
				 }
				 
                  $earning=DB::table('earnings')->Insert([
							'user_id'=>$user->id,
							'created_at'=>now(),
							'updated_at'=>now()
							]);
				
                  return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
                }else{
				 $user->is_phone_verified = 1;
				$user->cm_firebase_token = $request->device_id;
                $user->save();
                 $token = $user->createToken('StoreCustomerAuth')->accessToken;
					$earning=Earning::where('user_id',$user->id)->first();
					if(!$earning){
						     $earning=DB::table('earnings')->Insert([
							'user_id'=>$user->id,
							'created_at'=>now(),
							'updated_at'=>now()
							]);
					}
                     return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
                }
               
           }else{
                return response()->json([
                    'message' =>'phone_number_and_otp_not_matched'
                ], 404);
            }
           
        }
        return response()->json([
            'message' =>'Not Found'
        ], 404);

    }
	
	 

    public function check_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }


        if (BusinessSetting::where(['key'=>'email_verification'])->first()->value){
            $token = rand(1000, 9999);
            DB::table('email_verifications')->insert([
                'email' =>$request['email'],
                'token' =>$token,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
            Mail::to($request['email'])->send(new EmailVerification($token));

            return response()->json([
                'message' =>'Email is ready to register',
                'token' =>'active'
            ], 200);
        }else{
            return response()->json([
                'message' =>'Email is ready to register',
                'token' =>'inactive'
            ], 200);
        }
    }

    public function verify_email2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }

        $verify = EmailVerifications::where(['email' =>$request['email'], 'token' =>$request['token']])->first();

        if (isset($verify)) {
            $verify->delete();
            return response()->json([
                'message' =>'Token Verified',
            ], 200);
        }

        $errors = [];
        array_push($errors, ['code' =>'token', 'message' =>'Token Not Found']);
        return response()->json(['errors' =>$errors ]
        , 404);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' =>'required',
            'l_name' =>'required',
            'phone' =>'required'
        ], [
            'f_name.required' =>'The first name field is required.',
            'l_name.required' =>'The last name field is required.'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
         if ($request->has('image')) {
            $imageName = Helpers::upload('profile/', 'png', $request->file('image'));
        }else{
			 $imageName=NULL;
		 }
        $check = User::where('phone', $request->phone)->first();
        if($check){
        if($check->reg_completed == "not_completed"){
        $user = User::where('phone', $request->phone)->update([
            'f_name' =>$request->f_name,
            'l_name' =>$request->l_name,
            'email' =>$request->email,
			'image'=>$imageName,
			'cm_firebase_token'=>$request->device_id,
            'phone' =>$request->phone,
            'password'=>bcrypt("12345"),
            'reg_completed' =>"completed",
        ]);
       
         $user = User::where('phone', $request->phone)->first();
        $token = $user->createToken('StoreCustomerAuth')->accessToken;
      
         
        return response()->json(['token' =>$token,'is_phone_verified' =>1, 'user'=>$user ], 200);
        }else{
            
             $token = $check->createToken('StoreCustomerAuth')->accessToken;
              return response()->json(['token' =>$token,'is_phone_verified' =>1, 'user'=>$check ], 200);
        }
        }else{
            $errors = [];
            array_push($errors, ['code' =>'auth-001', 'message' =>'Unauthorized']);
            return response()->json([
                'errors' =>$errors
            ], 401); 
        }
    }
    
    
     public function register_step1(Request $request)
    {
		  
		 
       if($request->phone == NULL){
           $errors = [];
                array_push($errors, ['code' =>'400', 'message' =>'Phone number is required']);
                return response()->json([
                    'errors' =>$errors
                ], 403);
       }
        $user = User::where('phone', $request->phone)->first();
    
        if($user)
        {
            if($user->is_phone_verified)
            {
                
                $token = $user->createToken('StoreCustomerAuth')->accessToken;

     
            $otp = "success";
           
            DB::table('phone_verifications')->updateOrInsert(['phone' =>$request['phone']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]); 

             
                 return response()->json(['token' =>$token,'is_phone_verified' =>1,'message'=>"verify otp", 'phone_verify_end_url'=>"api/auth/verify-phone" ], 200);

            }else{
                  $token = $user->createToken('StoreCustomerAuth')->accessToken;
            $otp = "success";
           
            DB::table('phone_verifications')->updateOrInsert(['phone' =>$request['phone']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]); 

            
                 return response()->json(['token' =>$token,'is_phone_verified' =>0,'message'=>"verify otp", 'phone_verify_end_url'=>"api/auth/verify-phone" ], 200);
                
            }
        }else{    
        $customer_verification = 1;
        $user = User::create([
            'email' =>NULL,
			'cm_firebase_token'=>$request->device_id,
            'phone' =>$request->phone,
			'password'=>bcrypt('123456'),
            'reg_completed' =>"not_completed",
        ]);

        $token = $user->createToken('StoreCustomerAuth')->accessToken;
            $otp = "success";
		   
            DB::table('phone_verifications')->updateOrInsert(['phone' =>$request['phone']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]);
        return response()->json(['token' =>$token,'is_phone_verified' =>0,'message'=>"verify otp via firebase", 'phone_verify_end_url'=>"api/auth/verify-phone" ], 200);
			   
        }
		
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' =>'required',
            'password' =>'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }

        $data = [
            'phone' =>$request->phone,
            'password' =>$request->password
        ];
        $customer_verification = 1;
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('StoreCustomerAuth')->accessToken;
            if(!auth()->user()->status)
            {
                $errors = [];
                array_push($errors, ['code' =>'auth-003', 'message' =>'Your Account is blocked']);
                return response()->json([
                    'errors' =>$errors
                ], 403);
            }
           
            
            return response()->json(['token' =>$token, 'is_phone_verified'=>auth()->user()->is_phone_verified], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' =>'auth-001', 'message' =>'Unauthorized']);
            return response()->json([
                'errors' =>$errors
            ], 401);
        }
    }
	
	
	

}
