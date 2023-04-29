<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CuelinkOffer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;


class BannerController extends Controller
{
    function index()
    {
        $banners=Banner::paginate(15);
		$offers=CuelinkOffer::get();
        return view('admin.banner.index',compact('banners','offers'));
    }
	 function list()
    {
        $banners=Banner::paginate(15);
		 $offers=CuelinkOffer::get();
        return view('admin.banner.list',compact('banners','offers'));
    }
	
    function store(Request $request)
    {
		 $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
			'image' =>'required',
            'type' => 'required',
            'url' => 'required_if:type,url',
			'offer_id' => 'required_if:type,offer',
			'heading'=>'required',
		    'description'=>'required'
           
        ], [
			 'name.required' => 'Name is required!',
			'image.required' =>'Image is required',
			'type.required' =>'Type is required',
			'url.required' =>'url is required if type is url',
			 'offer_id.required' =>'offer id is required if type is url',
			 'heading.required'=>'Heading is required',
		    'description.required'=>'description is required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
     
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = Helpers::upload('banner/', 'png', $request->file('image'));
        $banner->type = $request->type;
		$banner->url = ($request->type == 'url')?$request->url:NULL;
        $banner->offer_id = ($request->type == 'offer')?$request->offer_id:NULL;
		$banner->heading = $request->heading;		
		$banner->description = $request->description;		
        $banner->save();

      
       return redirect()->back()->withSuccess('Banner added successfully');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
		$offers=CuelinkOffer::get();
        return view('admin.banner.edit', compact('banner','offers'));
    }

    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $request->status;
        $category->save();
		 return redirect()->back()->withSuccess('banner status updated');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:100',
			'image' =>'required',
            'type' => 'required',
            'url' => 'required_if:type,url',
			'offer_id' => 'required_if:type,offer',
			'heading'=>'required',
		    'description'=>'required'
           
        ], [
			 'name.required' => 'Name is required!',
			'image.required' =>'Image is required',
			'type.required' =>'Type is required',
			'url.required' =>'url is required if type is url',
			 'offer_id.required' =>'offer id is required if type is url',
			'heading.required'=>'Heading is required',
		    'description.required'=>'description is required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
     
        $banner = Banner::find($id);
        $banner->name = $request->name;
        $banner->image = $request->has('image') ? Helpers::update('banner/', $banner->image, 'png', $request->file('image')) : $banner->image;
        $banner->type = $request->type;
		$banner->url = ($request->type == 'url')?$request->url:NULL;
        $banner->offer_id = ($request->type == 'offer')?$request->offer_id:NULL;
		$banner->heading = $request->heading;		
		$banner->description = $request->description;	
        $banner->save();
       
       
		 return redirect()->back()->withSuccess('category updated successfully');
    }

    public function delete(Request $request)
    {
        $category = Banner::findOrFail($request->id);
        $category->delete();
			 return redirect()->back()->withErrors('Banner removed');
          

        return back();
    }

   public function exportbanners(Request $request){
        $ad= Banner::get();
        $storage = [];
        if(count($ad)>0){
         foreach($ad as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'type'=>$item->type,
                'url'=>$item->url,
                'offer_id'=>$item->offer_id,
                'image'=>$item->image,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('banner.xlsx');
    }else{
        return redirect()->back()->withErrors('No Banner found');
    }
    }

}
