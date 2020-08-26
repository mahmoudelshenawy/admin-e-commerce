@extends('layouts.app')

@section('content')
@include('layouts.breadcrumbs')
<div class="container">
<div class="row vh-100 justify-content-between align-items-center" style="margin-top: -100px">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.edit_admin') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('admins.update' , $admin->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                            <label for="username1">{{trans('admin.admin_name')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name" placeholder="{{trans('admin.admin_name')}}" value="{{$admin->name}}">                                                    
                            </div>
                            <div class="form-group">
                            <label for="email1">{{trans('admin.email')}}</label>                                                   
                                <input type="email" class="form-control" id="email1" 
                                name="email" placeholder="{{trans('admin.email')}}" value="{{$admin->email}}">
                            </div>
                            <div class="form-group">
                            <label for="inputPassword31">{{trans('admin.password')}}</label>                                                    
                                <input type="password" class="form-control" id="inputPassword31"
                                name="password" 
                                placeholder="{{trans('admin.password')}}">                
                            </div> 
                            
                            <div class="form-group">
                            <label for="inputPassword31">{{trans('admin.password_confirmation')}}</label>                                                    
                                <input type="password" class="form-control" id="inputPassword31"
                                name="password_confirmation" 
                                placeholder="{{trans('admin.password_confirmation')}}">                
                            </div> 
                            {{-- <div class="form-group"> 
                                <label class="chkbox"> Example checkbox
                                    <input name="gridCheck1" value="gridCheck1" class="form-check-input" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>                                                  
                            </div> --}}
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.edit_admin') }}</button></button>
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