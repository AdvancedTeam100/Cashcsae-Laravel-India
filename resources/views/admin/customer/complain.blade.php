@extends('admin.layout.app')
@section('title','Complain List')

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
label.form-check.form-check-single.form-switch {
    float: left;
    margin-left: -25px !important;
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
                 <div class="card-header"><h2 class="page-title">
                  Complain List
                </h2></div>
              <div class="card-body">
                  <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Order Id</button></th>
						  <th><button class="table-sort" data-sort="sort-email">Complain</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Status</button></th>
                        <th><button class="table-sort" data-sort="sort-role">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                           @foreach($customers as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+$customers->firstItem()}}</td>
                              
                             
                                    <td class="sort-name"> {{$e->user['name']}} ({{$e->user['phone']}})</td>
                                     <td class="sort-email"> {{$e['order_id']}}
										</td>
									<td class="sort-email"> <b>{{$e['complain']}}</b>
										</td>
                                     <td class="sort-phone"> @if($e['status']==0) <p style="color:orange"> Not Replied Yet</p> @else  <p style="color:green">Replied</p>@endif
									</td>
                                      <td class="sort-phone"> @if($e['status']==0) <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$e->id}}">
										  Reply</button> @else  <p style="color:green">Replied<br><b style="color:black">Reply: </b><span style="color:black">{{$e['reply']}}</span></p>@endif
									</td>
                                   
                                </tr>
					
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
              </div>
               <div class="card-footer" align="right">
              
                            {{ $customers->links("pagination::bootstrap-4") }}
                   
                <!-- End Pagination -->
            </div>
            </div>
          </div>
        </div>
  @foreach($customers as $k=>$e)
	<!-- Modal -->
<div class="modal fade" id="exampleModal{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$e->id}}" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="{{route('admin.customer.reply',$e->id)}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel{{$e->id}}" align="left">Add Reply To Complain</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="mb-3">
						<div class="form-label">Complain <small style="color: red">* </small></div>
						<input type="text" class="form-control" value="{{$e['complain']}}" readonly/>
					</div>	

					<div class="mb-3">
						<div class="form-label">Reply <small style="color: red">* </small></div>
						<input type="text"  name="reply" class="form-control" required />
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@foreach($customers as $ed)
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer{{$ed->id}}').attr('src', e.target.result);
                    document.getElementById("viewerbox{{$ed->id}}").style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

         $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
@endforeach
    
    <!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush
