@extends('layouts.app')

@section('content')
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
        <h4 class="card-title">{{ trans('admin.edit_trade') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('trademarks.update',[$trademark->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{$trademark->name_ar}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{$trademark->name_en}}">                                                    
                                </div>
                            
                                <div class="col-12 col-sm-6 my-2">
                                    <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.logo')}}...<input id="fileUpload22" type="file" name="logo">
                                    </label>
                                    @if (!empty($trademark->logo))
                                    <img src="{{Storage::url($trademark->logo)}}" style="width: 70px ; height:70px" class="img-thumbnail mb-3"/>
                                        @endif
                                </div> 
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.edit_trade') }}</button></button>
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