@extends('admin.layout.app')
@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
        @if(is_array(session()->get('success')))
            <ul>
                @foreach (session()->get('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            {{ session()->get('success') }}
        @endif
            </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
         {!! session("error") !!}
    </div>
    @endif
    @if (count($errors) > 0)
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{$errors->first()}}

        </div>
        @endif
    @endif
    <br>
    <div class="card">
        <div class="card-header">
            <div class="col-6 card-title">
                <p style="float: left">Edit Country </p> 
            </div>
            <div class="col-6">                
                <a class="btn btn-primary" href="{{ route('admin.country.index')}}" style="float:right;">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-group" action="{{route('admin.country.update',$country->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('Cuntry Name')}}</label>
                    <input type="text" name="country_name"  class="form-control" value="{{ $country->country_name}}">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('Country Code')}}</label>
                    <input type="text" name="country_code"  class="form-control" value="{{ $country->country_code}}">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('Phone Code')}}</label>
                    <input type="text" name="phone_code"  class="form-control" value="{{ $country->phone_code}}">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('Currency Symbol')}}</label>
                    <input type="text" name="currency_symbol"  class="form-control" value="{{ $country->currency_symbol}}">
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('Slug')}}</label>
                    <input type="text"  name="slug"  class="form-control no-space" value="{{ $country->slug}}">
                </div>
           
        </div>
        <div class="card-footer">
            <div>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function() {

// do not allow users to enter spaces:
$(".no-space").on({
  keydown: function(event) {
    if (event.which === 32)
      return false;
  },
  // if a space copied and pasted in the input field, replace it (remove it):
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

});
</script>
@endpush