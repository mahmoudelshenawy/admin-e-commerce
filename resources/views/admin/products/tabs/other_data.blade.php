@push('scripts')
<script>
    $(document).ready(function(){
        var x = 1;
 

  $(document).on('click' ,'#trash_btn' ,function(){
    x--;
$(this).parent('div').parent('div').remove();

return false;

  });    
  var pre_existed_data =  {{$product->otherData()->count()}}

$(document).on('click' , '#addon_btn' , function(){


    var max_num = 5 
    var allowed_fields;
    if(pre_existed_data == 0){
      allowed_fields == max_num
    }else{
      allowed_fields = max_num - pre_existed_data
    }
     
 if(x < max_num){  
    x++; 
   $('.other_data_container').append(`
   <div class="row">
   <div class="col-md-5 mb-4">
           
           <input type="text" class="form-control"  name="input_key[]" placeholder="{{trans('admin.input_key')}}" value="" >                                 
      </div>
      <div class="col-md-5 mb-4">
       <input type="text" class="form-control" id="input_value" name="input_value[]" placeholder="{{trans('admin.input_value')}}" value="">       
      </div>
      <div class="col-md-2 mb-4">
   <a class="btn btn-danger" id="trash_btn" href="#"><i class="fa fa-trash fa-lg"></i></a>       
   </div> 
</div>
   `)
  
 }
   return false;
})
    })
</script>
@endpush

<div class="tab-pane fade" id="other_data">
      <h3>{{ trans('admin.other_data') }}</h3>
      <br>
      <div class="">
      <a href="#" id="addon_btn" class="btn btn-primary"> <i class="fa fa-plus"></i></a>
      </div>
      <br>

      <div class="other_data_container">
      @foreach ($product->otherData()->get() as $other)
<div class="row">
       <div class="col-md-5 mb-4">
           
       <input type="text" class="form-control"  name="input_key[]" placeholder="{{trans('admin.input_key')}}" value="{{$other->key_data}}" >                                 
       </div>
       <br/>
       <div class="col-md-5 mb-4">
        <input type="text" class="form-control" id="input_value" name="input_value[]" placeholder="{{trans('admin.input_value')}}" value="{{$other->value_data}}">       
       </div>
       <br/>
       <div class="col-md-2 mb-4">
    <a class="btn btn-danger" id="trash_btn" href="#"><i class="fa fa-trash fa-lg"></i></a>       
    </div> 
    <br/>
    </div>    
@endforeach
</div>
</div>