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
<div class="row vh-100 justify-content-between align-items-center" style="margin-top:-70px">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.edit_color') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('colors.update' , $color->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{$color->name_ar}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{$color->name_en}}">                                                    
                                </div>
                                <div class="form-group">
                                    <label for="color">{{trans('admin.color')}}</label>                  
                                        <input type="color" class="form-control" id="color" 
                                name="color" placeholder="{{trans('admin.color')}}" value="{{$color->color}}">
                                    </div>
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.edit') }}</button></button>
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