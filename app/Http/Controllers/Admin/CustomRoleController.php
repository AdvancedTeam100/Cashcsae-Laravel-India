<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomRoleController extends Controller
{
    public function create()
    {
        $rl=AdminRole::whereNotIn('id',[1])->latest()->paginate(config('default_pagination'));
        return view('admin.custom-role.create',compact('rl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admin_roles|max:191',
            'modules'=>'required|array|min:1'
        ],[
            'name.required'=>'Role name is required!',
            'modules.required'=>'Please select atleast one module'
        ]);
        DB::table('admin_roles')->insert([
            'name'=>$request->name,
            'modules'=>json_encode($request['modules']),
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        
		return redirect()->back()->withSuccess('role_added_successfully');
    
    }

    public function edit($id)
    {
        if($id == 1)
        {
            return view('errors.404');
        }
        $role=AdminRole::where(['id'=>$id])->first(['id','name','modules']);
        return view('admin.custom-role.edit',compact('role'));
    }

    public function update(Request $request,$id)
    {
        if($id == 1)
        {
            return view('errors.404');
        }
        $request->validate([
            'name' => 'required|max:191|unique:admin_roles,name,'.$id,
            'modules'=>'required|array|min:1'
        ],[
            'name.required'=>'Role name is required!',
            'modules.required'=>'Please select atleast one module'
        ]);

        DB::table('admin_roles')->where(['id'=>$id])->update([
            'name'=>$request->name,
            'modules'=>json_encode($request['modules']),
            'status'=>1,
            'updated_at'=>now()
        ]);

		return redirect()->back()->withSuccess('role updated successfully');

    }
    public function distroy($id)
    {
        if($id == 1)
        {
            return view('errors.404');
        }
        $role=AdminRole::where(['id'=>$id])->delete();
		return redirect()->back()->withSuccess('role deleted successfully');
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $rl=AdminRole::where('id','!=','1')
        ->where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->latest()->limit(50)->get();
        return response()->json([
            'view'=>view('admin.custom-role.partials._table',compact('rl'))->render(),
            'count'=>$rl->count()
        ]);
    }
}
