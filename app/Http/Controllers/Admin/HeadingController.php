<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\Offer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;


class HeadingController extends Controller
{
    function index()
    {
        $headings=Heading::paginate(15);
        $offers=Offer::get();
        return view('admin.heading.index',compact('headings','offers'));
    }
 
    function list()
    {
        $headings=Heading::paginate(15);
        $offers=Offer::get();
        return view('admin.heading.list',compact('headings','offers'));
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:headings|max:100',
        ], [
            'name.required' => 'Name is required!',
        ]);
        $heading = new Heading();
        $heading->name = $request->name;
        $heading->offers = json_encode($request->offers);
        $heading->save();

      
       return redirect()->back()->withSuccess('heading added successfully');
    }

    public function edit($id)
    {
        $heading = Heading::findOrFail($id);
        return view('admin.heading.edit', compact('heading'));
    }

    public function status(Request $request)
    {
        $heading = Heading::find($request->id);
        $heading->status = $request->status;
        $heading->save();
		 return redirect()->back()->withSuccess('heading status updated');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:headings,name,'.$id,
        ]);
        $heading = Heading::find($id);
        $heading->name = $request->name;
        $heading->offers = json_encode($request->offers);
        $heading->save();
       
		 return redirect()->back()->withSuccess('heading updated successfully');
    }

    public function delete(Request $request)
    {
        $heading = Heading::findOrFail($request->id);
     
            $heading->delete();
			 return redirect()->back()->withErrors('heading removed');
       
        return back();
    }

    public function get_all(Request $request){
        $data = Heading::where('name', 'like', '%'.$request->q.'%')->limit(8)->get([DB::raw('id, CONCAT(name, " (", if(position = 0, "'.'main'.'", "'.'sub'.'"),")") as text')]);
        if(isset($request->all))
        {
            $data[]=(object)['id'=>'all', 'text'=>'All'];
        }
        return response()->json($data);
    }

    public function update_priority(Heading $heading, Request $request)
    {
        $priority = $request->priority??0;
        $heading->priority = $priority;
        $heading->save();
		 return redirect()->back()->withSuccess('heading priority updated successfully');
        

    }

   
    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $headings=Heading::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

        return response()->json([
            'view'=>view('admins.heading.partials._table',compact('headings'))->render(),
            'count'=>$headings->count()
        ]);
    }
}
