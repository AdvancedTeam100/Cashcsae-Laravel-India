@extends('admin.layout.app')
@section('title','Update Offer')

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
                  Update Ad
                </h2></div>
              <div class="card-body">
               <form action="{{route('admin.ads.update',[$e['id']])}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="mb-3">
                       <label class="form-label required">Ad Name</label>
                       <input type="text" name="name" placeholder="enter ad name" value="{{$e['name']}}" required>
                    </div>
                     <div class="mb-3">
                       <label class="form-label required">Advertiser</label>
                        <select id="exampleFormControlSelect1" name="partner_id" class="form-control js-select2-custom" required>
                                        <option value="" selected disabled>Select Advertiser</option>
                                        @foreach($rls as $r)
                                            <option value="{{$r->id}}" @if($r->id == $e['partner_id']) selected @endif>{{$r->name}}</option>
                                        @endforeach
                              
                        </select>
                    </div>

                  <div class="mb-3">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">Category<span
                                        class="input-label-secondary">*</span></label>
                                <select name="category_id" id="category-id" class="form-control js-select2-custom">
                                    <option value="">---select---</option>
                                    @php($categories=\App\Models\Category::where(['position' => 0])->get())
                                    @foreach($categories as $category)
                                        <option value="{{$category['id']}}" {{ $category->id==$e->category_id ? 'selected' : ''}} >{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                   
                            <div class="mb-3">
                              <label class="form-label required">Description</label>
                               <textarea class="form-control" name="description" id="summernote">{{$e['description']}}</textarea>
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">Button Text</label>
                              <input type="text" class="form-control" name="button_text" id="button_text" value="{{$e['button_text']}}" placeholder="ex: grab deal"/>
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">Button Url</label>
                              <input type="text" class="form-control" name="button_url" id="button_url" value="{{$e['button_url']}}" placeholder="ex: https:://xyz.com"/>
                            </div>
                            
                             
                              <div class="form-group"  id="viewerbox" style="display:none;margin-bottom:0%;">
                                <center>
                                    <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; max-height:200px; padding: 11px;" id="viewer"
                                            src="{{asset('storage/app/public/offer')}}/{{$e['image']}}" alt="offer banner"/>
                                </center>
                            </div>
                            
                             <div class="mb-3">
                            <div class="form-label">Ads Banner <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
                      </div></div></div></div>
                  

      



@endsection


@push('script_2')
  <script>
        function getStoreData(route, store_id, id) {
            $.get({
                url: route+store_id,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
            $('#image-viewer-section').show(1000)
        });

        $(document).ready(function () {
            setTimeout(function () {
                let category = $("#category-id").val();
             
            
            }, 1000)
        });
    </script>

    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
        
        
    </script>

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
                $.post({
                    url: '{{route('admin.category.search')}}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        $('#table-div').html(data.view);
                        $('#itemCount').html(data.count);
                        $('.page-area').hide();
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
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