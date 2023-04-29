<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Models\AdmobAd;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;

class AdnetworkController extends Controller
{

	  public function settings()
    {
        return view('admin.ad_networks.index');
    }
  
    public function update_setup(Request $request)
    {
        

        DB::table('ad_networks')->updateOrInsert(['key' => 'admob'], [
            'value' => $request['admob']
        ]);
      
		
		 DB::table('ad_networks')->updateOrInsert(['key' => 'facebookad'], [
            'value' => $request['fb']
        ]);
        

        
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
	
    public function index()
    {
		$banner=AdmobAd::where('ad_type','banner')->get();
		$native=AdmobAd::where('ad_type','native')->get();
		$interstitial=AdmobAd::where('ad_type','interstitial')->first();
		$reward=AdmobAd::where('ad_type','rewards')->first();
        return view('admin.ad_networks.settings',compact('banner','native','interstitial','reward'));
    }
  
    public function update(Request $request, $id)
    {
       $status=$request->status;
	  $ad_id=$request->ad_id;
	if($request->clicks != NULL){
	  $clicks=$request->clicks;	
	}else{
		$clicks=NULL;
	}
		if($request->rewards != NULL){
	  $rewards=$request->rewards;	
	}else{
		$rewards=NULL;
	}
      $admob=AdmobAd::FindOrFail($id);
	  $admob->ad_id=$ad_id;
	  $admob->status=$status;
	  $admob->clicks=$clicks;
	  $admob->rewards=$rewards;
	  $admob->save();

	  return redirect()->back()->withSuccess('successfully updated');
       
    }
  

 

}
