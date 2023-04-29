 @foreach($partners as $key=>$partner)
                                <tr>
                                    <td id="row">{{$key+1}}</td>
                                    <td>
                                 
                               <img src="{{asset('storage/app/public/partner')}}/{{$partner['image']}}" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-id">{{$partner->id}}</td>
									<td class="sort-id">{{$partner->affiliate_partner}}</td>
                                    <td class="sort-name"> {{Str::limit($partner['name'], 20,'...')}}</td>
									<td class="sort-name"> @if($partner['tagline']==NULL)
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#examplseModal{{$partner->id}}">
Add Tagline</button>
									@else
										<p>{{$partner->tagline}}</p>
									@endif </td>
									 <td class="sort-role"> <center> <label class="form-check form-check-single form-switch" for="stocksCheckbox{{$partner->id}}">
                                          <input type="checkbox" class="form-check-input" onclick="myFunction{{$partner->id}}()" id="stocksCheckbox{{$partner->id}}" {{$partner->top_cashback?'checked':''}}>
                                          </label>
                                        </center>
                                        <script>
                                    function myFunction{{$partner->id}}() {
                                      if (window.confirm('Do you want to change the top cashback status?'))
                                    {
                                        window.location.href = "{{route('admin.advertiser.top_cashback',[$partner->id,$partner->top_cashback?0:1])}}"
                                    }
                                    }
                                    </script>
                                                                            
                                    </td>
									<?php  $date=date_format($partner['created_at'],"d-M-Y"); ?>
									 <td class="sort-name"> {{$date}}</td>
                                    <td class="sort-type">
                                    <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="{{route('admin.advertiser.edit',[$partner['id']])}}" title="edit partner">Edit
                                                </a>
                                                <a  href="{{route('admin.advertiser.delete',[$partner['id']])}}" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete partner">Delete
                                                </a>
                                      </div>
                                    </div>
                                    </td>
                                </tr>
						<!-- Tagline -->
							<div class="modal fade" id="examplseModal{{$partner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$partner->id}}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="{{route('admin.advertiser.update_tagline',$partner->id)}}" method="post" enctype="multipart/form-data">
                                         @csrf
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="example2ModalLabel{{$partner->id}}" align="left">Add Tagline</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										 <div class="mb-3">
                              <label class="form-label required">Tagline</label>
                               <input type="text" name="tagline" class="form-control" value="{{$partner->tagline}}">
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