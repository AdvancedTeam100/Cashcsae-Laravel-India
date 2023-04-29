@extends('admin.layout.app')
@section('title','Withdraw Requests List')

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
                 <div class="card-header"><h2 class="page-title" align="left" style="width: 100%;">
                  Customer Withdrawal Requests List
                </h2> <a  align="right" style="float:right !important;" href="{{route('admin.customer.exportwithdrawal')}}" class="btn btn-danger  float-right">Export All </a>&nbsp;</div>
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Amount</button></th>
						  <th><button class="table-sort" data-sort="sort-email">Withdraw Medium</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Status</button></th>
                        <th><button class="table-sort" data-sort="sort-role">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
      
                           @foreach($customers as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+$customers->firstItem()}}</td>
                              
                             
                                    <td class="sort-name"> {{$e->user['name']}} ({{$e->user['phone']}})</td>
                                     <td class="sort-email"> {{$e['amount']}}
										</td>
									<td class="sort-email"> <b>{{$e['medium']}}</b><br>{!! $e['medium_details'] !!}
										</td>
                                     <td class="sort-phone"> @if($e['approved']==0) <p style="color:orange"> Not Approved Yet</p>@elseif($e['approved']==2) <p style="color:red"> Rejected </p> @else  <p style="color:green">Approved</p>@endif
									</td>
                                      <td class="sort-phone"> @if($e['approved']==0) <a href="{{route('admin.customer.approve_withdraw_requests',$e['id'])}}" class="btn btn-primary" >Approve</a>&nbsp;&nbsp; <a href="{{route('admin.customer.reject_withdraw_requests',$e['id'])}}" class="btn btn-danger" >Reject</a>@elseif($e['approved']==2) <p style="color:red"> Rejected </p>@else  <p style="color:green">Approved</p>@endif
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
