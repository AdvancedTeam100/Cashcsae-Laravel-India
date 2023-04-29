<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Complain;
use App\Models\Referral;

use App\Models\WithdrawalReq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class ReferralController extends Controller
{
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
	}

  
	public function referrals(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
		 ], [
			'user_id.required'=>'user id is required',
		 ]);
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		
		$check=Referral::with('user','referraluser')->where('user_id',$request->user_id)->get();
		
		
		$arr = array('status'=>1, 'data'=>'Referrals','count'=>count($check),'data'=>$check);
        return response()->json($arr);
		
	}
	



   
}