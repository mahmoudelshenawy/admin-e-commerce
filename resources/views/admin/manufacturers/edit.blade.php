@extends('layouts.app')
{{-- &key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8 --}}
@section('content')
<?php
$lat = !empty($manufact->lat)?$manufact->lat:'30.034024628931657';
$lng = !empty($manufact->lng)?$manufact->lng:'31.24238681793213';

?>
@include('layouts.breadcrumbs')
<div class="container">
    @include('layouts.message')
    @if ($errors->all())
        @foreach($errors->all() as $err)
<div class="alert alert-danger">{{$err}}</div>
        @endforeach
    @endif
<div class="row justify-content-between align-items-center mt-4" style="">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.edit_manufact') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('manufacturers.update' , $manufact->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
                            <input type="hidden" value="{{ $lng }}" id="lng" name="lng">

                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{$manufact->name_ar}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{$manufact->name_en}}">                                                    
                                </div>
                            <div class="form-group">
                            <label for="email1">{{trans('admin.mobile')}}</label>                                                   
                                <input type="text" class="form-control" id="email1" 
                                name="mobile" placeholder="{{trans('admin.mobile')}}" value="{{$manufact->mobile}}">
                            </div>
                           
                            <div class="form-group">
                                <label for="code">{{trans('admin.email')}}</label>                                                   
                                    <input type="text" class="form-control" id="email" 
                                    name="email" placeholder="{{trans('admin.email')}}" value="{{$manufact->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="website">{{trans('admin.website')}}</label>                  
                                        <input type="text" class="form-control" id="website" 
                                        name="website" placeholder="{{trans('admin.website')}}" value="{{$manufact->website}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{trans('admin.address')}}</label>                  
                                            <input type="text" class="form-control" id="address" 
                                    name="address" placeholder="{{trans('admin.address')}}" value="{{$manufact->address}}">
                                        </div>
                                       
                                        
                                        <div class="form-group">
                                            <div id="us1" style="width: 100%; height: 400px;"></div>
                                            </div>
                                    <div class="form-group">
                                        <label for="facebook">{{trans('admin.facebook')}}</label>                  
                                            <input type="text" class="form-control" id="facebook" 
                                            name="facebook" placeholder="{{trans('admin.facebook')}}" value="{{$manufact->facebook}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">{{trans('admin.twitter')}}</label>                  
                                                <input type="text" class="form-control" id="twitter" 
                                                name="twitter" placeholder="{{trans('admin.twitter')}}" value="{{$manufact->twitter}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_manager">{{trans('admin.contact_manager')}}</label>                  
                                                    <input type="text" class="form-control" id="contact_manager" 
                                                    name="contact_manager" placeholder="{{trans('admin.contact_manager')}}" value="{{$manufact->contact_manager}}">
                                                </div>
                                <div class="col-12 col-sm-6 my-2">
                                    <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.icon')}}...<input id="fileUpload22" type="file" name="icon">
                                    </label>
                                    @if (!empty($manufact->icon))
                                    <img src="{{Storage::url($manufact->icon)}}" style="width: 70px ; height:70px" class="img-thumbnail mb-3"/>
                                        @endif
                                </div> 
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.edit_manufact') }}</button></button>
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


@push('scripts')

{{-- AIzaSyDG5lRkln1qb736xNYqUwAm4HpQ1H26gZI --}}
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ1ueGJFPRRGV0J1cSHmzHNt-EUBPDB30'&callback=initMap"
type="text/javascript"></script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBPzenGKjDMCZOTXMZzODDXlEX0HssjSkE'></script>
<script type="text/javascript" src='{{ asset('dist/js/locationpicker.js') }}'></script>


 <script>
  $('#us1').locationpicker({
      location: {
          latitude: {{ $lat }},
          longitude:{{ $lng }}
      },
      radius: 300,
      markerIcon: '{{ asset('dist/images/map-marker.png') }}',
      inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
       // radiusInput: $('#us2-radius'),
        locationNameInput: $('#address')
      },
      onchanged: function (currentLocation, radius, isMarkerDropped) {
        var addressComponents = $(this).locationpicker('map').location.addressComponents;
    console.log($(this).locationpicker('map').location);  //latlon  

    }

  });
</script>
@endpush
@endsection