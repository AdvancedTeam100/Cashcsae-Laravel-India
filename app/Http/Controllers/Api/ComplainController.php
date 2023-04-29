<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Complain;
use App\Models\Earning;
use App\Models\BankDetail;
use App\Models\WithdrawalReq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class ComplainController extends Controller
{
	public function __construct(){
		$impact= DB::table('impact')->first();
		$this->sid =  $impact->sid;
        $this->token =  $impact->token;
		$cuelink=DB::table('cuelink')->first();
		$this->apikey =  $cuelink->apikey;
	}

  
	public function add_complain(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			'user_id'=>'required',
			 'order_id'=>'required',
			 'complain'=>'required'
		 ], [
			'user_id.required'=>'user id is required',
			'order_id.required'=>'order id is required',
			 'complain.required'=>'Enter Complain'
		 ]);
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		
		$check=Complain::where('order_id',$request->order_id)->where('status',0)->first();
		if($check){
			$arr = array('status'=>0, 'data'=>'One open complaint already sent for this order wait for support reply.');
              return response()->json($arr);
		}
		$complain = new Complain();
		$complain->user_id=$request->user_id;
		$complain->order_id=$request->order_id;
		$complain->complain=$request->complain;
		$complain->created_at=now();
		$complain->updated_at=now();
		$complain->save();
		
		$arr = array('status'=>1, 'data'=>'complaint added', 'data'=>$complain);
        return response()->json($arr);
		
	}
	
	public function get_order_complain(Request $request)
    {
		 $validator = Validator::make($request->all(), [
			 'order_id'=>'required'
		 ], [
			'order_id.required'=>'order id is required'
		 ]);
		
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		$ordercomplain = Complain::where('order_id',$request->order_id)->get();
	
		
		$arr = array('status'=>1, 'data'=>'Order Complains', 'data'=>$ordercomplain);
        return response()->json($arr);
		
	}


   
}