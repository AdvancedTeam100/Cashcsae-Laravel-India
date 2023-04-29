<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAdv;
use App\Models\Partner;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;


class HomeadvController extends Controller
{
    function index()
    {
		 $homeadd = HomeAdv::get();
         $allPosition[]=0;
        foreach ($homeadd as $topapps) {
            $allApps[] = $topapps->p_id;
            $allPosition[] = $topapps->rank;
        }
  
       $homeads=HomeAdv::paginate(15);
		if(count($homeadd)>0){
     foreach ($homeadd as $topaps) {
		 $p_id[]=$topaps->p_id;
	 }
		$partners=Partner::whereNotIn('id',$p_id)->get();
		}else{
			$partners=Partner::get();
		}
        return view('admin.heading.index',compact('homeads','partners','allPosition'));
    }
 
    function list()
    {
        $homeads=HomeAdv::orderBy('rank','asc')->get();
        $partners=Partner::get();
        return view('admin.heading.list',compact('homeads','partners'));
    }
    function store(Request $request)
    {
        $request->validate([
            'adv_id' => 'required',
			'rank'=>'required'
        ], [
            'adv_ids.required' => 'Advertisers is required!',
			'rank.required' =>'Select Position'
        ]);
		
        $heading = new HomeAdv();
        $heading->p_id = $request->adv_id;
        $heading->rank = $request->rank;
        $heading->save();
	

      
       return redirect()->back()->withSuccess('Added successfully');
    }

    public function edit($id)
    {
		$homeadd = HomeAdv::get();
          
         $homeads = HomeAdv::findOrFail($id);

        $getAppId = $homeads->p_id;
        $getAppRank = $homeads->rank;

        foreach ($homeadd as $topapps) {
            if($getAppId != $topapps->p_id){
                $allApps[] = $topapps->p_id;
            }
            
            $allPosition[] = $topapps->rank;
        }
	
     foreach ($homeadd as $topaps) {
		 if($homeads->p_id != $topaps->p_id){
		 $p_id[]=$topaps->p_id;
		 }
		 
	 }
		$partners=Partner::whereNotIn('id',$p_id)->get();
		
        return view('admin.heading.edit', compact('homeads','allPosition','partners','getAppRank'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'adv_id' => 'required',
			'rank'=>'required'
        ], [
            'adv_ids.required' => 'Advertisers is required!',
			'rank.required' =>'Select Position'
        ]);
        $heading = HomeAdv::find($id);
        $heading->p_id = $request->adv_id;
        $heading->rank = $request->rank;
        $heading->save();
       
		 return redirect()->back()->withSuccess('Updated successfully');
    }

    public function delete(Request $request)
    {
        $heading = HomeAdv::findOrFail($request->id);
     
            $heading->delete();
			 return redirect()->back()->withSuccess('heading removed');
       
        return back();
    }

  

   
    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $headings=HomeAdv::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

        return response()->json([
            'view'=>view('admins.heading.partials._table',compact('headings'))->render(),
            'count'=>$headings->count()
        ]);
    }
	 public function changePostion(Request $request)
    {
        $apps = $request->except('_token');
        $updated_at = Carbon::now();

        foreach ($apps as $appkey => $appvalue) {
            $changePostion = DB::table('home_advs')
                               ->where('id', $appkey)
                               ->update([
                                    'rank'=>$appvalue,
                                    'updated_at'=>$updated_at
                                ]);
        }

        return redirect()->back()->withSuccess('Position updated successfully');
    }
}
