@extends('admin.layout.app')
@section('title','Add new Team Member')

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
                  Add Team Member
                </h2>
               </div>
              <div class="card-body">
               <form action="{{route('admin.team.added')}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="mb-3">
                       <label class="form-label required">Role</label>
                        <select id="exampleFormControlSelect1" name="role_id" class="form-control js-select2-custom" required>
                                        <option value="" selected disabled>Select Role</option>
                                        @foreach($rls as $r)
                                            <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                              
                        </select>
                    </div>
                            <div class="mb-3">
                              <label class="form-label required">First name</label>
                              <input type="text" class="form-control" name="f_name" id="f_name" value="{{old('f_name')}}" placeholder="john" />
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">Last name</label>
                              <input type="text" class="form-control" name="l_name" id="l_name" value="{{old('l_name')}}" placeholder="doe"/>
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">Phone</label>
                              <input type="phone" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="9999999999"/>
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">email</label>
                              <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="xyz@gmail.com"/>
                               <input type="hidden" name="position" value="1">
                            </div>
                             <div class="mb-3">
                              <label class="form-label required">Password</label>
                              <input type="text" class="form-control" name="password" id="password"  placeholder="Enter 6 letters or Above password" />
                               <input type="hidden" name="position" value="1">
                            </div>
                             
                              <div class="form-group"  id="viewerbox" style="display:none;margin-bottom:0%;">
                                <center>
                                    <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; max-height:200px; padding: 11px;" id="viewer"
                                            src="{{asset('public/theme_assets/img')}}/upload1.png" alt="Team thumbnail"/>
                                </center>
                            </div>
                            
                             <div class="mb-3">
                            <div class="form-label">Image <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required />
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