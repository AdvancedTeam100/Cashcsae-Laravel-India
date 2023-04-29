<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\CuelinkOffer;
use App\Models\CuelinkCampaign;
use App\Models\Category;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Api_Advcampaign;

class AdmitaddataController extends Controller
{

function index(Request $request)
    {
        DB::table('api_advcampaigns')->update([
            'notify' => 1,
        ]);
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
        $em = Api_Advcampaign::with('partner')->when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->paginate(15);
        return view('admin.admitad.campaigns.list',compact('em'));
    }

	function listadv(Request $request)
    {
		
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
        $partners=Partner::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->where('affiliate_partner','admitad')->paginate(15);
      
        return view('admin.admitad.partner.index',compact('partners'));
    }
	     
	 public function update_cam_img(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);	
        Api_Advcampaign::where(['id' => $id])->update([
            'image' => Helpers::upload('offer/', 'png', $request->file('image')),
            'updated_at' => now(),
        ]);
        
		return redirect()->back()->withSuccess('Campaigns Image Updated Successfully');
       
    }
	
	 public function coupan(Request $request){
        $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
       $coupons=Coupon::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->where('affiliate_partner','admitad')->paginate(15);
		$partners=Partner::get();
        return view('admin.admitad.am_coupon',compact('coupons','partners'));
    }
	
  public function get_categories(Request $request)
    {
       
        $cat = Category::where(['parent_id' => $request->parent_id])->get();
        $res = '<option value="' . 0 . '" disabled selected>---Select---</option>';
        foreach ($cat as $row) {
            if ($row->id == $request->sub_category) {
                $res .= '<option value="' . $row->id . '" selected >' . $row->name . '</option>';
            } else {
                $res .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
        return response()->json([
            'options' => $res,
        ]);
    }



    public function status(Api_Advcampaign $admitad, Request $request)
    {
        // dd($admitad);
        $admitad->status = $request->status;
        $admitad->save();

       return redirect()->back()->withSuccess('Status updated');
       
    }


    public function distroy($id)
    {
		$offer=Api_Advcampaign::where(['id'=>$id])->first();
        $role=Api_Advcampaign::where(['id'=>$id])->delete();
		 if($role){
			 return redirect()->back()->withSuccess('Admitad Campaigns Deleted Successfully');
		    }
		else{
		return redirect()->back()->withSuccess('Something Wents Wrong');
		}
       
    }

	public function searchcampaigns(Request $request){
        $key = explode(' ', $request['search']);
        $em=Api_Advcampaign::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admins.admitad.campaigns.partials._table',compact('em'))->render(),
            'count'=>$em->count()
        ]);
    }
	



    public function exportcampaign(Request $request){
        $offers = Api_Advcampaign::with('category')->get();
        $storage = [];
        if(count($offers)>0){
         foreach($offers as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'affiliate_partner'=>$item->affiliate_partner,
                'category'=>$item->category->name,
                'campaign_id'=>$item->ad_id,
                'description'=>$item->description,
                'gotourl'=>$item->gotourlurl,
                'site_url'=>$item->site_url,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('admitad_campaigns.xlsx');
    }else{
        return redirect()->back()->withErrors('No offer found');
    }
    }




 public function exportadvertisers(Request $request){
        $adv = Partner::where('affiliate_partner','admitad')->get();
        $storage = [];
        if(count($adv)>0){
         foreach($adv as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'image'=>$item->image,
                'affiliate_partner'=>$item->affiliate_partner,
                'left_tab'=>$item->left_tab,
                'left_tab_desc'=>$item->left_tab_desc,
                'right_tab'=>$item->right_tab,
                'right_tab_desc'=>$item->right_tab_desc,
                'top_cashback'=>$item->top_cashback==1 ? "yes":"no",
                'commission_type'=>$item->commission_type==1 ? "Cashback":"Rewards",
                'commission_percentage'=>$item->commission_percentage,
                'tagline'=>$item->tagline,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('cuelinkAdvertisers.xlsx');
    }else{
        return redirect()->back()->withErrors('No Advertiser found');
    }
    }
   
}
