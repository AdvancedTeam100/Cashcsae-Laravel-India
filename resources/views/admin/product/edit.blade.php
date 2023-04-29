@extends('admin.layout.app')
@section('title','Update Product')

@push('css_or_js')
<style>
    .flex.justify-between.flex-1.sm\:hidden {
    display: none;
}
                    
p.text-sm.text-gray-700.leading-5 {
    display: none;
}
svg.w-5.h-5 {
    width: 22px !important;
}


a.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.hover\:text-gray-500.focus\:z-10.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150 {
    margin: 3px;
    padding: 9px !important;
}



span.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5 {
    background-color: blue !important;
    color: white;
    margin: 3px;
    padding: 10px !important;
}
hr{
    border-bottom:2px solid grey !important;
}
</style>
@endpush
@section('content')

          <div class="page-body">
          <div class="container-xl">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                  Update Product
                </h2></div>
              <div class="card-body">
               <form action="{{route('admin.product.update',$product['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
				   <h4 align="center"> Product Images </h4><hr>
				          <div class="row">
                           
                                @php($images=\App\Models\Image::where('product_id',$product['id'])->get())
								  
								  @foreach($images as $imag)
								 <div class="col-lg-2 col-md-2 col-xl-1 col-sm-4 col-xs-4 mb-3" style="float:left">
								   <img src="{{asset('storage/app/public/product')}}/{{$imag['image']}}" alt="image" style="max-width:100px; max-height:100px;"><br> <a href="{{route('admin.product.delete_product_image',$imag['id'])}}" >Delete Image </a>
								  </div>
								  @endforeach
                             </div><hr>
							
				 
                            <div class="mb-3">
								<br>
                              <label class="form-label required mt-2">Product name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="product name" value="{{$product['name']}}"/>
                               <input type="hidden" name="position" value="0">
                            </div>
                            <div class="mb-3">
                              <label class="form-label required">Product Description</label>
                              <textarea name="desc" id="desc" class="form-control" id="summernote8">{{$product['description']}}</textarea>
                            </div>
				          
				       
                            
                            <div class="mb-3">
							
                            <div class="form-label">Images <small style="color: red">* (ratio=>1:1)</small></div>
                            <input type="file"  name="image[]" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" multiple/>
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
				   
				            <div class="mb-3">
                              <label class="form-label required">Select Affiliate Partner</label>
                              <select name="aff_partner" class="form-control" required>
								  <option value="admitad" @if($product['affiliate_partner']=="admitad") selected @endif> Admitad </option>
								  <option value="cuelinks" @if($product['affiliate_partner']=="cuelinks") selected @endif> Cuelinks </option>
								  <option value="impact" @if($product['affiliate_partner']=="impact") selected @endif> Impact </option>
					          </select>
                            </div>
				      
				   
                             <h3 align="center"> Add Prices</h3>
                             <div class="row">
                             <div class="container">
                                <?php $j=0;
								 $l=1;?>
                             @if(count($product->product_prices)>0)
                                	@foreach($product->product_prices as $fields)
                                <div class="row">
                                      <div class="col-md-4">
                                    <label class="form-label required">Select Advertiser no. {{$l}}</label>
										<select name="morefields[{{$j}}][adv_id]" class="form-control">
											@php($partner= \App\Models\Partner::get())
											@foreach($partner as $part)
											<option value="{{$part->id}}" @if($part->id==$fields['adv_id']) selected @endif>{{$part->name}} </option>
											@endforeach
										</select>
                                   
                                    </div>

                                    @php($currency_code=\App\Models\BusinessSetting::where('key','currency')->first()->value)
                                   <div class="col-md-4">
                                    <label class="form-label required">Cashback({{$currency_code}})</label>
                                    <input type="number" class="form-control" name="morefields[{{$j}}][cashback]" id="validationCustom01" placeholder="product cashback" value="{{$fields['cashback']}}"/></div>

                                     <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Campaign ID(required if partner is Admitad or Impact.)</label>
                                    <input type="text" class="form-control" name="morefields[{{$j}}][c_id]" id="validationCustom01" placeholder="product mrp"  value="{{$fields['c_id']}}"/>
                                   
                                    </div>
									
                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product MRP</label>
                                    <input type="number" class="form-control" name="morefields[{{$j}}][mrp]" id="validationCustom01" placeholder="product mrp"  value="{{$fields['mrp']}}"/>
                                   
                                    </div>


                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product price</label>
                                    <input type="number" class="form-control" name="morefields[{{$j}}][price]" id="validationCustom01" placeholder="product price"  value="{{$fields['price']}}"/>
                                   
                                    </div>


                                    <div class="col-md-4">
                                    <label class="form-label required" for="validationCustom01">Product Url</label>
                                    <input type="text" class="form-control" name="morefields[{{$j}}][url]" id="validationCustom01"  placeholder="product url"  value="{{$fields['url']}}"/>
                                   
                                    </div>

                               </div><hr>
                               <?php $j++; ?>
								  <?php $l++; ?>
                               @endforeach
                               @endif
                               
                               <div id="dynamicquestadd"></div>
                               <div class="col-12" align="right">
                                             
                                <label for="validationCustom01" class="form-label"></label><br>
                            <button type="button" name="add" id="add-questbtn" class="btn btn-primary">Add More</button>
                            <br>
                                </div>

                                </div>

                               
                            </div>
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
                      </div></div></div></div>
                  

        <!-- Page body -->
         <!-- jQuery UI 1.11.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>




<script type="text/javascript">
var j = {{$j}}-1;
var l=1;

$("#add-questbtn").click(function(){
++j;
++l;
$("#dynamicquestadd").append('<div class="row"><div class="col-md-4"><label class="form-label required">Select Advertiser no. '+l+'</label><select name="morefields['+j+'][adv_id]" class="form-control">@php($partner= \App\Models\Partner::get())@foreach($partner as $part)<option value="{{$part->id}}">{{$part->name}} </option>@endforeach</select></div><div class="col-md-4"><label class="form-label required">Cashback({{$currency_code}})</label><input type="number" class="form-control" name="morefields['+j+'][cashback]" id="validationCustom01" placeholder="product cashback"/></div><div class="col-md-4"><label class="form-label required">Campaign ID(required if affiliate partner is Admitad or Impact.)</label><input type="text" class="form-control" name="morefields['+j+'][c_id]" id="validationCustom01" placeholder="Campaign ID"/></div><div class="col-md-4"><label class="form-label required">Product MRP</label><input type="number" class="form-control" name="morefields['+j+'][mrp]" id="morefields['+j+'][mrp]" placeholder="product mrp"/></div><div class="col-md-4"><label class="form-label required">Product price</label><input type="number" class="form-control" name="morefields['+j+'][price]" id="validationCustom01" placeholder="product price"/></div><div class="col-md-4"><label class="form-label required">Product Url</label><input type="text" class="form-control" name="morefields['+j+'][url]" id="validationCustom01" placeholder="product url"/></div></div><hr>');
});

$(document).on('click', '.remove-tr', function(){  
$(this).parents('div').remove();
});  

var a=0;
var b=1;
$("#add-optionbtn").click(function(){
++a;
++b;
$("#dynamicoptionadd").append('<div class="mt-2 mb-2 col-md-12" style="float:left"><input type="text" name="chatmorefields['+j+'][type]['+a+'][option]" class="form-control" placeholder="option-'+b+'"></div>');
});
</script>

@endsection


@push('script_2')

<script type="text/javascript">
        $('#summernote8').summernote({
            height: 400
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
					document.getElementById("viewerbox").style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

         $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
    
  
@endpush
