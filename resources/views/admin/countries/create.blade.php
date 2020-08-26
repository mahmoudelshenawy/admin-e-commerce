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
        <h4 class="card-title">{{ trans('admin.create_country') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('countries.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <label for="username1">{{trans('admin.country_name_ar')}}</label>                                                  
                                <input type="text" class="form-control" id="username1" name="country_name_ar" placeholder="{{trans('admin.country_name_ar')}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.country_name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="country_name_en" placeholder="{{trans('admin.country_name_en')}}">                                                    
                                </div>
                            <div class="form-group">
                            <label for="email1">{{trans('admin.mob')}}</label>                                                   
                                <input type="text" class="form-control" id="email1" 
                                name="mob" placeholder="{{trans('admin.mob')}}">
                            </div>
                           
                            <div class="form-group">
                                <label for="currency">{{trans('admin.currency')}}</label>                                                   
                                    <input type="text" class="form-control" id="currency" 
                                    name="currency" placeholder="{{trans('admin.currency')}}">
                                </div>
                           
                            <div class="form-group">
                                <label for="code">{{trans('admin.code')}}</label>                                                   
                                    <input type="text" class="form-control" id="code" 
                                    name="code" placeholder="{{trans('admin.code')}}">
                                </div>
                                <div class="col-12 col-sm-6 my-2">
                                    <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.logo')}}...<input id="fileUpload22" type="file" name="logo">
                                    </label>
                                </div> 
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.create_country') }}</button></button>
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