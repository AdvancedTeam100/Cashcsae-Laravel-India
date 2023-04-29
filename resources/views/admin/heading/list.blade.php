@extends('admin.layout.app')
@section('title',' Home Advertisers List')

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
                 <div class="card-header">	<h2 class="page-title" align="left" style="width: 100%;">
                          Home Advertisers List
						
                       </h2>
					 <a  align="right" style="float:right !important;" href="{{route('admin.homeadv.add')}}" class="btn btn-primary  float-right">Add New </a>&nbsp;<button class="btn btn-info" data-toggle="modal" data-target="#positionModal">Set Position</button></div>
              <div class="card-body">
                <div id="table-default" class="table-bordered table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                        <th><button class="table-sort" data-sort="sort-name">Advertiser Name</button></th>
                         <th><button class="table-sort" data-sort="sort-offer">Rank</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      <tr>
                          @foreach($homeads as $key=>$homead)
                                <tr>
                                    <td id="row">{{$key+1}}</td>
                                  
                                    <td class="sort-name"> {{$homead->adv->name}}</td>
									<td class="sort-offer"> {{$homead->rank}}</td>
                               
                                    <td class="sort-type">
                                    <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="{{route('admin.homeadv.edit',[$homead['id']])}}" title="edit Home Advertiser">Edit
                                                </a>
                                                <a  href="{{route('admin.homeadv.delete',[$homead['id']])}}" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete heading">Delete
                                                </a>
                                      </div>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        
                    </tbody>
                  </table>
                </div>
              </div>
           
				<!-- set position Modal start -->
  <div class="modal fade" id="positionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Set Home Advertisers Position</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{route('admin.homeadv.change-postion')}}">
          {{csrf_field()}}
         <div id="table-default" class="table-bordered table-responsive">
                  <table class="table EU_DataTable" cellspacing="0" rules="all" border="0" id="GridView1" style="width:100%; text-align:center; margin-top: -35px; border-collapse:separate; border-spacing: 0 5px;">
            <tbody class="tbody">
              <tr>
                <th id="col" style="width: 10%">#</th>
                <th id="col" style="width: 70%">Partner Name'</th>
                <th id="col" style="width: 20%">Position</th>
              </tr>
              @if(count($homeads)>0)
                @php $i=1; @endphp
                @foreach($homeads as $adminTopApps)
                <tr>
                  <td class="ui-sortable-handle" style="border-radius: 5px 0px 0px 5px; background: #20E8C4;">{{$i}}</td>
                  <td class="ui-sortable-handle" style="border-radius: 0px 0px 0px 0px; background: #20E8C4;">{{$adminTopApps->adv->name}}</td>
                  <td class="ui-sortable-handle" style="border-radius: 0px 5px 5px 0px; background: #20E8C4;"><span class="dragRowPos{{$adminTopApps->rank}}">{{$adminTopApps->rank}}</span><input type="hidden" name="{{$adminTopApps->id}}" value="{{$adminTopApps->rank}}" class="dragRow{{$adminTopApps->rank}}"></td>
                </tr>
                @php $i++; @endphp
                @endforeach
                @else
                <tr>
                  <td>No data found</td>
                </tr>
                @endif
              </tbody>
            </table>
			</div>
              <button type="button" class="btn btn-light" data-dismiss="modal" style="float: right; margin-top: 10px;">Cancel</button>
              <button type="submit" class="btn btn-warning" style="float: right; margin-top: 10px; margin-right: 10px;">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
<!-- set position Modal Ends -->
            </div>
          </div>
        </div>



@endsection


@push('script_2')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<style>
  .DragMe:Hover {
    cursor: move;
  }
</style>
<script type="text/javascript">
  $(document).ready(function () {

     $('.tbody').addClass("DragMe");

     $('.DragMe').sortable({
         disabled: false,
         axis: 'y',
         items: "> tr:not(:first)",
         forceHelperSize: true,
         update: function (event, ui) {
             var Newpos = ui.item.index();
             var RefID = $('tr').find('td:first').html();

             //alert("Position " + Newpos + "..... RefID: " + RefID);
             $("#GridView1 tr:has(td)").each(function () {
                var RefID = $(this).find("td:eq(0)").html();
                var NewPosition = parseInt($("tr").index(this)) - {{count($homeads)+2}};
                $('.dragRow'+RefID).attr('value', NewPosition);
                $('.dragRowPos'+RefID).text(NewPosition);
                   //alert(NewPosition);
            });

         }
     }).disableSelection();
 });
</script>

@endpush
