@extends('admin.layout.app')
@section('title','Custom Role')
@push('css_or_js')

@endpush

@section('content')

          <div class="page-body">
          <div class="container-xl">
            <div class="card">
                 <div class="card-header"><h2 class="page-title">
                  Create Role
                </h2></div>
              <div class="card-body">
                <form action="{{route('admin.role.create')}}" method="post">
                        @csrf
                            <div class="mb-3">
                              <label class="form-label required">Role name</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"/>
                            </div>
                            <label class="input-label qcont" for="name">Module permission : </label>
                           <hr>
                            <div class="row">
                                
                                
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="banner" class="form-check-input"
                                               id="banner">
                                        <label class="form-label " for="banner">Banner</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="ads" class="form-check-input"
                                               id="ads">
                                        <label class="form-label " for="ads">Ads</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="coupon" class="form-check-input"
                                               id="coupon">
                                        <label class="form-label " for="coupon">Coupon</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="team" class="form-check-input"
                                               id="team">
                                        <label class="form-label " for="team">Team</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="category" class="form-check-input"
                                               id="category">
                                        <label class="form-label " for="category">Category</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="settings" class="form-check-input"
                                               id="settings">
                                        <label class="form-label " for="settings">Master Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="impact" class="form-check-input"
                                               id="impact">
                                        <label class="form-label " for="impact">Impact</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="customerList" class="form-check-input"
                                               id="customerList">
                                        <label class="form-label " for="customerList">Customer</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="advertiser" class="form-check-input"
                                               id="advertiser">
                                        <label class="form-label " for="advertiser">Advertiser</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="cuelink" class="form-check-input"
                                               id="cuelink">
                                        <label class="form-label " for="cuelink">Cuelink</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="allin" class="form-check-input"
                                               id="allin">
                                        <label class="form-label " for="allin">All in One Search</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="homeadv" class="form-check-input"
                                               id="homeadv">
                                        <label class="form-label " for="homeadv">App Homepage Advertiser</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="withdrawal" class="form-check-input"
                                               id="withdrawal">
                                        <label class="form-label " for="withdrawal">Withdrawal Requests</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="clicks" class="form-check-input"
                                               id="clicks">
                                        <label class="form-label " for="clicks">Clicks Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="orders" class="form-check-input"
                                               id="orders">
                                        <label class="form-label " for="orders">Orders Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="dispute" class="form-check-input"
                                               id="dispute">
                                        <label class="form-label " for="dispute">Dispute Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="notifications" class="form-check-input"
                                               id="notifications">
                                        <label class="form-label " for="notifications">Notifications</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="currency" class="form-check-input"
                                               id="currency">
                                        <label class="form-label " for="currency">Currency Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="pages" class="form-check-input"
                                               id="pages">
                                        <label class="form-label " for="pages">Pages</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="faq" class="form-check-input"
                                               id="faq">
                                        <label class="form-label " for="faq">FAQ</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="referral" class="form-check-input"
                                               id="referral">
                                        <label class="form-label " for="referral">Referral Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="fcm" class="form-check-input"
                                               id="fcm">
                                        <label class="form-label " for="fcm">Firebase Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="trending" class="form-check-input"
                                               id="trending">
                                        <label class="form-label " for="trending">Trending Search</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="admitad" class="form-check-input"
                                               id="admitad">
                                        <label class="form-label " for="admitad">Admitad</label>
                                    </div>
                                </div>
								
                            </div>
                             <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                         </form>
                            
                      </div></div></div></div>
                  

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
                 <div class="card-header"><h2 class="page-title">
                 Role List
                </h2></div>
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-name">s. no.</button></th>
                        <th><button class="table-sort" data-sort="sort-name">role_name</button></th>
                        <th><button class="table-sort" data-sort="sort-city">Modules</button></th>
                        <th><button class="table-sort" data-sort="sort-date">Created On</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                         @foreach($rl as $k=>$r)
                                <tr>
                                    <td id="row">{{$k+$rl->firstItem()}}</td>
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
                                    <div class="dropdown">
                                      <button class="btn btn-primary dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                      <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                                    href="{{route('admin.role.edit',[$r['id']])}}" title="edit role">Edit
                                                </a>
                                                <a  href="{{route('admin.role.delete',[$r['id']])}}" class="dropdown-item" href="javascript:"
                                                    onclick="return confirm('Are you sure?');" title="delete role">Delete
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
            </div>
          </div>
        </div>



@endsection








@push('script_2')
    <script>
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.role.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.count);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
        $(document).ready(function() {
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));
        });
    </script>
    <script src="{{asset('public/theme_assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush
