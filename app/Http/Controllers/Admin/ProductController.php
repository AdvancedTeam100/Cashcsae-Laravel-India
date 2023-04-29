<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Image;
use App\Models\Partner;
use App\Models\ProductPrice;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;


class ProductController extends Controller
{
    function index()
    {
        $products=Product::latest()->paginate(15);
        return view('admin.product.index',compact('products'));
    }
	 function liste(Request $request)
    {
	
        $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
      
        $products=Product::when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            };
        })
        ->orderBy('id','desc')->paginate(10);
        return view('admin.product.list',compact('products'));
    }
	 function sub_list()
    {
        $products=Product::paginate(15);
        return view('admin.product.sub-list',compact('products'));
    }

 
 public function update_cat_img(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);
		
         

          DB::table('products')->where(['id' => $id])->update([
            'image' => Helpers::upload('product/', 'png', $request->file('image')),
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('Product Image Updated Successfully');
       
    }
    
    function sub_index()
    {
        $products=Product::paginate(15);
        return view('admin.product.sub-index',compact('products'));
    }

	function trending(Product $product, Request $request){
		$product->trending = $request->trending;
        $product->save();

       return redirect()->back()->withSuccess('Status updated');
	}


    function sub_product_index()
    {
        return view('admin.product.index');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
        ], [
            'name.required' => 'Name is required!',
        ]);
		$image=$request->image;
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->desc;
		$product->affiliate_partner = $request->aff_partner;
        $product->image = Helpers::upload('product/', 'png', $image[0]);
        $product->save();
		if($image!= NULL){
          foreach($image as $images){
			  $insertimages= new Image();
			  $insertimages->product_id=$product->id;
			  $insertimages->image= Helpers::upload('product/', 'png', $images);
			  $insertimages->save();
		  }
		}
        $morefields=$request->morefields;
      
        $j=1;
        foreach($morefields as $moreFiel){
            if($moreFiel['adv_id'] != NULL && $moreFiel['mrp'] != NULL && $moreFiel['price'] != NULL && $moreFiel['url'] != NULL){
				
			$getpartner_details=Partner::where('id', $moreFiel['adv_id'])->first();
            $addfield1=new ProductPrice();
            $addfield1->product_id=$product->id;
			$addfield1->adv_id=$moreFiel['adv_id'];
            $addfield1->serial_number=$j;
			$addfield1->cashback=$moreFiel['cashback'];
			$addfield1->c_id=$moreFiel['c_id'];
            $addfield1->site_name=$getpartner_details->name;
            $addfield1->site_icon=$getpartner_details->image;
            $addfield1->mrp=$moreFiel['mrp'];
            $addfield1->price=$moreFiel['price'];
            $addfield1->url=$moreFiel['url'];
            $addfield1->created_at=now();
            $addfield1->updated_at=now();
            $addfield1->save();
            $j++;
           }
        }

      
       return redirect()->route('admin.product.list')->withSuccess('product added successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function status(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
		 return redirect()->back()->withSuccess('product status updated');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
        ]);
		$image=$request->image;
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->desc;
		$product->affiliate_partner = $request->aff_partner;
        $product->image = $request->has('image') ? Helpers::update('product/', $product->image, 'png', $image[0]) : $product->image;
        $product->save();
        $morefields=$request->morefields;
        $j=1;
         if($image!= NULL){
          foreach($image as $images){
			  $insertimages= new Image();
			  $insertimages->product_id=$product->id;
			  $insertimages->image= Helpers::upload('product/', 'png', $images);
			  $insertimages->save();
		  }
		 }
		
        foreach($morefields as $moreFiel){
            if($moreFiel['adv_id'] != NULL && $moreFiel['mrp'] != NULL && $moreFiel['price'] != NULL && $moreFiel['url'] != NULL){
				$getpartner_details=Partner::where('id', $moreFiel['adv_id'])->first();
            $productprices=ProductPrice::where('product_id',$id)->where('serial_number',$j)->first();
            if($productprices){
        
                $addfield2=ProductPrice::FindorFail($productprices->id);
                $addfield2->product_id=$id;
                $addfield2->adv_id=$moreFiel['adv_id'];
                $addfield2->serial_number=$j;
				$addfield2->c_id=$moreFiel['c_id'];
			    $addfield2->cashback=$moreFiel['cashback'];
                $addfield2->site_name=$getpartner_details->name;
                 $addfield2->site_icon=$getpartner_details->image;
                if(array_key_exists('site_image',$moreFiel)){
                $addfield2->site_icon=Helpers::upload('productsite/', 'png', $moreFiel['site_image']);
                }
                $addfield2->mrp=$moreFiel['mrp'];
                $addfield2->price=$moreFiel['price'];
                $addfield2->url=$moreFiel['url'];
                $addfield2->created_at=now();
                $addfield2->updated_at=now();
                $addfield2->save();
            }else{
            $addfield1=new ProductPrice();
            $addfield1->product_id=$id;
            $addfield1->adv_id=$moreFiel['adv_id'];
            $addfield1->serial_number=$j;
			$addfield1->c_id=$moreFiel['c_id'];
			$addfield1->cashback=$moreFiel['cashback'];
            $addfield1->site_name=$getpartner_details->name;
            $addfield1->site_icon=$getpartner_details->image;
             if(array_key_exists('site_image',$moreFiel)){
            $addfield1->site_icon=Helpers::upload('productsite/', 'png', $moreFiel['site_image']);
             }
            $addfield1->mrp=$moreFiel['mrp'];
            $addfield1->price=$moreFiel['price'];
            $addfield1->url=$moreFiel['url'];
            $addfield1->created_at=now();
            $addfield1->updated_at=now();
            $addfield1->save();
           
            }
             $j++;
           }
        }

       
		 return redirect()->route('admin.product.list')->withSuccess('product updated successfully');
    }

    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->id);
   
            $product->delete();
			 return redirect()->back()->withErrors('product removed');
       
    }
	
	public function delete_product_image(Request $request)
    {
        $product = Image::findOrFail($request->id);
   
            $product->delete();
			 return redirect()->back()->withErrors('Image removed');
       
    }



 
    public function active(Request $request, $id)
    {
        $category = Product::findOrFail($id);
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.product.list')->withSuccess('Product status updated Successfully');
    }
   
    public function searchproduct (Request $request){
        $key = explode(' ', $request['search']);
	
        $products=Product::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();

       
        return response()->json([
            'view'=>view('admin.product.partials._table',compact('products'))->render(),
            'count'=>$products->count()
        ]);
    }

      public function exportproduct(Request $request){
        $product = Product::get();
        $storage = [];
        if(count($product)>0){
         foreach($product as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'image'=>$item->image,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('products.xlsx');
    }else{
        return redirect()->back()->withErrors('No Product found');
    }
    }
}
