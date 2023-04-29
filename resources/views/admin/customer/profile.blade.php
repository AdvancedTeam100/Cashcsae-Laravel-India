@extends('admin.layout.app')
<?php  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json'); ?>
@section('title','Customer Profile')

@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Customer Profile
                </h2>
              </div>
       
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-md-6 col-lg-4">
                   <div class="card">
                  <div class="card-body p-4 text-center">
					  <img class="avatar avatar-xl mb-3 avatar-rounded" src="{{url('/')}}/storage/app/public/user/{{$customers['image']}}" onerror="this.src='{{url('/')}}/storage/app/public/images/noimage.png'" alt="no image" >
					 
                    <h3 class="m-0 mb-1"> <span class="badge bg-purple-lt" style="font-size: 18px !impoertant;">{{$customers['name']}}</span></h3>
                    <div class="text-muted"><span class="badge bg-yellow-lt" style="font-size: 18px !impoertant;"><b> Phone = </b>{{$customers['phone']}}</span></div>
                    <div class="mt-3">
						@if($bankdetails)
						<u><b>Bank/UPI/Paytm Details</b></u><br>
						@if($bankdetails['bank_name'] != NULL)
                        <b> Bank name = </b>{{$bankdetails['bank_name']}},<br><b> Account Number = </b>{{$bankdetails['ac_no']}}, <br><b> Account Holder Name = </b>{{$bankdetails['ac_holder_name']}},<br><b> IFSC = </b>{{$bankdetails['ifsc']}}
						<br>
						@endif
						@if($bankdetails['upi'] != NULL)
						<b>UPI :</b>{{$bankdetails['upi']}} <br>
						@endif
						@if($bankdetails['amazon_no'] != NULL)
						<b>Amazon :</b>{{$bankdetails['amazon_no']}} <br>
						@endif
						@if($bankdetails['paytm_no'] != NULL)
						<b>Paytm :</b>{{$bankdetails['paytm_no']}} <br>
						@endif
						@endif
						
                    </div>
                  </div>
                  <div class="d-flex">
                 
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-8">
				  <div class="card">
                 <div class="card-header"><h2 class="page-title">
                  Customer Complain List
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
                      
                           @foreach($complains as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+$complains->firstItem()}}</td>
                              
                             
                                    <td class="sort-name"> {{$e->user['name']}}</td>
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
                                {{$complains->appends(['complains' => $complains->currentPage()])->links()}}    
                         
                   
                <!-- End Pagination -->
            </div>
            </div>
                
              </div>
             
              <div class="col-md-12 col-lg-12">
                <div class="card">
                 <div class="card-header"><h2 class="page-title">
                  Customer Withdraw Requests List
                </h2></div>
              <div class="card-body">
                <div class="table" style="width:100%">
                  <table id="example2" class="display" style="width:100%">
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
                  
                           @foreach($reqs as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+$reqs->firstItem()}}</td>
                              
                             
                                    <td class="sort-name"> {{$e->user['name']}}</td>
                                     <td class="sort-email"> {{$e['amount']}}
										</td>
									<td class="sort-email"> <b>{{$e['medium']}}</b><br>{!! $e['medium_details'] !!}
										</td>
                                     <td class="sort-phone"> @if($e['approved']==0) <p style="color:orange"> Not Approved Yet</p>@elseif($e['approved']==2) <p style="color:red"> Rejected </p> @else  <p style="color:green">Approved</p>@endif
									</td>
                                      <td class="sort-phone"> @if($e['approved']==0) <a href="{{route('admin.customer.approve_withdraw_requests',$e['id'])}}" class="btn btn-primary" >Approve</a>&nbsp;&nbsp; <a href="{{route('admin.customer.reject_withdraw_requests',$e['id'])}}" class="btn btn-danger" >Reject</a>@elseif($e['approved']==2) <p style="color:red"> Rejected </p>@else  <p style="color:green">Approved</p>@endif
									</td>
                                   
                                </tr>
						<!-- Modal -->
								
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
              </div>
               <div class="card-footer" align="right">
               {{$reqs->appends(['reqs' => $reqs->currentPage()])->links()}} 
                          
                   
                <!-- End Pagination -->
            </div>
            </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="card">
                 <div class="card-header"><h2 class="page-title">
                  Customer Clicks List
                </h2></div>
              <div class="card-body">
               <div class="table" style="width:100%">
                  <table id="example3" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Click Id</button></th>
						  <th><button class="table-sort" data-sort="sort-email">image</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Url</button></th>
						    <th><button class="table-sort" data-sort="sort-phone">Created At</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
               
                           @foreach($clicks as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+$clicks->firstItem()}}</td>
                              
                             
                                    <td class="sort-name"> {{$e->user['name']}}</td>
                                     <td class="sort-email"> {{$e['id']}}
										</td>
									<td class="sort-email"> <img width="100px" src="{{$e['image']}}" onerror="this.src='{{url('/')}}/storage/app/public/images/noimage.png'" alt="no image" >
										</td>
                                     <td class="sort-email"> {{$e['tracking_link']}} 
										</td>
									
									 <td class="sort-email"> {{date('d-M-Y',strtotime($e['created_at']))}}
										</td>
                                   
                                </tr>
						
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
              </div>
               <div class="card-footer" align="right">
              
                            {{$clicks->appends(['clicks' => $clicks->currentPage()])->links()}} 
                   
                <!-- End Pagination -->
            </div>
            </div>
              </div>
              <div class="col-12">
                    <div class="card">
                 <div class="card-header"><h2 class="page-title">
                  Customer Order List
                </h2></div>
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example4" class="display" style="width:100%">
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
             
                           @foreach($orders as $k=>$e)
                                <tr>
                                    <td id="row" class="sort-s">{{$k+$orders->firstItem()}}</td>
									  <td>
                                 
                               <img src="{{asset('storage/app/public/partner')}}/{{$e['logo']}}" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-name"> {{$e->user['name']}}</td>
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
              
                       
				   {{$orders->appends(['orders' => $orders->currentPage()])->links()}} 
                   
                <!-- End Pagination -->
            </div>
            </div>
              </div>
              </div>
            </div>
          </div>
 @foreach($complains as $k=>$e)
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