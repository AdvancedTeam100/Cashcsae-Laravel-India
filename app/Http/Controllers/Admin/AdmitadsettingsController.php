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

class AdmitadsettingsController extends Controller
{
    public function __construct(){
        $admitad=DB::table('admitad')->first();
		$this->client_id = $admitad->client_id;  
		$this->client_secret = $admitad->client_secret;
		$this->base64code = $admitad->base64code;
		$this->website_id = $admitad->website_id;
     $this->scope="advcampaigns_for_website deeplink_generator advcampaigns banners websites manage_opt_codes";
    }
	
	 public function check(Request $request)
    {
        $admitad=DB::table('admitad')->first();
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
        
        if(property_exists($re,'access_token')){
		    DB::table('admitad')->update(['verified'=>1]);
			return redirect()->back()->withSuccess('Verified');
	
			

	   }else{
			  DB::table('admitad')->update(['verified'=>2]);
			return redirect()->back()->withErrors('Wrong Credentials');
		}
    }
	
    public function index()
    {
		$admitad=DB::table('admitad')->first();
        return view('admin.admitad.settings',compact('admitad'));
    }
  
    public function update(Request $request)
    {
       $status=$request->status;
	   $client_secret=$request->client_secret;
       $client_id=$request->client_id;
       $website_id=$request->website_id;
       $base64code=$request->base64code;
       
        DB::table('admitad')->update([
			'client_id'=>$client_id,
			'client_secret'=>$client_secret,
            'website_id'=>$website_id,
            'base64code'=>$base64code,
			'status'=>$status,
			'verified'=>0
        ]);
        
       
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
  

 

}
