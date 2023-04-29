@foreach($categories as $key=>$category)
                   
                                <tr>
                                    <td id="row">{{$key+1}}</td>
                                    
										 <td class="sort-name"> @if($category['image']==NULL)
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
Add Image</button>
									@else
							<img src="{{asset('storage/app/public/category')}}/{{$category['image']}}" alt="no image" style="width:80px">
									@endif </td>
                                 
                               
                              
                              
                                    <td class="sort-id">{{$category->id}}</td>
                                    <td class="sort-name"> {{Str::limit($category['name'], 20,'...')}}</td>
                                    <td class="sort-type">
                                    <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="{{route('admin.category.edit',[$category['id']])}}" title="edit category">Edit
                                                </a>
                                                <a  href="{{route('admin.category.delete',[$category['id']])}}" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete category">Delete
                                                </a>
                                      </div>
                                    </div>
                                    </td>
                                </tr>
						
						<!-- Modal -->
								<div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$category->id}}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									   <form action="{{route('admin.category.update_cat_img',$category->id)}}" method="post" enctype="multipart/form-data">
                                         @csrf
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel{{$category->id}}" align="left">Add Image</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"  align="right">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										 <div class="form-group"  id="viewerbox" style="display:none;margin-bottom:0%;">
                                <center>
                                    <img style="width: 200px;border: 1px solid #3399db; border-radius: 10px; max-height:200px; padding: 11px;" id="viewer"
                                            src="{{asset('storage/app/public/category')}}/{{$category['image']}}" alt="offer banner"/>
                                </center>
                            </div>
                            
                             <div class="mb-3">
                            <div class="form-label">Category Image <small style="color: red">* (ratio=> 1:1)</small></div>
                            <input type="file"  name="image" id="customFileEg1" class="form-control"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                <label class="custom-file-label" for="customFileEg1"></label>
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
