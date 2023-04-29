<?php
namespace App\Http\Controllers\Api\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\AddCustomerMail;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthCustomerController extends Controller
{
	public function social_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' => 'required|string|email|max:255',
			'device_id'=>'required',
			'social_id'=>'required'
        ], [
            'name.required' =>'The name field is required.',
			'device_id.required'=>'Device Id required',
			'email.required'=>'Email ID registerd',
			'social_id.required'=>'Social Id field required'
        ]);
		 if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
        $check=User::where('social_id',$request->social_id)->first();
		  $user=User::where('social_id',$request->social_id)->first();
		if($check){
			 $tokenResult    = $user->createToken('Personal Access Token');
            $token          = $tokenResult->accessToken;
           
           return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
		}else{
        $check2=User::where('email',$request->email)->first();
	 if(!$check2){
        if ($request->image) {
			
			$dir = 'user/';
			 $url = $request->image;
             $name = Str::random(10) . '.png';
             $image = file_get_contents($url);
             $imageName=$name;
			if (!Storage::disk('public')->exists($dir)) {
					 Storage::disk('public')->makeDirectory($dir);
			}
			Storage::disk('public')->put($dir . $imageName, $image);
			 

           
        }else{
			 $imageName=NULL;
		 }
		
         $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
			'cm_firebase_token'=>$request->device_id,
            'phone' =>$request->phone,
			'register_via'=>$request->type,
			'social_id'=>$request->social_id,
            'image'=>$imageName,
		    'verified'=>1,
			'is_phone_verified'=>1,
			'password'=>bcrypt(12345678),
        ]);
       
        $token = $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] = $request->email;

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
          $user=User::where('id',$user->id)->first();
        if($user) {
            return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
        } else {
            return response()->json(['data'=> $success, "message" => "Problem in registering User", "status" => 0]);
        }
		}else{
		      $ch=User::where('email',$request->email)->update(['social_id'=>$request->social_id,'verified'=>1]);
		    $user=User::where('email',$request->email)->first();
			  $tokenResult    = $user->createToken('Personal Access Token');
				$token          = $tokenResult->accessToken;
				$user=User::where('id',$check2->id)->first();
				 return response()->json(['token' =>$token, 'is_phone_verified'=>$user->is_phone_verified,'message'=>"logged in successfully", 'user'=>$user], 200);
	      }
		}


    }
	
	
	 public function login_with_email(Request $request)
    {
		  $validator = Validator::make($request->all(), [
            
			'device_id'=>'required',
			 'email'=>'required'
        ], [
          
			'device_id.required'=>'Device Id required',
			'email.required'=>'Email Id required'
        ]);
         $chars2 = "0123456789";
                $otp = "";
                for ($i = 0; $i < 6; $i++){
                    $otp .= $chars2[mt_rand(0, strlen($chars2)-1)];
                }    
        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
		 
       if($request->email == NULL){
           $errors = [];
                array_push($errors, ['code' =>'400', 'message' =>'Email is required']);
                return response()->json([
                    'errors' =>$errors
                ], 403);
       }
        $user = User::where('email', $request->email)->first();
    
        if($user)
        {
            if($user->is_phone_verified)
            {
                
        $token = $user->createToken('StoreCustomerAuth')->accessToken;
				 DB::table('phone_verifications')->updateOrInsert(['email' =>$request['email']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]); 
				$success['name'] = $request->email;
			$success['email'] = $request->email;
			$success['otp'] = $otp;
			 Mail::to($success['email'])->send(new AddCustomerMail($success));
                  return response()->json(['token' =>$token,'is_phone_verified' =>1,'message'=>"verify otp", 'phone_verify_end_url'=>"api/auth/verify-phone" ], 200);

            }else{
                  $token = $user->createToken('StoreCustomerAuth')->accessToken;
            $otp = "success";
           
            $user = User::where('id',$user->id)->update([
            'is_phone_verified' =>1
           ]);
				
			 DB::table('phone_verifications')->updateOrInsert(['email' =>$request['email']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]); 
			  $success['name'] = $request->email;
			$success['email'] = $request->email;
			$success['otp'] = $otp;
			 Mail::to($success['email'])->send(new AddCustomerMail($success));	
             $user = User::where('email', $request->email)->first();
                  return response()->json(['token' =>$token,'is_phone_verified' =>0,'message'=>"verify otp", 'phone_verify_end_url'=>"api/auth/verify-email" ], 200);
                
            }
        }else{    
        $customer_verification = 1;
		$user= new User();
		$user->email=$request->email;
		$user->cm_firebase_token=$request->device_id;
		$user->password=bcrypt('123456');
		$user->save();
       
          
			$token = $user->createToken('StoreCustomerAuth')->accessToken;
			
			DB::table('phone_verifications')->updateOrInsert(['email' =>$request['email']],
                [
                'token' =>$otp,
                'created_at' =>now(),
                'updated_at' =>now(),
                ]); 
			$success['name'] = $request->email;
			$success['email'] = $request->email;
			$success['otp'] = $otp;
			 Mail::to($success['email'])->send(new AddCustomerMail($success));
         return response()->json(['token' =>$token,'is_phone_verified' =>0,'message'=>"verify otp", 'phone_verify_end_url'=>"api/auth/verify-email" ], 200);
			   
        }
		
    }
	
	
	
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'phone' =>'required',
            'email' => 'required|string|email|max:255|unique:users',
			'device_id'=>'required'
        ], [
            'name.required' =>'The name field is required.',
            'phone.required' =>'The phone field is required.',
			'device_id.required'=>'Device Id required',
			'email.unique'=>'Email All ready registerd'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' =>Helpers::error_processor($validator)], 403);
        }
        if ($request->has('image')) {
            $imageName = Helpers::upload('profile/', 'png', $request->file('image'));
        }else{
			 $imageName=NULL;
		 }
        //  dd($request);
         $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
			'cm_firebase_token'=>$request->device_id,
            'phone' =>$request->phone,
            'image'=>$imageName,
			'password'=>bcrypt($request->password),
        ]);
       
        $token = $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] = $request->email;

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        if($user) {
            $success['user_password'] = $request->password;
           Mail::to($success['email'])->send(new AddCustomerMail($success));
            return response()->json(['data'=> $success, 'id'=>$user, "message" => "User Registered successfully", "status" => 1]);
        } else {
            return response()->json(['data'=> $success, "message" => "Problem in registering User", "status" => 0]);
        }


    }
    public function verifyAccount($token) {
        $verifyUser = UserVerify::where('token', $token)->first();
      
        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            // dd($user);
            if($user->verified == 0) {
              
                $verifyUser->user->verified = 1;
                $date = date("Y-m-d g:i:s");
                $verifyUser->user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
                $verifyUser->user->save();
              
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        // dd($user);
        return response()->json([$message]);

    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email',
            'password'      => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 1, 'message' => $validator->messages()]);
        }
        
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user       = Auth::guard('web')->user();
            if($user->status!=1){
                return response()->json([
                    'status'    => 2,
                    'message'   => 'The user is blocked/deactivated. Please contact Admin.'
                ]);
            }
            $tokenResult    = $user->createToken('Personal Access Token');
            $token          = $tokenResult->accessToken;
            $user = [
                'id' => $user->id,
                'status' => $user->status,
                'email' => $user->email,
                'name' => $user->name,
                'phone' => $user->phone,
                'profile_image' => ($user->image != "NULL" && $user->image != "") ? asset('/profile/'.$user->image) : "",
            ];
            return response()->json([
                'status'    => 1,
                'message'   => 'You have logged in successfully!',
                'user_data'     => $user,
                'token'     => $token,
            ]);
        }
        return response()->json([
            'status'    => 0,
            'message'   => 'This email is not registered. Please register first...'
        ]);
    }
}
?>