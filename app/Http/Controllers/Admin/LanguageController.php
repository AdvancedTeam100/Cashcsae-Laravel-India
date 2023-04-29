<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Language::get(); 
             return DataTables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function ($row) {
                     $btn = '';
                     $btn.='<div class="dropdown">
                     <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                     <ul class="dropdown-menu">               
                         </li>
                         <li><a class="dropdown-item" href="'.route('admin.language.edit',$row->id).'">Edit</a>
                         </li>
                         <li><a class="dropdown-item" href="'.route('admin.language.delete',$row->id).'">Delete</a>
                         </li>           
                     </ul>
                 </div>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
        
         
         return view('admin.language.list');
    }

    public function store(Request $request){
        $request->validate([
            'language_name' => 'required|max:100',
            'language_code' => 'required|max:100',
        ], [
            'country_name.required' => 'Language Name is required!',
            'country_code.required' => 'Language Code is required!',
        ]);
        
        $language = new Language;
        $language->language_name     =  $request->language_name;
        $language->language_code     =  $request->language_code;
        $language->save();

        if($language){
            return redirect()->back()->with('success','Language Create Successfuly');
        }else{
            return redirect()->back()->with('error','Something Went wrong');
        }
    }
   
    public function edit($id){ 
        $language = Language::find($id);
        return view('admin.language.edit',compact('language'));
    }
    public function update(Request $request,$id){ 
        $request->validate([
            'language_name' => 'required|max:100',
            'language_code' => 'required|max:100',
        ], [
            'country_name.required' => 'Language Name is required!',
            'country_code.required' => 'Language Code is required!',
        ]);
        $language = Language::find($id);       
        $language->language_name     =  $request->language_name;
        $language->language_code     =  $request->language_code;
        $language->update();
        if($language){
            return redirect()->route('admin.language.index')->with('success','Language Update SuccessFully!!');
        }else{
           return redirect()->back()->with('error', 'Somethng Went Wrorng !!') ;
        }
    }

    public function delete(Request $request,$id){
        $language = Language::find($id);
        $delete = $language->delete();
        if($delete){
            return redirect()->back()->with('error','Language Deleted SuccessFully!!');
        }else{
           return redirect()->back()->with('error', 'Somethng Went Wrorng !!') ;
        }
    }
}
