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
        <h4 class="card-title">{{ trans('admin.create_city') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('cities.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                            <label for="username1">{{trans('admin.city_name_ar')}}</label>                                                  
                                <input type="text" class="form-control" id="username1" name="city_name_ar" placeholder="{{trans('admin.city_name_ar')}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.city_name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="city_name_en" placeholder="{{trans('admin.city_name_en')}}">                                                    
                                </div>
                                <div class="form-group">
                            <label for="select">{{__('admin.country')}}</label>
                           <select name="country_id" id="select" class="form-control">
                               <option>........</option>
                               @foreach ($countries as $country)
                           <option value="{{$country->id}}">{{$country->country_name_ar}}</option>
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