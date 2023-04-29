<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\Partner;
use App\Models\Category;
use App\Models\CuelinkCampaign;
use App\Models\Offer;
use App\Models\Banner;
use App\Models\HomeAdv;
use App\Models\Coupon;
use App\Models\CuelinkOffer;
use App\Models\Api_Advcampaign;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class CueController extends Controller
{

    public function exclusiveoffers()
    {
        $offset=1;
		$check=DB::table('cuelink')->first();
		$partnerr=NULL;
		if($check->status==1){
        $partners=CuelinkOffer::exclusive()->active()->ongoing()->with('category')->where('status',1)->get();
        foreach($partners as $part){
            $campaign=CuelinkCampaign::with('partner')->where('campaign_id',$part->campaign_id)->first();
            $part->partner=$campaign->partner;
            $campaign2=CuelinkCampaign::with('partner.coupon')->where('campaign_id',$part->campaign_id)->first();
            $part->coupon=$campaign2->partner->coupon;
            $partnerr[]=$part;
        }
		}else{
			$partnerr=array();
		}
		if($partnerr==NULL){
			$partnerr=array();
		}
        $arr = array('status'=>1, 'data'=>$partnerr);
        return response()->json($arr);
    }
    
    public function getalloffers()
    {
        $offset=1;
		$check=DB::table('cuelink')->first();
		$partnerr=NULL;
		if($check->status==1){
        $partners=CuelinkOffer::active()->ongoing()->with('category')->where('status',1)->paginate(150);
        
        foreach($partners->items() as $part){
            $campaign=CuelinkCampaign::with('partner')->where('campaign_id',$part->campaign_id)->get();
            foreach($campaign as $cam){
            $part->partner=$cam->partner;
            }
            $campaign2=CuelinkCampaign::with('partner.coupon')->where('campaign_id',$part->campaign_id)->get();
            foreach($campaign2 as $cam2){
            $part->coupon=$cam2->partner->coupon;
            }
            
            $partnerr[]=$part;
        }
		}else{
			$partnerr=array();
		}
		if($partnerr==NULL){
			$partnerr=array();
		}
        $arr = array('status'=>1, 'data'=>$partnerr);
        return response()->json($arr);
    }
    
    public function getcategory()
    {
        $offset=1;
	   $check=DB::table('cuelink')->first();
	   $check2=DB::table('impact')->first();
       $check3=DB::table('admitad')->first();
	   $parr=NULL;
		if($check->status==1 && $check2->status==1 && $check3->status==1){
           $parr=Category::with('ads','cuecampaigns','admitadoffers')->orderBy('name','asc')->paginate(100);
		   $arr = array('status'=>1, 'data'=>$parr->items());
            return response()->json($arr);
        }elseif($check->status==1 && $check2->status==1 && $check3->status !=1){
			$pars=Category::with('ads','cuecampaigns')->paginate(15);
		    foreach($pars as $parss){
			 $parss['admitadoffers']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 
			$arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
		}elseif($check->status==1 && $check2->status!=1 && $check3->status!=1){
			$pars=Category::with('cuecampaigns')->paginate(15);
		    foreach($pars as $parss){
			 $parss['ads']=[];
             $parss['admitadoffers']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
		}elseif($check->status==1 && $check2->status==1 && $check3->status!=1){
            $pars=Category::with('cuecampaigns','ads')->paginate(15);
		    foreach($pars as $parss){
             $parss['admitadoffers']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
        }elseif($check->status==1 && $check2->status!=1 && $check3->status==1){
            $pars=Category::with('cuecampaigns','admitadoffers')->paginate(15);
		    foreach($pars as $parss){
             $parss['ads']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
        }elseif($check->status!=1 && $check2->status==1 && $check3->status!=1){
            $pars=Category::with('ads')->paginate(15);
		    foreach($pars as $parss){
             $parss['cuecampaigns']=[];
             $parss['admitadoffers']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
        }elseif($check->status!=1 && $check2->status!=1 && $check3->status==1){
            $pars=Category::with('admitadoffers')->paginate(15);
		    foreach($pars as $parss){
             $parss['cuecampaigns']=[];
             $parss['ads']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
        }elseif($check->status!=1 && $check2->status==1 && $check3->status==1){
            $pars=Category::with('ads','admitadoffers')->paginate(15);
		    foreach($pars as $parss){
             $parss['cuecampaigns']=[];
			 $parr[]=$parss;
		     }
			 if($parr==NULL){
				 $arr = array('status'=>1, 'data'=>[]);
                  return response()->json($arr);
			 }
			 $arr = array('status'=>1, 'data'=>$parr);
            return response()->json($arr);
        }
        else{
			$parr=array();
			 $arr = array('status'=>1, 'data'=>[]);
            return response()->json($arr);
		}
		
		if($parr==NULL){
			$parr=array();
			 $arr = array('status'=>1, 'data'=>[]);
            return response()->json($arr);
		}
        

        $arr = array('status'=>1, 'data'=>$parr);
        return response()->json($arr);
    }
    public function getallpartner()
    {
        $offset=1;
        $partners=Partner::with('cuecampaigns')->paginate(150);
       $arr = array('status'=>1, 'data'=>$partners->items());
        return response()->json($arr);
    }
    
    public function getallcampaigns()
    {
        $offset=1;
		$check=DB::table('cuelink')->first();
		if($check->status==1){
        $partners=CuelinkCampaign::with('partner','category')->where('status',1)->paginate(150);
        $partnerr=NULL;
        foreach($partners->items() as $part){
            $coupon=Coupon::where('adv_id',$part->adv_id)->get();
            $part->coupon=$coupon;
            $partnerr[]=$part;
        }
		}else{
			$partnerr=[];
		}
        
        $arr = array('status'=>1, 'data'=>$partnerr==NULL?[]:$partnerr);
        return response()->json($arr);
    }

    
        public function homepartner()
    {
       $offset=1;
       $check=DB::table('cuelink')->first();
	   $check2=DB::table('impact')->first();
	   $parr=NULL;
		if($check->status==1 && $check2->status==1){
             $parr=Partner::with('cuecampaigns','ads','coupon')->join('home_advs', 'partners.id', '=', 'home_advs.p_id')->select('partners.*','home_advs.p_id','home_advs.rank')->orderBy('rank','asc')->get();
		}elseif($check->status!=1 && $check2->status==1){
			$pars=Partner::with('ads','coupon')->join('home_advs', 'partners.id', '=', 'home_advs.p_id')->select('partners.*','home_advs.p_id','home_advs.rank')->orderBy('rank','asc')->get();
		    foreach($pars as $parss){
			 $parss['cuecampaigns']=[];
			 $parr[]=$parss;
		     }
		}elseif($check->status==1 && $check2->status!=1){
			$pars=Partner::with('cuecampaigns','coupon')->join('home_advs', 'partners.id', '=', 'home_advs.p_id')->select('partners.*','home_advs.p_id','home_advs.rank')->orderBy('rank','asc')->get();
		    foreach($pars as $parss){
			 $parss['ads']=[];
			 $parr[]=$parss;
		     }
			
		}else{
			$parr=array();
		}
		
		if($parr==NULL){
			$parr=array();
		}
        

        $arr = array('status'=>1, 'data'=>$parr);
        return response()->json($arr);
     }
    
    
        public function topcashback()
    {
        $offset=1;
        $check=DB::table('cuelink')->first();
	   $check2=DB::table('impact')->first();
	   $parr=NULL;
		if($check->status==1 && $check2->status==1){
           $parr=Partner::with('cuecampaigns','ads','coupon')->where('top_cashback',1)->get();
         }elseif($check->status!=1 && $check2->status==1){
			$pars=Partner::with('ads','coupon')->where('top_cashback',1)->get();
		    foreach($pars as $parss){
			 $parss['cuecampaigns']=[];
			 $parr[]=$parss;
		     }
		}elseif($check->status==1 && $check2->status!=1){
			$pars=Partner::with('cuecampaigns','coupon')->where('top_cashback',1)->get();
		    foreach($pars as $parss){
			 $parss['ads']=[];
			 $parr[]=$parss;
		     }
			
		}else{
			$parr=array();
		}
		
		if($parr==NULL){
			$parr=array();
		}
        

        $arr = array('status'=>1, 'data'=>$parr);
        return response()->json($arr);
     }
    
        public function alladv()
    {
        $offset=1;
        $check=DB::table('cuelink')->first();
	   $check2=DB::table('impact')->first();
	   $parr=NULL;
		if($check->status==1 && $check2->status==1){
           $parr=Partner::with('cuecampaigns','ads','coupon')->paginate(150);
		   $arr = array('status'=>1, 'data'=>$parr->items());
         }elseif($check->status!=1 && $check2->status==1){
			$pars=Partner::with('ads','coupon')->paginate(15);
		    foreach($pars as $parss){
			 $parss['cuecampaigns']=[];
			 $parr[]=$parss;
		     }
			 $arr = array('status'=>1, 'data'=>$parr);
		}elseif($check->status==1 && $check2->status!=1){
			$pars=Partner::with('cuecampaigns','coupon')->paginate(150);
		    foreach($pars as $parss){
			 $parss['ads']=[];
			 $parr[]=$parss;
		     }
			 $arr = array('status'=>1, 'data'=>$parr);
			
		}else{
			$parr=array();
			$arr = array('status'=>1, 'data'=>$parr);
		}
		
		if($parr==NULL){
			$parr=array();
			$arr = array('status'=>1, 'data'=>$parr);
		}
        

        return response()->json($arr);
     }
    
    public function getallbanners()
    {
        $offset=1;
	   $check=DB::table('cuelink')->first();
	   $parr=NULL;
		if($check->status==1){
        $partners=Banner::with('cuelinkoffer')->paginate(150);
        $arr = array('status'=>1, 'data'=>$partners->items());
		return response()->json($arr);
		}else{
			
			$partners=Banner::paginate(15);
			foreach($partners as $parss){
				if(empty($parss['cuelinkoffer'])){
			 
			     $parr[]=$parss;
				}
		     }
			 
			 if($parr==NULL){
				 $parr2=[];
			 }else{
				 $parr2=$parr;
			 }
        $arr = array('status'=>1, 'data'=>$parr2);
		return response()->json($arr);
		}
		$arr = array('status'=>1, 'data'=>[]);
        return response()->json($arr);
    }
    
    public function offer_details(Request $request)
    {
        $offset=1;
        $partners=CuelinkOffer::with('category')->where('id',$request->offer_id)->first();
            $campaign=CuelinkCampaign::with('partner')->where('campaign_id',$partners->campaign_id)->first();
            $partners->partner=$campaign->partner;
            $partners->coupon=Coupon::where('adv_id',$campaign->adv_id)->get();
            
        return response()->json($partners);
    }
    
    public function ads_details(Request $request)
    {
        $offset=1;
        $partners=Offer::with('partner')->where('id',$request->ad_id)->first();
        $partners->coupon=Coupon::where('adv_id',$partners->partner_id)->get();
        return response()->json($partners);
    }

    public function campaigns_details(Request $request)
    {
        $offset=1;
        $partners=CuelinkCampaign::with('partner')->where('id',$request->campaign_id)->first();
        $partners->coupon=Coupon::where('adv_id',$partners->adv_id)->get();
        return response()->json($partners);
    }
    
    public function seemorecampaigns(Request $request)
    {
        $offset=1;
		$check=DB::table('cuelink')->first();
	   $parr=NULL;
		if($check->status==1){
        $p=CuelinkCampaign::where('id',$request->campaign_id)->first();
        $partners=CuelinkCampaign::with('partner')->where('campaign_id',$p->campaign_id)->where('id','!=',$request->campaign_id)->get();
        $partnerr=NULL;
        foreach($partners as $part){
            $coupon=Coupon::where('adv_id',$part->adv_id)->get();
            $part->coupon=$coupon;
            $partnerr[]=$part;
        }
        }else{
			$partnerr=[];
		}
        $arr = array('status'=>1, 'data'=>$partnerr==NULL?[]:$partnerr);
        return response()->json($arr);
    }

  public function seemoreoffers(Request $request)
    {
        $offset=1;
	   $check=DB::table('cuelink')->first();
	   $parr=NULL;
		if($check->status==1){
        $p=CuelinkOffer::where('id',$request->offer_id)->first();
        
        $partners=CuelinkOffer::with('category')->where('campaign_id',$p->campaign_id)->where('id','!=',$request->offer_id)->get();
        foreach($partners as $part){
            $campaign=CuelinkCampaign::with('partner')->where('campaign_id',$part->campaign_id)->first();
            $part->partner=$campaign->partner;
            $part->coupon=Coupon::where('adv_id',$campaign->adv_id)->get();
            $partnerr[]=$part;
        }
		}else{
			$partnerr=[];
		}
        $arr = array('status'=>1, 'data'=>$partnerr);
        return response()->json($arr);
    }
    
    public function seemorads(Request $request)
    {
        $offset=1;
		 $check=DB::table('impact')->first();
	   $parr=NULL;
		if($check->status==1){
        $p=Offer::where('id',$request->ad_id)->first();
        
        $partners=Offer::with('partner')->where('partner_id',$p->partner_id)->where('id','!=',$request->ad_id)->get();
        $partnerr=NULL;
        foreach($partners as $part){
            $coupon=Coupon::where('adv_id',$part->partner_id)->get();
            $part->coupon=$coupon;
            $partnerr[]=$part;
        }
		}else{
			$partnerr=[];
		}
        $arr = array('status'=>1, 'data'=>$partnerr==NULL?[]:$partnerr);
        return response()->json($arr);
    }


    public function getalladmitadcampaigns()
    {
        $offset=1;
		$check=DB::table('admitad')->first();
		if($check->status==1){
        $partners=Api_Advcampaign::Active()->with('partner','category')->paginate(150);
        $partnerr=NULL;
        foreach($partners->items() as $part){
            $coupon=Coupon::where('adv_id',$part->adv_id)->get();
            $part->coupon=$coupon;
            $partnerr[]=$part;
        }
		}else{
			$partnerr=[];
		}
        
        $arr = array('status'=>1, 'data'=>$partnerr==NULL?[]:$partnerr);
        return response()->json($arr);
    }

     public function seemoradmitadoffers(Request $request)
    {
        $offset=1;
		 $check=DB::table('admitad')->first();
	   $parr=NULL;
		if($check->status==1){
        $p=Api_Advcampaign::where('id',$request->id)->first();
        
        $partners=Api_Advcampaign::Active()->with('partner')->where('adv_id',$p->adv_id)->where('id','!=',$request->id)->get();
        $partnerr=NULL;
        foreach($partners as $part){
            $coupon=Coupon::where('adv_id',$part->adv_id)->get();
            $part->coupon=$coupon;
            $partnerr[]=$part;
        }
		}else{
			$partnerr=[];
		}
        $arr = array('status'=>1, 'data'=>$partnerr==NULL?[]:$partnerr);
        return response()->json($arr);
    }
     

    public function admitadoffer_details(Request $request)
    {
        $offset=1;
        $partners=Api_Advcampaign::Active()->with('partner')->where('id',$request->id)->first();
        $partners->coupon=Coupon::where('adv_id',$partners->adv_id)->get();
        return response()->json($partners);
    } 
}
