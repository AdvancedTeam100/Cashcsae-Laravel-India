@foreach($rl as $k=>$r)
    <tr>
        <td id="row">{{$k+1}}</td>
       <td class="sort-name">{{Str::limit($r['name'],25,'...')}}</td>
                                    <td class="text-capitalize sort-city">
                                        @if($r['modules']!=null)
                                            @foreach((array)json_decode($r['modules']) as $key=>$m)
                                               {{str_replace('_',' ',$m)}},
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="sort-date">{{date('d-M-y',strtotime($r['created_at']))}}</td>
                                   
                                    <td class="sort-type">
                                         <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                         Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                            href="{{route('admin.custom-role.edit',[$r['id']])}}" title="edit role">Edit
                                        </a>
                                        <a class="dropdown-item" href="javascript:"
                                            onclick="form_alert('role-{{$r['id']}}','Want to delete this role')" title="delete role">Delete
                                        </a>
                                        <form action="{{route('admin.custom-role.delete',[$r['id']])}}"
                                                method="post" id="role-{{$r['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                         </div>
                                        </div>
                                    </div>
            
                                    </td>
    </tr>
@endforeach