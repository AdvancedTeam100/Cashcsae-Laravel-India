<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CuelinkCampaign;
use App\Models\AllinCampaign;
use App\Models\Partner;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use App\Models\Api_Advcampaign;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;


class AllinController extends Controller
{
    function index()
    {
		$campaigns=CuelinkCampaign::orderBy('name')->get();
        $all=AllinCampaign::get();
        $admited = Api_Advcampaign::orderBy('name')->get();
        $impacts = Offer::orderBy('name')->get();
        // dd($admited);
        return view('admin.allin.index',compact('campaigns','all','admited','impacts'));
    }
 
 
    function store(Request $request)
    {
        // dd($request);
        if($request->cam_id){
            $request->validate([
                'cam_id' => 'required',
            ], [
                'cam_id.required' => 'Select Campaign(s)!',
            ]);
            foreach($request->cam_id as $cam){
                $campaigns=AllinCampaign::where('campaign_id',$cam)->first();
                if(!$campaigns){
               $heading = new AllinCampaign();
               $heading->campaign_id = $cam;
               $heading->created_at = now();
               $heading->updated_at = now();
               $heading->save();
                }
            }
        }elseif($request->adm_id){
                $request->validate([
                'adm_id' => 'required',
            ], [
                'adm_id.required' => 'Select Admited(s)!',
            ]);
            foreach($request->adm_id as $adm){
                $impact = AllinCampaign::where('admited_id',$adm)->first();
                if(!$impact){
                    $heading = new AllinCampaign();
                    $heading->admited_id =$adm;
                    $heading->created_at = now();
                    $heading->updated_at = now();
                    $heading->save();
                }
            }
        }elseif($request->imp_id){
                $request->validate([
                'imp_id' => 'required',
            ], [
                'imp_id.required' => 'Select Impact(s)!',
            ]);
            foreach($request->imp_id as $imp){
                $impact = AllinCampaign::where('impact_id',$imp)->first();
                if(!$impact){
                    $heading = new AllinCampaign();
                    $heading->impact_id =$imp;
                    $heading->created_at = now();
                    $heading->updated_at = now();
                    $heading->save();
                }
            }
        }

      
       return redirect()->back()->withSuccess('Added successfully');
    }

	
	 function update(Request $request)
    {
        $request->validate([
            'color' => 'required',
			'search_url' => 'required',
        ], [
            'color.required' => 'Select Color!',
			'search_url.required' => 'Insert Search url',
        ]);
		
			
           $heading = AllinCampaign::find($request->id);
           $heading->tab_color = $request->color;
		   $heading->search_url = $request->search_url;
		   $heading->updated_at = now();
           $heading->save();
			
      
       return redirect()->back()->withSuccess('Added/Updated successfully');
    }
   

    public function delete(Request $request)
    {
        $heading = AllinCampaign::findOrFail($request->id);
    
        $heading->delete();
        return redirect()->back()->withSuccess('Campaign Removed');
       
    }

  

  
}
