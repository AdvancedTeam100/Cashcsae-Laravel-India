@foreach($categories as $key=>$category)
     <tr>
                                <td>{{$key+1}}</td>
                                 <td>
                                 
                               <img src="{{asset('storage/app/public/category')}}/{{$category['image']}}" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-id">{{$category->id}}</td>
                                    <td class="sort-name"> {{Str::limit($category['name'], 20,'...')}}</td>
                                     <td class="sort-parent">
                                    <span class="d-block font-size-sm text-body">
                                        {{Str::limit($category->parent['name'],20,'...')}}
                                    </span>
                                </td>
                                    <td class="sort-type">
                                    <span class="dropdown">
                                      <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="{{route('admin.category.edit',[$category['id']])}}" title="edit category">Edit
                                                </a>
                                                <a  href="{{route('admin.category.delete',[$category['id']])}}" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete category">Delete
                                                </a>
                                      </div>
                                    </span>
                                    </td>
                            </tr>
@endforeach
