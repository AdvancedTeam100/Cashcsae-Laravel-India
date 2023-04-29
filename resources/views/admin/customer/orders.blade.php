@extends('admin.layout.app')
@section('title','Order List')

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
                  Orders List
                </h2> <a  align="right" style="float:right !important;" href="{{route('admin.customer.exportorders')}}" class="btn btn-danger  float-right">Export All </a>&nbsp;</div>
              <div class="card-body">
                <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
						 <th><button class="table-sort" data-sort="sort-name">Image</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                         <th><button class="table-sort" data-sort="sort-email">Order Id</button></th>
						 <th><button class="table-sort" data-sort="sort-id">Partner Order Id</button></th>
						 <th><button class="table-sort" data-sort="sort-phone">Advertiser</button></th>
                         <th><button class="table-sort" data-sort="sort-partner">Affiliate partner</button></th>
						  <th><button class="table-sort" data-sort="sort-order">Comission Status</button></th>
						 <th><button class="table-sort" data-sort="sort-order">Order Amount</button></th>
						  <th><button class="table-sort" data-sort="sort-url">Admin Earning</button></th>
				         <th><button class="table-sort" data-sort="sort-earning">User Earning</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
             
                           @foreach($customers as $k=>$e)
                                <tr>
                                    <td id="row" class="sort-s">{{$k+$customers->firstItem()}}</td>
									  <td>
                                 
                               <img src="{{asset('storage/app/public/partner')}}/{{$e['logo']}}" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-name"> {{$e->user['name']}} ({{$e->user['phone']}})</td>
                                     <td class="sort-email"> {{$e['id']}}</td>
									<td class="sort-id"> {{$e['partner_order_id']}}</td>
									<td class="sort-phone"> {{$e['advertisers']}}</td>
									<td class="sort-partner"> <b>{{$e['affiliate_partner']}}</b></td>
									<td class="sort-url"> <b>@if($e['order_status']==0) <span style="color:orange">Pending </span> @elseif($e['order_status']==1)  <span style="color:green">Approved </span> @else  <span style="color:red">Rejected </span> @endif</b></td>
									<td class="sort-order"> <b>{{$e['order_amount']}}</b></td>
										<td class="sort-url"> <b>{{$e['admin_earn']}}</b></td>
									<td class="sort-earning"> <b>{{$e['earning_amount']}}</b></td>
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
    

@endpush
