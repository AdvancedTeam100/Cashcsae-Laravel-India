<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Partner;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;


class CouponController extends Controller
{
    function index()
    {
        $coupons=Coupon::paginate(15);
		$partners=Partner::get();
        return view('admin.coupon.index',compact('coupons','partners'));
    }
	 function list(Request $request)
    {
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
       $coupons=Coupon::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->where('affiliate_partner','manual')->paginate(15);
		$partners=Partner::get();
        return view('admin.coupon.list',compact('coupons','partners'));
    }
	
    function store(Request $request)
    {
		 $validator = Validator::make($request->all(), [
            'name' => 'required|unique:coupons|max:100',
			'code' => 'required|unique:coupons|max:100',
            'adv_id' => 'required',
			'link' => 'required',
			'button_text' => 'required',
			'heading'=>'required',
		    'description'=>'required'
           
        ], [
			 'name.required' => 'Name is required!',
			'code.required' =>'Coupon Code is required',
			'adv_id.required' =>'Select Advertiser',
			 'link.required' =>'Insert Link',
			 'button_text.required' =>'Insert button text',
			 'heading.required'=>'Heading is required',
		    'description.required'=>'description is required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $partner=Partner::where('id',$request->adv_id)->first();
        $coupon = new Coupon();
        $coupon->name = $request->name;
		$coupon->code = $request->code;
        $coupon->image =$partner->image;
		$coupon->banner_image = Helpers::upload('coupon/', 'png', $request->file('banner_image'));
		$coupon->url = $request->link;
		$coupon->button_text = $request->button_text;
        $coupon->adv_id = $request->adv_id;
		$coupon->heading = $request->heading;		
		$coupon->description = $request->description;	
		$coupon->start_date = $request->start_date;		
		$coupon->end_date = $request->end_date;	
        $coupon->save();

      
       return redirect()->route('admin.coupon.list')->withSuccess('Coupon added successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
		$partners=Partner::get();
        return view('admin.coupon.edit', compact('coupon','partners'));
    }

  

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
			'code' => 'required',
            'adv_id' => 'required',
			 'link' => 'required',
			'button_text' => 'required',
			'heading'=>'required',
		    'description'=>'required'
           
        ], [
			 'name.required' => 'Name is required!',
			'code.required' =>'Coupon Code is required',
			'adv_id.required' =>'Select Advertiser',
			 'link.required' =>'Insert Link',
			 'button_text.required' =>'Insert button text',
			 'heading.required'=>'Heading is required',
		    'description.required'=>'description is required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

    
      $partner=Partner::where('id',$request->adv_id)->first();
	    $coupon = Coupon::find($id);
        $coupon->name = $request->name;
		$coupon->code = $request->code;
        $coupon->image =$partner->image;
		$coupon->banner_image = Helpers::upload('coupon/', 'png', $request->file('banner_image'));
		$coupon->url = $request->link;
		$coupon->button_text = $request->button_text;
        $coupon->adv_id = $request->adv_id ;
		$coupon->heading = $request->heading;		
		$coupon->description = $request->description;
		$coupon->start_date = $request->start_date;		
		$coupon->end_date = $request->end_date;	
        $coupon->save();
       
       
		 return redirect()->route('admin.coupon.list')->withSuccess('Coupon updated successfully');
    }

    public function delete(Request $request)
    {
        $category = Coupon::findOrFail($request->id);
        $category->delete();
	    return redirect()->back()->withErrors('Coupon removed');
          

        return back();
    }


     public function exportcoupon(Request $request){
        $coupon = Coupon::get();
        $storage = [];
        if(count($coupon)>0){
         foreach($coupon as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'code'=>$item->code,
                'image'=>$item->image,
                'banner_image'=>$item->banner_image,
                'url'=>$item->url,
                'button_text'=>$item->button_text,
                'adv_id'=>$item->adv_id,
                'heading'=>$item->heading,
                'description'=>$item->description,
                'start_date'=>date('F jS, Y', strtotime($item->start_date)),
                'end_date'=>date('F jS, Y', strtotime($item->end_date)),
                'added_via'=>$item->affiliate_partner,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('Coupons.xlsx');
    }else{
        return redirect()->back()->withErrors('No Coupon found');
    }
    }

   

}
