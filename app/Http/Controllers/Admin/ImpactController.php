<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class ImpactController extends Controller
{

function index(Request $request)
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
        })->orderBy('id','desc')->where('affiliate_partner','impact')->paginate(15);
        return view('admin.impact.partner.index',compact('partners'));
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
        $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
        $em = Offer::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })
        ->with(['partner'])->where('affiliate_partner','impact')->orderBy('id','desc')->paginate(15);
        return view('admin.impact.offer.list', compact('em'));
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
      
        DB::table('offers')->where('id',$id)->update([
            'description' => $request->description,
            'category_id'=>$request->category_id,
            'button_text' => $request->button_text,
            'updated_at' => now()
        ]);
       
        
		return redirect()->route('admin.impactads.list')->withSuccess('Ad Updated Successfully');
       
    }

    public function status(Offer $impact, Request $request)
    {
        $impact->status = $request->status;
        $impact->save();

       return redirect()->back()->withSuccess('Status updated');
       
    }

    public function distroy($id)
    {
        $role=Offer::where(['id'=>$id])->delete();
		return redirect()->back()->withSuccess('Ad Deleted Successfully');
       
    }
	public function searchadvertisers(Request $request){
        $key = explode(' ', $request['search']);
        $partners=Partner::where('affiliate_partner','impact')->where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admins.impact.partner.partials._table',compact('partners'))->render(),
            'count'=>$partners->count()
        ]);
    }

    public function exportads(Request $request){
        $ads = Offer::where('affiliate_partner','impact')->get();
        $storage = [];
        if(count($ads)>0){
         foreach($ads as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'image'=>$item->image,
                'affiliate_partner'=>$item->affiliate_partner,
                'ad_id'=>$item->ad_id,
                'campaign_id'=>$item->c_id,
                'advertiser'=>$item->adv_name,
                'button_text'=>$item->button_text,
                'url'=>$item->landing_page,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('impactads.xlsx');
    }else{
        return redirect()->back()->withErrors('No Ads found');
    }
    }

      public function exportadvertisers(Request $request){
        $adv = Partner::where('affiliate_partner','impact')->get();
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
        return (new FastExcel($storage))->download('impactAdvertisers.xlsx');
    }else{
        return redirect()->back()->withErrors('No Advertiser found');
    }
    }

   
}
