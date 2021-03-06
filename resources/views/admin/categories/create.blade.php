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
<div class="row vh-100 justify-content-between align-items-center" style="margin-top:-40px">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.create_category') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{old('name_ar')}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{old('name_ar')}}">                                                    
                                </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.short_code')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="short_code" placeholder="{{trans('admin.short_code')}}" value="{{old('short_code')}}">                                                    
                                </div>
                                <div class="form-group">
                            <label for="select">{{__('admin.parent_cat')}}</label>
                           <select name="parent_id" id="select" class="form-control">
                               <option value="">........</option>
                               @foreach ($parents as $parent)
                           <option value="{{$parent->id}}">{{session('lang') == 'ar' ? $parent->name_ar : $parent->name_en}}</option>
                               @endforeach
                           </select>
                        </div>
                              
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.add') }}</button></button>
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