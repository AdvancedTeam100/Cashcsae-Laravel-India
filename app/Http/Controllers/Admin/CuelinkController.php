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

class CuelinkController extends Controller
{

function index(Request $request)
    {
	DB::table('cuelink_campaigns')->update([
            'notify' => 1,
        ]);
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
        $em = CuelinkCampaign::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->paginate(15);
        return view('admin.cuelinks.campaigns.list',compact('em'));
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
        })->orderBy('id','desc')->where('affiliate_partner','cuelinks')->paginate(15);
      
        return view('admin.cuelinks.partner.index',compact('partners'));
    }
	     
	 public function update_cam_img(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);
		
         

          DB::table('cuelink_campaigns')->where(['id' => $id])->update([
            'image' => Helpers::upload('offer/', 'png', $request->file('image')),
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('Campaigns Image Updated Successfully');
       
    }
	 public function update_offer_img(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);
		
         

          DB::table('cuelink_offers')->where(['id' => $id])->update([
            'banner_image' => Helpers::upload('offer/', 'png', $request->file('image')),
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('Campaigns Image Updated Successfully');
       
    }
	public function update_desc(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
		
         

          DB::table('cuelink_campaigns')->where(['id' => $id])->update([
            'description' => $request->description,
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('Campaigns Description Updated Successfully');
       
    }
	
    public function exclusive(CuelinkOffer $offers, Request $request)
    {
      
        $offers->exclusive = $request->exclusive;
        $offers->save();

       return redirect()->back()->withSuccess('Exclusive status updated');
       
    }
    public function offer_status(CuelinkOffer $offers, Request $request)
    {
        $offers->status = $request->status;
        $offers->save();

       return redirect()->back()->withSuccess('Status updated');
       
    }
    public function campagns_status(CuelinkCampaign $offers, Request $request)
    {
        $offers->status = $request->status;
        $offers->save();

       return redirect()->back()->withSuccess('Status updated');
       
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
        })->orderBy('id','desc')->where('affiliate_partner','cuelink')->paginate(15);
		$partners=Partner::get();
        return view('admin.cuelinks.cue_coupon',compact('coupons','partners'));
    }
 
	   public function editp($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.impact.partner.edit', compact('partner'));
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



    function list(Request $request)
    {
		DB::table('cuelink_offers')->update([
            'notify' => 1,
        ]);
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
        
        $em = CuelinkOffer::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->paginate(15);
		
        return view('admin.cuelinks.offer.list', compact('em'));
    }

    public function edit($id)
    {
        $e = Offer::where(['id' => $id])->first();
        $rls = Partner::get();
        $product_category = json_decode($e->category_ids);
        $categories = Category::where(['parent_id' => 0])->get();
        return view('admin.impact.offer.edit', compact('rls', 'e','product_category','categories'));
    }

    public function update(Request $request, $id)
    {
      
      $category = [];
        if ($request->category_id != null) {
            array_push($category, [
                'id' => $request->category_id,
                'position' => 1,
            ]);
        }
		
        if ($request->sub_category_id != null) {
            array_push($category, [
                'id' => $request->sub_category_id,
                'position' => 2,
            ]);
        }

		
 

         
        DB::table('offers')->where('id',$id)->update([
            'description' => $request->description,
            'category_ids'=> json_encode($category),
            'category_id'=>$request->sub_category_id?$request->sub_category_id:$request->category_id,
            'button_text' => $request->button_text,
            'updated_at' => now()
        ]);
       
        
		return redirect()->back()->withSuccess('Offer Updated Successfully');
       
    }

    public function distroy($id)
    {
		$offer=CuelinkOffer::where(['id'=>$id])->first();
        $role=CuelinkOffer::where(['id'=>$id])->delete();
		 if($offer->coupon_code != NULL && $offer->coupon_code != ''){
			 $coupon = Coupon::where('code',$offer->coupon_code)->delete();
			 return redirect()->back()->withSuccess('Offer and elated Coupon Deleted Successfully');
		 }
		else{
		return redirect()->back()->withSuccess('Offer Deleted Successfully');
		}
       
    }

	public function searchcampaigns(Request $request){
        $key = explode(' ', $request['search']);
        $em=CuelinkCampaign::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admins.cuelinks.campaigns.partials._table',compact('em'))->render(),
            'count'=>$partners->count()
        ]);
    }
	
	
	public function searchoffers(Request $request){
        $key = explode(' ', $request['search']);
        $em=CuelinkOffer::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admins.cuelinks.campaigns.partials._table',compact('em'))->render(),
            'count'=>$partners->count()
        ]);
    }


    public function exportoffers(Request $request){
        $offers = CuelinkOffer::get();
        $storage = [];
        if(count($offers)>0){
         foreach($offers as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'campaign_name'=>$item->campaign_name,
                'campaign_id'=>$item->campaign_id,
                'offer_name'=>$item->name,
                'image'=>$item->image,
                'banner_image'=>$item->banner_image,
                'affiliate_partner'=>$item->affiliate_partner,
                'category'=>$item->category,
                'offer_id'=>$item->offer_id,
                'description'=>$item->description,
                'url'=>$item->url,
                'start_date'=>date('F jS, Y', strtotime($item->start_date)),
                'end_date'=>date('F jS, Y', strtotime($item->end_date)),
                'exclusive'=>$item->exclusive==1 ? "yes":"no",
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('offers.xlsx');
    }else{
        return redirect()->back()->withErrors('No offer found');
    }
    }


 public function exportcampaign(Request $request){
        $campaign = CuelinkCampaign::get();
        $storage = [];
        if(count($campaign)>0){
         foreach($campaign as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'campaign_id'=>$item->campaign_id,
                'button_text'=>$item->button_text,
                'image'=>$item->image,
                'domain'=>$item->domain,
                'url'=>$item->url,
                'affiliate_partner'=>$item->affiliate_partner,
                'category'=>$item->category,
                'description'=>$item->description,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('campaigns.xlsx');
    }else{
        return redirect()->back()->withErrors('No Campaign found');
    }
    }

 public function exportadvertisers(Request $request){
        $adv = Partner::where('affiliate_partner','cuelinks')->get();
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
