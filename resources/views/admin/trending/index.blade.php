@extends('admin.layout.app')
@section('title','Trending Search Keywords')

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
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
                <div class="card-header">
					<h2 class="page-title" align="left" style="width: 100%;">
                         Trending Search Keywords
						
                       </h2></div>
               <div class="card-body">
               <form action="{{route('admin.trending.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                            <div class="mb-3">
                              <label class="form-label required">Keyword name</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required/>
                               <input type="hidden" name="position" value="0">
                            </div>
                            <div class="mb-3">
								 <label class="form-label required">Added Keywords</label>
								 <div class="badges-list">
									 @foreach($trending as $trend)
									 <span class="badge bg-blue-lt" style="font-size: 14px;"><span class="neww">{{$trend->name}}</span><a href="{{route('admin.trending.delete', $trend->id)}}"  align="right">
										  <span aria-hidden="true">&times;</span>
										</a></span>&nbsp; &nbsp;
									 @endforeach
                                  </div>
							</div>
                             
                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form>
                            
                      </div>
            
            </div>
          </div>
        </div>

@endsection


@push('script_2')
    <script>
		
        $(document).on('ready', function () {
             
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

  
@endpush