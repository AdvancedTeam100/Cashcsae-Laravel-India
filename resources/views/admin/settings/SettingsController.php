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

class SettingsController extends Controller
{


    public function business_index()
    {
        return view('admin.settings.index');
    }
  
    public function business_setup(Request $request)
    {
        
	//return redirect()->back()->with('warning','This option is disabled for demo!');
        

        DB::table('business_settings')->updateOrInsert(['key' => 'business_name'], [
            'value' => $request['app_name']
        ]);
      
		
		 DB::table('business_settings')->updateOrInsert(['key' => 'default_commision'], [
            'value' => $request['commision']
        ]);
        
        
        $curr_logo = BusinessSetting::where(['key' => 'logo'])->first();
        if ($request->has('logo')) {
            $image_name = Helpers::update('info/', $curr_logo->value, 'png', $request->file('logo'));
        } else {
            $image_name = $curr_logo['value'];
        }

        DB::table('business_settings')->updateOrInsert(['key' => 'logo'], [
            'value' => $image_name
        ]);

        $fav_icon = BusinessSetting::where(['key' => 'icon'])->first();
        if ($request->has('icon')) {
            $image_name = Helpers::update('info/', $fav_icon->value, 'png', $request->file('icon'));
        } else {
            $image_name = $fav_icon['value'];
        }

        DB::table('business_settings')->updateOrInsert(['key' => 'icon'], [
            'value' => $image_name
        ]);

       

        DB::table('business_settings')->updateOrInsert(['key' => 'footer_text'], [
            'value' => $request['footer_text']
        ]);
		
		  DB::table('business_settings')->updateOrInsert(['key' => 'minimum_redeem'], [
            'value' => $request['min_redeem']
        ]);
		
		 DB::table('business_settings')->updateOrInsert(['key' => 'country'], [
            'value' => $request['country']
        ]);
        
		$country= Country::where('country_code',$request['country'])->first();
		 DB::table('business_settings')->updateOrInsert(['key' => 'phone_code'], [
            'value' => $country->phone_code
        ]);
        
		
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
	
	
	
	
	    public function about_us()
    {
        $tnc = BusinessSetting::where(['key' => 'about_us'])->first();
        if ($tnc == false) {
            BusinessSetting::insert([
                'key' => 'about_us',
                'value' => ''
            ]);
        }
        return view('admin.settings.about_us', compact('tnc'));
    }

    public function about_us_update(Request $request)
    {
		return redirect()->back()->with('warning','This option is disabled for demo!');
        BusinessSetting::where(['key' => 'about_us'])->update([
            'value' => $request->tnc
        ]);
        return redirect()->back()->withSuccess('terms and condition updated');
       
    }

    public function privacy_policy()
    {
        $data = BusinessSetting::where(['key' => 'privacy_policy'])->first();
        if ($data == false) {
            $data = [
                'key' => 'privacy_policy',
                'value' => '',
            ];
            BusinessSetting::insert($data);
        }
        return view('admin.settings.privacy', compact('data'));
    }

    public function privacy_policy_update(Request $request)
    {
		return redirect()->back()->with('warning','This option is disabled for demo!');
        BusinessSetting::where(['key' => 'privacy_policy'])->update([
            'value' => $request->privacy_policy,
        ]);
        return redirect()->back()->withSuccess('privacy policy updated');
       
    }

  public function currency_index()
    {
        return view('admin.settings.currency');
    }
  
    public function currency_setup(Request $request)
    {
		return redirect()->back()->with('warning','This option is disabled for demo!');
        if(env('APP_MODE')=='demo')
        {
			return redirect()->back()->withErrors('update option is disable for demo');
        }

         DB::table('business_settings')->updateOrInsert(['key' => 'currency'], [
            'value' => $request['currency']
        ]);
       
		return redirect()->back()->withSuccess('successfully updated');
       
    }
	
	 public function exchange_rate(Request $request)
    {
		return redirect()->back()->with('warning','This option is disabled for demo!');
        if(env('APP_MODE')=='demo')
        {
			return redirect()->back()->withErrors('update option is disable for demo');
        }

         DB::table('business_settings')->updateOrInsert(['key' => 'cuelinks_rate'], [
            'value' => $request['cuelinks_rate']
        ]);
       
		 DB::table('business_settings')->updateOrInsert(['key' => 'impact_rate'], [
            'value' => $request['impact_rate']
        ]);
		
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }
	
	public function referral_index()
    {
        return view('admin.settings.referral');
    }
  
    public function referral_setup(Request $request)
    {
		return redirect()->back()->with('warning','This option is disabled for demo!');
        if(env('APP_MODE')=='demo')
        {
			return redirect()->back()->withErrors('update option is disable for demo');
        }

         DB::table('business_settings')->updateOrInsert(['key' => 'signup_refer'], [
            'value' => $request['signup_refer']
        ]);
       
		 DB::table('business_settings')->updateOrInsert(['key' => 'per_order_refer_percentage'], [
            'value' => $request['per_order_refer_percentage']
        ]);
		
		return redirect()->back()->withSuccess('successfully updated');
       
    }

   

}
