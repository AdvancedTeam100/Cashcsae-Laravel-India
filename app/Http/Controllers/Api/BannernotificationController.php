<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BannerNotification;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class  BannernotificationController extends Controller
{

    

   public function bannernotification(Request $request)
    {
	   
        $banner=BannerNotification::active()->first();

        return response()->json(['status'=>1,'message' => 'banner notification' , 'data'=>$banner]);
		
    }
	

	 public static function get_settings($name)
    {
        $config = null;
        $data = BusinessSetting::where(['key' => $name])->first();
        if (isset($data)) {
            $config = json_decode($data['value'], true);
            if (is_null($config)) {
                $config = $data['value'];
            }
        }
        return $config;
    }
	

	
}
