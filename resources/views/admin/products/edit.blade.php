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
        <h4 class="card-title">{{ trans('admin.edit_unit') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('units.update' , $unit->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{$unit->name_ar}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{$unit->name_en}}">                                                    
                                </div>
                              
                                <div class="form-group">
                                    <label for="usern">{{trans('admin.short_name')}}</label>                                                  
                                        <input type="text" class="form-control" id="usern" name="short_name" placeholder="{{trans('admin.short_name')}}" value="{{$unit->short_name}}">                                                    
                                    </div>
                                <div class="form-group">
                                    <label for="select">{{trans('admin.short_name')}}</label>     
                                                                                
                                        <select class="form-control" id="select" name="allow_decimal" >     
                                        <option>Select</option>
                                        <option {{$unit->allow_decimal == 0 ? 'selected' : ''}} value="0">NO</option>
                                        <option {{$unit->allow_decimal == 1 ? 'selected' : ''}} value="1">yes</option>
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