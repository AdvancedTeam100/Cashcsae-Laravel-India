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

class CuelinksettingsController extends Controller
{

	
	 public function check(Request $request)
    {
        $cuelink=DB::table('cuelink')->first();
        
      $url = 'https://www.cuelinks.com/api/v2/campaigns.json';
    $ch2 = curl_init($url);
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    $token = $cuelink->apikey;
    $headers[] = "Authorization: Bearer ".$token;
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $result1 = curl_exec($ch2);
    curl_close($ch2);
	$dataw=json_decode($result1); 
	   if($dataw != NULL){
		    DB::table('cuelink')->update(['verified'=>1]);
			return redirect()->back()->withSuccess('Verified');
	
			

	   }else{
		  
			  DB::table('cuelink')->update(['verified'=>2]);
			return redirect()->back()->withErrors('Wrong API key');
		}
    }
	
    public function index()
    {
		$cuelink=DB::table('cuelink')->first();
        return view('admin.cuelinks.settings',compact('cuelink'));
    }
  
    public function update(Request $request)
    {
        $status=$request->status;
		$apikey=$request->apikey;
       $channel=$request->channel;
        DB::table('cuelink')->update([
			'apikey'=>$apikey,
			'channel_id'=>$channel,
			'status'=>$status,
			'verified'=>0
        ]);
        
       
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
  

 

}
