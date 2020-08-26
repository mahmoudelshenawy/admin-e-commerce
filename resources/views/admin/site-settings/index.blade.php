@extends('layouts.app')

@section('content')
@include('layouts.breadcrumbs')
<div class="container">
<div class="row justify-content-between align-items-center" style="margin-top: 20px">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.settings') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ aurl('settings') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                            <label for="sitename_ar">{{trans('admin.sitename_ar')}}</label>         
                            <input type="text" class="form-control" id="sitename_ar" name="sitename_ar" placeholder="{{trans('admin.sitename_ar')}}" value="{{setting()->sitename_ar}}">                                                    
                            </div>

                            <div class="form-group">
                                <label for="sitename_ar">{{trans('admin.sitename_en')}}</label>         
                                <input type="text" class="form-control" id="sitename_en" name="sitename_en" placeholder="{{trans('admin.sitename_ar')}}" value="{{setting()->sitename_en}}">                                                    
                                </div>
                            <div class="form-group">
                            <label for="email1">{{trans('admin.email')}}</label>                    
                                <input type="email" class="form-control" id="email1" 
                            name="email" placeholder="{{trans('admin.email')}}" value="{{setting()->email}}">
                            </div>

                            <div class="col-12 col-sm-6">
                            <label for="fileUpload21" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.logo')}} ...<input id="fileUpload21" type="file" name="logo">
                                </label>

                                @if (!empty(setting()->logo))
                            <img src="{{Storage::url(setting()->logo)}}" style="width: 70px ; height:70px" class="img-thumbnail mb-3"/>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.icon')}}...<input id="fileUpload22" type="file" name="icon">
                                </label>
                                @if (!empty(setting()->icon))
                                <img src="{{Storage::url(setting()->icon)}}" style="width: 70px ; height:70px" class="img-thumbnail mb-3"/>
                                    @endif
                            </div>
                            <div class="form-group">
                            <label for="description">{{trans('admin.description')}}</label>                                                    
                                <textarea type="text" class="form-control" id="description"
                                name="description" 
                                placeholder="{{trans('admin.description')}}"> </textarea>               
                            </div> 

                            <div class="form-group">
                                <label for="keywords">{{trans('admin.keywords')}}</label>                                                    
                                    <textarea type="text" class="form-control" id="keywords"
                                    name="keywords" 
                                    placeholder="{{trans('admin.keywords')}}"> </textarea>               
                                </div> 

                                    <div class="form-group">
                                        <label for="main_lang">{{trans('admin.main_lang')}}</label>            
                                        <select id="main_lang" class="form-control" name="main_lang">
                                            <option value="" >....</option>
                                        <option value="ar" {{setting()->main_lang == 'ar' ? 'selected' : ''}}>{{__('admin.ar')}}</option>
                                        <option value="en"
                                        {{setting()->main_lang == 'en' ? 'selected' : ''}}
                                        >{{__('admin.en')}}</option>
                                        </select>               
                                        </div>

                                        <div class="form-group">
                                            <label for="status">{{trans('admin.status')}}</label>            
                                            <select id="status" class="form-control" name="status">
                                                <option value="">....</option>
                                            <option value="open" {{setting()->status == 'open' ? 'selected' : ''}}>{{__('admin.open')}}</option>
                                            <option value="close"
                                            {{setting()->status == 'close' ? 'selected' : ''}}
                                            >{{__('admin.close')}}</option>
                                            </select>               
                                            </div>

                                            <div class="form-group">
                                                <label for="maintenance_message">{{trans('admin.message_maintenance')}}</label>                                                    
                                                    <textarea type="text" class="form-control" id="maintenance_message"
                                                    name="message_maintenance" 
                                                    placeholder="{{trans('admin.message_maintenance')}}"> </textarea>               
                                                </div>
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.save') }}</button></button>
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