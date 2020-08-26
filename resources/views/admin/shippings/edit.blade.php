@extends('layouts.app')
{{-- &key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8 --}}
@section('content')
<?php
$lat = !empty($shipping->lat)?$shipping->lat:'30.034024628931657';
$lng = !empty($shipping->lng)?$shipping->lng:'31.24238681793213';

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
        <h4 class="card-title">{{ trans('admin.edit_shipping') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('shippings.update' , $shipping->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
                            <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
                            <div class="form-group">
                            <label for="username1">{{trans('admin.name_ar')}}</label>                                                  
                            <input type="text" class="form-control" id="username1" name="name_ar" placeholder="{{trans('admin.name_ar')}}" value="{{$shipping->name_ar}}">                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="name_en" placeholder="{{trans('admin.name_en')}}" value="{{$shipping->name_en}}">                                                    
                                </div>
                           
                                <div class="form-group">
                                    <label for="company">{{trans('admin.company')}}</label>                  <select name="user_id" id="company" class="form-control">
                                        <option>.......</option>
                                        @foreach ($companies as $company)
                                    <option value="{{$company->id}}" {{$shipping->user_id == $company->id ? 'selected' : ''}}>
                                    {{$company->name}}
                                    </option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">{{trans('admin.company')}}</label>                  
                                            <input type="text" class="form-control" id="address" 
                                    name="address" placeholder="{{trans('admin.address')}}" value="{{$shipping->address}}">
                                        </div>
                                       
                                        
                                        <div class="form-group">
                                            <div id="us1" style="width: 100%; height: 400px;"></div>
                                            </div>
                                <div class="col-12 col-sm-6 my-2">
                                    <label for="fileUpload22" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>{{__('admin.icon')}}...<input id="fileUpload22" type="file" name="icon">
                                    </label>
                                    @if (!empty($shipping->icon))
                                    <img src="{{Storage::url($shipping->icon)}}" style="width: 70px ; height:70px" class="img-thumbnail mb-3"/>
                                        @endif
                                </div> 
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.edit_shipping') }}</button></button>
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