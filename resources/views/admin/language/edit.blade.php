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
            <div class="col-6">            
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Language </span></h4>
            </div>
            <div class="col-6">                
                <a class="btn btn-primary" href="{{ route('admin.language.index')}}" style="float:right;">Back</a>
            </div>
        </div>
        <form action="{{route('admin.language.update',$language->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">            
                <div class="form-group">
                    <label id="folderLabel">{{ __('Language Name')}}</label>
                    <input type="text" name="language_name" class="form-control" value="{{ $language->language_name}}">
                </div>
                <div class="form-group">
                    <label id="folderLabel">{{ __('Language Code')}}</label>
                    <input type="text" name="language_code" class="form-control" value="{{ $language->language_code}}">
                </div>                 
            </div>
            <div class="card-footer">  
                <button class="btn btn-primary" type="submit" value="Submit">Submit</button>          
            </div>
        </form>
    </div>
</div>
@endsection