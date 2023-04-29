<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;

class ImpactsettingController extends Controller
{


    public function index()
    {
		$impact=DB::table('impact')->first();
		
        DB::table('impact')->update([
			'click'=>0
        ]);
        return view('admin.impact.settings',compact('impact'));
    }
  
    public function update(Request $request)
    {
		//return redirect()->back()->with('warning','This option is disabled for demo!');
        $status=$request->status;
		$sid=$request->sid;
		$token=$request->token;
       

        DB::table('impact')->update([
			'sid'=>$sid,
			'token'=>$token,
			'status'=>$status,
			'verified'=>0
        ]);
        
       
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
  

   public function check(Request $request)
    {
        $impact=DB::table('impact')->first();
        
       $client_id = $impact->sid;
		$secret =$impact->token;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.impact.com/Mediapartners/'.$client_id.'/CompanyInformation');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		$data=json_decode($response);

	   if(isset($data->status)){
	    if($data->status=="ERROR"){
			  DB::table('impact')->update(['verified'=>2]);
			return redirect()->back()->withErrors('Wrong Credentials');
		}else{
			DB::table('impact')->update(['verified'=>2]);
			return redirect()->back()->withErrors('Wrong Credentials');
		}
	   }elseif(isset($data->message)){
		   DB::table('impact')->update(['verified'=>2]);
		    if($data->message=="Unauthorized"){
				return redirect()->back()->withErrors('Wrong Credentials');
			}
		   return redirect()->back()->withErrors('Wrong Credentials');
	   }else{
		  
			 DB::table('impact')->update(['verified'=>1]);
			return redirect()->back()->withSuccess('Verified');
		}
    }

}
