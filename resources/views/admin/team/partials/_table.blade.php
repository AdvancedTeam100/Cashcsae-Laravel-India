@foreach($teams as $k=>$e)
<tr>
    <th id="row">{{$k+1}}</th>
    <td class="text-capitalize">{{$e['f_name']}} {{$e['l_name']}}</td>
    <td >
        {{$e['email']}}
    </td>
    <td>{{$e['phone']}}</td>
    <td>{{$e->role?$e->role['name']:__('messages.role_deleted')}}</td>
    <td>
        <a class="btn btn-sm btn-white"
            href="{{route('admin.team.edit',[$e['id']])}}" title="{{__('messages.edit')}} {{__('messages.Team')}}"><i class="tio-edit"></i>
        </a>
        <a class="btn btn-sm btn-danger" href="javascript:"
            onclick="form_alert('team-{{$e['id']}}','{{__('messages.Want_to_delete_this_role')}}')" title="{{__('messages.delete')}} {{__('messages.Team')}}"><i class="tio-delete-outlined"></i>
        </a>
        <form action="{{route('admin.team.delete',[$e['id']])}}"
                method="post" id="team-{{$e['id']}}">
            @csrf @method('delete')
        </form>
    </td>
</tr>
@endforeach