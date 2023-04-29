<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Country::get(); 
             return DataTables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function ($row) {
                     $btn = '';
                     $btn.='<div class="dropdown">
                     <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                     <ul class="dropdown-menu">               
                         </li>
                         <li><a class="dropdown-item" href="'.route('admin.country.edit',$row->id).'">Edit</a>
                         </li>
                         <li><a class="dropdown-item" href="'.route('admin.country.delete',$row->id).'">Delete</a>
                         </li>           
                     </ul>
                 </div>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }

        return view('admin.country.list');
    }
    public function store(Request $request){
        $request->validate([
            'afliate_partner' => 'required|max:100',
            'country_name' => 'required|max:100',
            'country_code' => 'required|max:100',
        ], [
            'afliate_partner.required' => 'Partner is required!',
            'country_name.required' => 'Country Name is required!',
            'country_code.required' => 'Country Code is required!',
        ]);

        $afliate_partner = implode(',',$request->afliate_partner);

        $country = Country::create([
            'country_name'      =>  $request->country_name,
            'country_code'      =>  $request->country_code,
            'currency_code'     =>  $request->currency_code,
            'currency_symbol'   =>  $request->currency_symbol,
            'phone_code'        =>  $request->phone_code,
            'afliate_partner'   =>  $afliate_partner,
        ]);
        if($country){
            return redirect()->back()->with('success','Country Create Successfuly');
        }else{
            return redirect()->back()->with('error','Something Went wrong');
        }
    }
    public function edit(Request $request,$id){
        $country = Country::find($id);
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'afliate_partner' => 'required|max:100',
            'country_name' => 'required|max:100',
            'country_code' => 'required|max:100',
        ], [
            'afliate_partner.required' => 'Partner is required!',
            'country_name.required' => 'Country Name is required!',
            'country_code.required' => 'Country Code is required!',
        ]);

        $country = Country::find($id);
        $country->country_code       = $request->country_code;
        $country->currency_symbol    = $request->currency_symbol;
        $country->country_name       = $request->country_name;
        $country->slug               = $request->slug;
        $country->update();
    }

    public function delete(Request $request,$id){
        $country = Country::find($id);
        $delete = $country->delete();
        if($delete){
            return redirect()->back()->with('error','Country Deleted SuccessFully!!');
        }else{
           return redirect()->back()->with('error', 'Somethng Went Wrorng !!') ;
        }
    }
} 
