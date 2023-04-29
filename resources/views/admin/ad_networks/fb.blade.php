@extends('admin.layout.app')
@section('title','Update Facebook Ads Settings')

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

.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}

</style>
@endpush
@section('content')
          <div class="page-body">
          <div class="container-xl">
			  <div class="row">
			    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <div class="card">
                <div class="card-header"><h2 class="page-title">
                 Update Facebook Ads Settings
                </h2>
               </div>
              <div class="card-body">
				 <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12"> 
              <button class="collapsible">Banner Ads</button>
                

            <div class="content">
                 <br>
            <div class="table" style="width:100%">
                  <table id="example1" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-id">Placement ID</button></th>
                        <th><button class="table-sort" data-sort="sort-name">Ad Location</button></th>
                         <th><button class="table-sort" data-sort="sort-id">status</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody" >
                          @foreach($banner as $ban)
                                <tr>
                                    <td class="sort-id">{{$ban->placement_id}}</td>
                                    <td class="sort-name">@if($ban->location==1) Top Of the Homepage @endif @if($ban->location==2) Middle Of the Homepage @endif @if($ban->location==3) Bottom Of the Homepage @endif</td>
                                    <td class="sort-id">@if($ban->status==1) <b style="color:green !important">Enabled </b>@else <b style="color:red !important">Disabled </b>@endif</td>
                                    <td class="sort-type">
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$ban->id}}">Edit</button>
                                   
                                    </td>
                                </tr>
                        
                        
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
 
         </div></div>
			 <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">	  
				  <button class="collapsible">Native Ads</button>
                

            <div class="content">
                 <br>
            <div class="table" style="width:100%">
                  <table id="example1" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-id">Placement ID</button></th>
                        <th><button class="table-sort" data-sort="sort-name">Ad Location</button></th>
                         <th><button class="table-sort" data-sort="sort-id">status</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody" >
                          @foreach($native as $ban)
                                <tr>
                                    <td class="sort-id">{{$ban->placement_id}}</td>
                                    <td class="sort-name">@if($ban->location==4) Category List @endif @if($ban->location==5) Campaign List @endif</td>
                                    <td class="sort-id">@if($ban->status==1) <b style="color:green !important">Enabled </b>@else <b style="color:red !important">Disabled </b>@endif</td>
                                    <td class="sort-type">
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$ban->id}}">Edit</button>
                                    </td>
                                </tr>
                        
                        
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
 
         </div></div>
				  
	<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">	  
				  <button class="collapsible">Interstitial Ad</button>
                

            <div class="content">
                 <br>
				
				 <form action="{{route('admin.fbads.update',$interstitial->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
					<div class="row">
					   <div class="col-12 col-lg-12 col-md-12">
                                     <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" @if($interstitial->status==1) selected @endif>Enable</option>
												  <option value="0" @if($interstitial->status==0) selected @endif>Disable</option>
											</select>
                                         </div>
                                     </div>
						</div>
					  <div class="row">
                                     <div class="col-12 col-lg-6 col-md-6"  style="float:left">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Placement ID</label>
                                            <input type="text" name="placement_id" class="form-control" placeholder="" value="{{$interstitial->placement_id}}" required>
                                         </div>
                                        
                                         </div>
						    <div class="col-12 col-lg-6 col-md-6"  style="float:left">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Show After How Many Clicks</label>
                                            <input type="text" name="clicks" class="form-control"  value="{{$interstitial->clicks}}" required>
                                         </div>
                                        
                                </div>
						  </div>
					  <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
				</form>
        
 
         </div></div> 
    </div> </div></div>
 </div></div></div>          
@foreach($banner as $ban)
								<div class="modal fade" id="exampleModal{{$ban->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$ban->id}}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="{{route('admin.fbads.update',$ban->id)}}" method="post" enctype="multipart/form-data">
                                         @csrf
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel{{$ban->id}}" align="left">Edit Ad</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										  <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" @if($ban->status==1) selected @endif>Enable</option>
												  <option value="0" @if($ban->status==0) selected @endif>Disable</option>
											</select>
                                         </div>
                                        
                                         </div>
										  
                                        <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Placement Id</label>
                                            <input type="text" name="placement_id" class="form-control"  value="{{$ban->placement_id}}" required>
                                         </div>
                                        
                                         </div>
										  
										 
                           
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
									</div>
								</form>
								  </div>
								</div>
@endforeach
      

@foreach($native as $ban)
								<div class="modal fade" id="exampleModal{{$ban->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$ban->id}}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="{{route('admin.fbads.update',$ban->id)}}" method="post" enctype="multipart/form-data">
                                         @csrf
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel{{$ban->id}}" align="left">Edit Ad</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										  <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Enable/Disable</label>
                                            
											 <select name="status" class="form-control">
												 <option value="1" @if($ban->status==1) selected @endif>Enable</option>
												  <option value="0" @if($ban->status==0) selected @endif>Disable</option>
											</select>
                                         </div>
                                        
                                         </div>
										  
                                        <div class="col-12 col-lg-12 col-md-12">
                                         <div class="mb-3">
                                            <label class="form-label required" for="exampleFormControlInput1">Placement Id</label>
                                            <input type="text" name="placement_id" class="form-control"  value="{{$ban->placement_id}}" required>
                                         </div>
                                        
                                         </div>
										  
										 
                           
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									  </div>
									</div>
								</form>
								  </div>
								</div>
@endforeach
      

@endsection


@push('script_2')
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
    
    
    <!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush