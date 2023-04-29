<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Models\FbAd;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;

class FbController extends Controller
{

	
	
    public function index()
    {
		$banner=FbAd::where('ad_type','banner')->get();
		$native=FbAd::where('ad_type','native')->get();
		$interstitial=FbAd::where('ad_type','interstitial')->first();
		$reward=FbAd::where('ad_type','rewards')->first();
        return view('admin.ad_networks.fb',compact('banner','native','interstitial','reward'));
    }
  
    public function update(Request $request, $id)
    {
       $status=$request->status;
	  $placement_id=$request->placement_id;
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
      $admob=FbAd::FindOrFail($id);
	  $admob->placement_id=$placement_id;
	  $admob->status=$status;
	  $admob->clicks=$clicks;
	  $admob->rewards=$rewards;
	  $admob->save();

	  return redirect()->back()->withSuccess('successfully updated');
       
    }
  

 

}