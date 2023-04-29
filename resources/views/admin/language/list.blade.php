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
            <div class="row w-100"> 
                <div class="col-6">
                    <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Language </span></h4>
                </div>
                <div class="col-6">                      
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addlanguage" style="float:right">{{ __('Add Language')}}</button>
                </div>           
            </div>
            <div class=" justify-content-between align-items-center flex-wrap grid-margin">
              
                    <!-- Modal -->
                 <div class="modal fade" id="addlanguage" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="folderLabel">Add Language</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <form action="{{route('admin.language.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">                                            
                                    <div class="form-group">
                                    <label id="folderLabel">{{ __('Language Name')}}</label>
                                    <input type="text" name="language_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <label id="folderLabel">{{ __('Language Code')}}</label>
                                    <input type="text" name="language_code" class="form-control">
                                    </div>           
                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                                    <button type="submit" id="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                    <!-- Modal -->
                 <div class="modal fade" id="editlanguage" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="folderLabel">Add Language</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <form action="{{route('admin.language.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">                                            
                                    <div class="form-group">
                                    <label id="folderLabel">{{ __('Language Name')}}</label>
                                    <input type="text" name="language_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <label id="folderLabel">{{ __('Language Code')}}</label>
                                    <input type="text" name="language_code" class="form-control">
                                    </div>           
                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                                    <button type="submit" id="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <div class="card-body">
            <div class="card-content collapse show">
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="data-table table">
                            <thead>
                                <tr>
                                    <th>{{__('#') }}</th>
                                    <th>{{ __('Language Name') }}</th>
                                    <th>{{ __('Language Code') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
  
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function() {
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.language.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'language_name',
                    name: 'language_name'
                },                
                {
                    data: 'language_code',
                    name: 'language_code'
                },                  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

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