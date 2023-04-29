@extends('admin.layout.app')
@section('title','Add new Coupon')

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
</style>
@endpush
@section('content')

          <div class="page-body">
          <div class="container-xl">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                  Create Coupon
                </h2></div>
              <div class="card-body">
               <form action="{{route('admin.coupon.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
				   
				     <div class="form-group"  id="viewerbox" style="display:none;margin-bottom:0%;">
						 <center>
							 <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; padding: 11px;" id="viewer"
								  @if(isset($category))
								  src="{{asset('storage/app/public/category')}}/{{$category['image']}}"
								  @else
								  src="{{asset('assets/theme_assets/img')}}/upload1.png"
								  @endif
								  alt="image"/>
						 </center>
                       </div>
				   <div class="row">
				    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">Coupon name</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"/>
                            </div>
					   </div>
					     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">Coupon Code</label>
                              <input type="text" class="form-control" name="code" id="code" value="{{old('code')}}"/>
                            </div>
					   </div>
					 </div>
				   <div class="row">
					 
				    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">Link To Redirect</label>
                              <input type="text" class="form-control" name="link" id="link" value="{{old('link')}}"/>
                            </div>
					   </div>
					     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">Button Text</label>
                              <input type="text" class="form-control" name="button_text" id="button_text" value="{{old('button_text')}}"/>
                            </div>
					   </div>
					 </div>
				     <div class="row">
					 
				    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">Start Date</label>
                              <input type="date" class="form-control" name="start_date" id="start_date" value="{{old('start_date')}}"/>
                            </div>
					   </div>
					     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                              <label class="form-label required">End Date</label>
                              <input type="date" class="form-control" name="end_date" id="end_date" value="{{old('end_date')}}"/>
                            </div>
					   </div>
					 </div>
				     <div class="row">
				
				    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				             <div class="mb-3">
                                       <label class="form-label required">Coupon Heading</label>
                                       <input type="text" class="form-control" name="heading" id="heading" value="{{old('heading')}}"/>
                                    </div>
						</div>
						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				             <div class="mb-3">
                                       <label class="form-label required">Coupon Short Description</label>
                                       <input type="text" class="form-control" name="description" id="description" value="{{old('description')}}"/>
                                    </div>
						
                                  
						</div>
				   </div>
				    <div class="row">
						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				              <div class="mb-3">
                                        <label class="input-label" for="exampleFormControlSelect1">Select Advertiser<span
                                                class="input-label-secondary"></span></label>
                                        <select name="adv_id" class="js-data-example-ajax form-control"  title="Select Offer">
											@foreach($partners as $partner)
											<option value="{{$partner->id}}">{{$partner->name}}</option>
											@endforeach
                                            
                                        </select>
                                    </div>
						  </div>
						 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                             <div class="mb-3">
                            <div class="form-label">Banner Image <small style="color: red">* (ratio=> 2:1)</small></div>
                            <input type="file"  name="banner_image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required />
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
					     </div>
				   </div>
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
                      </div></div></div></div>
                  

        <!-- Page body -->
       

@endsection


@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            

            $('#dataSearch').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
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
    
    <!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush
