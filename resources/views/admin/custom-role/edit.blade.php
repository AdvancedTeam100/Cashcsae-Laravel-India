@extends('admin.layout.app')
@section('title','Custom Role')
@push('css_or_js')

@endpush

@section('content')
 
          <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-header"><h2 class="page-title">
                  Update Role
                </h2></div>
              <div class="card-body">
                <form action="{{route('admin.role.update',[$role['id']])}}" method="post">
                        @csrf
                            <div class="mb-3">
                              <label class="form-label required">Role name</label>
                              <input type="text" class="form-control" name="name" id="name"  value="{{$role['name']}}"/>
                            </div>
                            <label class="input-label qcont" for="name">Module permission : </label>
                           <hr>
                            <div class="row">
                                
                               
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="banner" class="form-check-input"
                                               id="banner" {{in_array('banner',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="banner">Banner</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="ads" class="form-check-input"
                                               id="ads" {{in_array('ads',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="ads">Ads</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="coupon" class="form-check-input"
                                               id="coupon" {{in_array('coupon',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="coupon">Coupon</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="team" class="form-check-input"
                                               id="team" {{in_array('team',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="team">Team</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="category" class="form-check-input"
                                               id="category" {{in_array('category',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="category">Category</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="settings" class="form-check-input"
                                               id="settings" {{in_array('settings',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="settings">Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="impact" class="form-check-input"
                                               id="impact" {{in_array('impact',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="impact">Impact</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="customerList" class="form-check-input"
                                               id="customerList" {{in_array('customerList',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="customerList">Customer</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="advertiser" class="form-check-input"
                                               id="advertiser" {{in_array('advertiser',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="advertiser">Advertiser</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="cuelink" class="form-check-input"
                                               id="cuelink" {{in_array('cuelink',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="cuelink">Cuelink</label>
                                    </div>
                                </div><div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="allin" class="form-check-input"
                                               id="allin" {{in_array('allin',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="allin">All in One Search</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="homeadv" class="form-check-input"
                                               id="homeadv" {{in_array('homeadv',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="homeadv">Home Advertiser</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="homeadv" class="form-check-input"
                                               id="withdrawal" {{in_array('withdrawal',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="withdrawal">Withdrawal Requests</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="clicks" class="form-check-input"
                                               id="clicks" {{in_array('clicks',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="clicks">Clicks Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="orders" class="form-check-input"
                                               id="orders"  {{in_array('orders',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="orders">Orders Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="dispute" class="form-check-input"
                                               id="dispute"  {{in_array('dispute',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="dispute">Dispute Management</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="notifications" class="form-check-input"
                                               id="notifications"  {{in_array('notifications',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="notifications">Notifications</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="currency" class="form-check-input"
                                               id="currency"  {{in_array('currency',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="currency">Currency Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="pages" class="form-check-input"
                                               id="pages"  {{in_array('pages',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="pages">Pages</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="faq" class="form-check-input"
                                               id="faq"  {{in_array('faq',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="faq">FAQ</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="referral" class="form-check-input"
                                               id="referral"  {{in_array('referral',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="referral">Referral Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="fcm" class="form-check-input"
                                               id="fcm"  {{in_array('fcm',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="fcm">Firebase Settings</label>
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="trending" class="form-check-input"
                                               id="trending"  {{in_array('trending',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="trending">Trending Search</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="admitad" class="form-check-input"
                                               id="admitad" {{in_array('admitad',(array)json_decode($role['modules']))?'checked':''}}>
                                        <label class="form-label " for="admitad">Admitad</label>
                                    </div>
                                </div>
                            </div>
                             <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                         </form>
                            
                      </div></div></div></div>
                  
@endsection

