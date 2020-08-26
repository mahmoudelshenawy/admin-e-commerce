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
<div class="row justify-content-between align-items-center mt-4" >
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.create_size') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('sizes.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="username1">{{trans('admin.units')}}</label>
                                <?php $units = \App\Models\Unit::all(); ?> 
                        
                            <select name="unit_id" id="" class="form-control">
                                <option>....</option>
                                @foreach ($units as $unit)
                            <option value="{{$unit->id}}">{{session('lang') == 'ar' ? $unit->name_ar : $unit->name_en}}</option> 
                                @endforeach
                            </select>                                      
                                </div>   
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name')}}</label>                                                  
                                <input type="text" class="form-control" id="username1" name="name" placeholder="{{trans('admin.name')}}">                                                    
                            </div>
                          
                              
                                <div class="form-group">
                                    <label for="usern">{{trans('admin.short_name')}}</label>                                                  
                                        <input type="text" class="form-control" id="usern" name="short_name" placeholder="{{trans('admin.short_name')}}">                                                    
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