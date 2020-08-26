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
        <h4 class="card-title">{{ trans('admin.create_state') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('states.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                            <label for="username1">{{trans('admin.state_name_ar')}}</label>                                                  
                                <input type="text" class="form-control" id="username1" name="state_name_ar" placeholder="{{trans('admin.state_name_ar')}}" value={{old('state_name_ar')}}>                                                    
                            </div>
                            <div class="form-group">
                                <label for="username2">{{trans('admin.state_name_en')}}</label>                                                  
                                    <input type="text" class="form-control" id="username2" name="state_name_en" placeholder="{{trans('admin.state_name_en')}}" value={{old('state_name_en')}}>                                                    
                                </div>
                                <div class="form-group">
                                    <label for="select">{{__('admin.country')}}</label>
                                   <select name="country_id" id="select" class="form-control country_id" value={{old('country_id')}}>
                                      
                                       <option>........</option>
                                       @foreach ($countries as $country)
                                   <option value="{{$country->id}}" @if (old("country_id") == $country->id)
                                    {{ 'selected' }}
                                   @endif>
                                    {{session('lang') == 'ar' ? $country->country_name_ar : $country->country_name_en }}</option>
                                       @endforeach
                                   </select>
                                </div>
                           
                                <div class="form-group">
                                    <label for="city">{{__('admin.city')}}</label>
                                 <select name="city_id" id="city" class="form-control city">
                                     <option>......</option>
                                 </select>
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
@push('scripts')
    <script>
        $(document).ready(function(){

            @if(old('country_id'))
  $.ajax({
      url:'{{ aurl('states/create') }}',
      type:'get',
      dataType:'json',
      data:{country_id:'{{ old('country_id') }}'},
      success: function(data)
      {
        var result = '  <option>......</option>'
            if(data.length > 0){
                data.forEach(function(item){
result += `
<option value="${item.id}">${item.city_name_ar}</option>
`
            })
            }
        $('.city').html(result);
      }
    });
  @endif

            $(document).on('change','.country_id',function(){
                var country_id = $('.country_id option:selected').val();

if(country_id > 0){
    $.ajax({
        url : '{{aurl('states/create')}}',
        type: 'get',
        dataType:'json',
        data:{country_id : country_id},
        success:function(data){
            console.log(data)
            var result = '  <option>......</option>'
            if(data.length > 0){
                data.forEach(function(item){
result += `
<option value="${item.id}">${item.city_name_ar}</option>
`
            })
            }
           console.log(result)
            $('.city').html(result)

        }
    })
}else{
            $('.city').html('')
        }

            })
        })
    </script>
@endpush
@endsection