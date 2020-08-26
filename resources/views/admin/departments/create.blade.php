@extends('layouts.app')

@section('content')
@push('scripts')
<script>
  $(document).ready(function(){
$('#jstree').jstree({
  "core" : {
    'data' : {!! load_department(old('parent'))  !!},
    "themes" : {
      "variant" : "large"
    }
  },
  "checkbox" : {
    "keep_selected_style" : false
  },
  "plugins" : [ "wholerow"]
});
  })

$('#jstree').on('changed.jstree', function(e,data){
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.parent_id').val(r.join(' , '))
})
</script>
@endpush
@include('layouts.breadcrumbs')
<div class="container">
    @include('layouts.message')
    @if ($errors->all())
        @foreach($errors->all() as $err)
<div class="alert alert-danger">{{$err}}</div>
        @endforeach
    @endif
<div class="row vh-100 justify-content-between align-items-center" style="">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.add_department') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('departments.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="username1">{{trans('admin.dep_name_ar')}}</label>                                                  
                                <input type="text" class="form-control" id="username1" name="dep_name_ar" placeholder="{{trans('admin.dep_name_ar')}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.dep_name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="dep_name_en" placeholder="{{trans('admin.dep_name_en')}}">                                                    
                                </div>
                                <div class="my-3">
                                    <div id="jstree"></div>
                                <input type="hidden" name="parent" class="parent_id" value="{{old('parent')}}">
                                </div>
                            <div class="form-group">
                            <label for="desc">{{trans('admin.description')}}</label>                                    <textarea name="description" id="desc" class="form-control" placeholder="{{trans('admin.description')}}"></textarea>               
                               
                            </div>
                           
                            <div class="form-group">
                                <label for="key">{{trans('admin.code')}}</label>                                                   
                                <textarea name="keywords" id="key" class="form-control" placeholder="{{trans('admin.keywords')}}"></textarea> 
                                </div>
                                <div class="col-12 col-sm-6 my-2">
                                    <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.icon')}}...<input id="fileUpload22" type="file" name="icon">
                                    </label>
                                </div> 
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.add_department') }}</button></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>
</div>
@endsection