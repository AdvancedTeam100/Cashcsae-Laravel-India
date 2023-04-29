@foreach($customers as $k=>$e)
                                <tr>
                                    <td id="row">{{$k+1}}</td>
                                
										<td class="sort-name"> @if($e['image']==NULL)
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$e->id}}">
Add Image</button>
									@else
							<img src="{{asset('storage/app/public/user')}}/{{$e['image']}}" alt="no image" style="width:80px">
									@endif </td>
                                 
                             
                             
                                    <td class="sort-name"><a href="{{route('admin.customer.profile',$e['id'])}}"> {{$e['name']}}</a></td>
                                     <td class="sort-email"> @if($e['email']==NULL)
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$e->id}}">
Add Email</button>
									@else
							        {{$e['email']}}
									@endif </td>
                                     <td class="sort-phone"> {{$e['phone']}}</td>
                                       <td class="sort-role"> <center> <label class="form-check form-check-single form-switch" for="stocksCheckbox{{$e->id}}">
                                          <input type="checkbox" class="form-check-input" onclick="myFunction()" id="stocksCheckbox{{$e->id}}" {{$e->status?'checked':''}}>
                                          </label>
                                        </center>
                                        <script>
                                    function myFunction() {
                                      if (window.confirm('Do you want to change the user status?'))
                                    {
                                        window.location.href = "{{route('admin.customer.status',[$e->id,$e->status?0:1])}}"
                                    }
                                    }
                                    </script>
                                                                            
                                    </td>
                                   
                                </tr>
						<!-- Modal -->
								<div class="modal fade" id="exampleModal{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$e->id}}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="{{route('admin.customer.update_img',$e->id)}}" method="post" enctype="multipart/form-data">
                                         @csrf
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel{{$e->id}}" align="left">Add Customer's Extra Data</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										 
							 @if($e['email']==NULL)
                             <div class="mb-3">
                            <div class="form-label">User Email <small style="color: red">*</small></div>
                            <input type="text"  name="email"  class="form-control"/>
                             </div>
							 @endif
							 @if($e['image']==NULL)
                            <div class="mb-3">
                            <div class="form-label">User Image <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                <label class="custom-file-label" for="customFileEg1"></label>
                             </div>
							 @endif
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
