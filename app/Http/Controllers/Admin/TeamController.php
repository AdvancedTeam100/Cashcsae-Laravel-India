<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class TeamController extends Controller
{

    public function add_new()
    {
        $rls = AdminRole::whereNotIn('id', [1])->get();
        return view('admin.team.add-new', compact('rls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'nullable|max:100',
            'role_id' => 'required',
            'image' => 'required',
            'email' => 'required|unique:admins',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:admins',
            'password' =>'required|min:6'

        ]);

        if ($request->role_id == 1) {
          return redirect()->back()->with('warning','Access Denied');
        }

        DB::table('admins')->insert([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password),
            'image' => Helpers::upload('admin/', 'png', $request->file('image')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
		return redirect()->back()->withSuccess('Member Added Successfully');
       
    }

    function list(Request $request)
    {
	 $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
     
        $em = Admin::with(['role'])->when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('f_name', 'like', "%{$value}%")
				->orWhere('l_name', 'like', "%{$value}%")
			    ->orWhere('email', 'like', "%{$value}%")
			   ->orWhere('phone', 'like', "%{$value}%");
            };
        })->orderBy('id','desc')->where('role_id', '!=','1')->latest()->paginate(15);
        return view('admin.team.list', compact('em'));
    }

    public function edit($id)
    {
        $e = Admin::where('role_id', '!=','1')->where(['id' => $id])->first();
        $rls = AdminRole::whereNotIn('id', [1])->get();
        return view('admin.team.edit', compact('rls', 'e'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'f_name' => 'required|max:100',
            'l_name' => 'nullable|max:100',
            'role_id' => 'required',
            'email' => 'required|unique:admins,email,'.$id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:admins,phone,'.$id,
        ], [
            'f_name.required' => 'first name is required',
        ]);

        if ($request->role_id == 1) {
			 return redirect()->back()->with('warning','Access Denied');
          
        }

        $e = Admin::where('role_id','!=',1)->findOrFail($id);
        if ($request['password'] == null) {
            $pass = $e['password'];
        } else {
            if (strlen($request['password']) < 6) {
                return redirect()->back()->with('warning','Password should be 6 letters long or above');
            }
            $pass = bcrypt($request['password']);
        }

        if ($request->has('image')) {
            $e['image'] = Helpers::update('admin/', $e->image, 'png', $request->file('image'));
        }

        DB::table('admins')->where(['id' => $id])->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $pass,
            'image' => $e['image'],
            'updated_at' => now(),
        ]);
        
		return redirect()->back()->withSuccess('Member Updated Successfully');
       
    }

    public function distroy($id)
    {
        $role=Admin::where('role_id', '!=','1')->where(['id'=>$id])->delete();
		return redirect()->back()->withSuccess('Member Deleted Successfully');
       
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $teams=Admin::where('role_id', '!=','1')
        ->where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('f_name', 'like', "%{$value}%");
                $q->orWhere('l_name', 'like', "%{$value}%");
                $q->orWhere('phone', 'like', "%{$value}%");
                $q->orWhere('email', 'like', "%{$value}%");
            }
        })->limit(50)->get();
        return response()->json([
            'view'=>view('admin-views.team.partials._table',compact('teams'))->render(),
            'count'=>$teams->count()
        ]);
    }
      public function exportteam(Request $request){
        $ad= Admin::where('role_id', '!=','1')->get();
        $storage = [];
        if(count($ad)>0){
         foreach($ad as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'first_name'=>$item->f_name,
                'last_name'=>$item->l_name,
                'email'=>$item->email,
                'phone'=>$item->phone,
                'image'=>$item->image,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('teams.xlsx');
    }else{
        return redirect()->back()->withErrors('No Team Member found');
    }
    }
}
