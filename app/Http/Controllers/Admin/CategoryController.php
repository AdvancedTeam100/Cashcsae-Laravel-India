<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;


class CategoryController extends Controller
{
    function index()
    {
        $categories=Category::where(['position'=>0])->latest()->paginate(15);
        return view('admin.category.index',compact('categories'));
    }
	 function liste(Request $request)
    {
	
        $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
        $categories=Category::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })
        ->orderBy('id','desc')->where(['position'=>0])->latest()->paginate(10);
        return view('admin.category.list',compact('categories'));
    }
	 function sub_list()
    {
        $categories=Category::with(['parent'])->where(['position'=>1])->latest()->paginate(15);
        return view('admin.category.sub-list',compact('categories'));
    }

 
 public function update_cat_img(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);
		
         

          DB::table('categories')->where(['id' => $id])->update([
            'image' => Helpers::upload('category/', 'png', $request->file('image')),
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('Category Image Updated Successfully');
       
    }
    
    function sub_index()
    {
        $categories=Category::with(['parent'])->where(['position'=>1])->latest()->paginate(15);
        return view('admin.category.sub-index',compact('categories'));
    }



    function sub_category_index()
    {
        return view('admin.category.index');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:100',
        ], [
            'name.required' => 'Name is required!',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->image = Helpers::upload('category/', 'png', $request->file('image'));
        $category->parent_id = $request->parent_id == null ? 0 : $request->parent_id;
        $category->position = $request->position == null ? 0 : $request->position;
        $category->save();

      
       return redirect()->route('admin.category.list')->withSuccess('category added successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $request->status;
        $category->save();
		 return redirect()->back()->withSuccess('category status updated');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:categories,name,'.$id,
        ]);
        $category = Category::find($id);

        $category->name = $request->name;
        $category->image = $request->has('image') ? Helpers::update('category/', $category->image, 'png', $request->file('image')) : $category->image;
        $category->save();
       
		 return redirect()->route('admin.category.list')->withSuccess('category updated successfully');
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->childes->count()==0){
            $category->delete();
			 return redirect()->back()->withErrors('category removed');
        }else{
			 return redirect()->back()->withErrors('remove sub categories first');
          
        }
        return back();
    }

    public function get_all(Request $request){
        $data = Category::where('name', 'like', '%'.$request->q.'%')->limit(8)->get([DB::raw('id, CONCAT(name, " (", if(position = 0, "'.'main'.'", "'.'sub'.'"),")") as text')]);
        if(isset($request->all))
        {
            $data[]=(object)['id'=>'all', 'text'=>'All'];
        }
        return response()->json($data);
    }

    public function update_priority(Category $category, Request $request)
    {
        $priority = $request->priority??0;
        $category->priority = $priority;
        $category->save();
		 return redirect()->back()->withSuccess('category priority updated successfully');
        

    }

   
    public function searchcategory (Request $request){
        $key = explode(' ', $request['search']);
	
        $categories=Category::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admin.category.partials._table',compact('categories'))->render(),
            'count'=>$categories->count()
        ]);
    }

      public function exportcategory(Request $request){
        $category = Category::get();
        $storage = [];
        if(count($category)>0){
         foreach($category as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'image'=>$item->image,
                'cuelink_category_id'=>$item->cue_cat_id,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('categories.xlsx');
    }else{
        return redirect()->back()->withErrors('No Category found');
    }
    }
}
