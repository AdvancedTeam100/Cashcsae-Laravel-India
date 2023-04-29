<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Partner;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdsController extends Controller
{

    public function getadvs()
    {
		$offset=1;
		$partners=Partner::active()->with('offers')->paginate(15, ['*'], 'page', $offset);
		
        return response()->json([$partners->data]);
    }

	  public function getbannerads()
    {
		  $offset=1;
		$partners=Offer::active()->with('partner')->where('type','banner')->paginate(15, ['*'], 'page', $offset);
		
        return response()->json($partners->items());
    }
	  public function getvideoads()
    {$offset=1;
		$partners=Offer::active()->with('partner')->where('type','video')->paginate(15, ['*'], 'page', $offset);
		
        return response()->json($partners->items());
    }
	  public function getimageads()
    {
		  $offset=1;
		$partners=Offer::active()->with('partner')->where('type','image')->paginate(15, ['*'], 'page', $offset);
		
       return response()->json($partners->items());
    }
    
	 
}
