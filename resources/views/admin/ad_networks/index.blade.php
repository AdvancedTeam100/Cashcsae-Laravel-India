@extends('admin.layout.app')
@section('title','Update Ad Network Settings')

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

element.style {
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
                 Update Ad Network Settings
                </h2>
               </div>
              <div class="card-body">
               <form action="{{route('admin.ad_network.update-setup')}}" method="post" enctype="multipart/form-data">
                    @csrf
				   <div class="row">
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                        @php($name=\App\Models\AdNetwork::where('key','admob')->first()->value)
                            <div class="mb-3">

                              <label class="form-label required">Admob Ads</label>
								 <select name="admob" class="form-control">
										<option value="1" @if($name==1) selected @endif>Enable</option>
										 <option value="0" @if($name==0) selected @endif>Disable</option>
								</select>
                            </div>
					   </div>
				    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
				   @php($fb=\App\Models\AdNetwork::where('key','facebookad')->first()->value)
                            <div class="mb-3">

                              <label class="form-label required">Facebook Ads</label>
                              <select name="fb" class="form-control">
										<option value="1" @if($fb==1) selected @endif>Enable</option>
										 <option value="0" @if($fb==0) selected @endif>Disable</option>
								</select>
                            </div>
					     </div>
					   </div>

                             <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                         </form> 
                            
                      </div></div></div></div>
                  

      



@endsection


@push('script_2')
    
    <!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush