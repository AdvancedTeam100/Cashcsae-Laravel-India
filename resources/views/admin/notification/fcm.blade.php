
@extends('admin.layout.app')
@section('title','FCM sttings')

@push('css_or_js')

@endpush
@section('content')
          <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-header"><h2 class="page-title">
                FCM Settings
                </h2>
               </div>
              <div class="card-body">
               <form action="{{route('admin.fcm.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
					
					  <div class="row">
			         <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">

                            <div class="mb-3">

                              <label class="form-label required">FCM Server Key</label>
                              <textarea class="form-control" name="server_key" id="server_key" placeholder="Server Key" >{{$fcm->server_key}}</textarea>
                            </div></div>
						  
						   
				   </div>
                          
				 
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
          </div></div></div></div>
          
                  

      



@endsection


@push('script_2')
      <script>
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
        });
    </script>
       <script>
        $("#generalSection").click(function() {
            $("#passwordSection").removeClass("active");
            $("#generalSection").addClass("active");
            $('html, body').animate({
                scrollTop: $("#generalDiv").offset().top
            }, 2000);
        });

        $("#passwordSection").click(function() {
            $("#generalSection").removeClass("active");
            $("#passwordSection").addClass("active");
            $('html, body').animate({
                scrollTop: $("#passwordDiv").offset().top
            }, 2000);
        });
    </script>
    
    <!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush


