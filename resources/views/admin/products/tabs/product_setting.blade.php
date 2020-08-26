@push('scripts')
   <script>
       $(document).ready(function(){
           $('#state').on('change' , function(e){
if(e.target.value == 'refused'){
    $('#display_reason').removeClass('d-none')
}else{
    $('#display_reason').addClass('d-none')
}
           })

   
       })
   </script>
   <script>
        // datepicker
    $('.datepickerInput').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:false,
	todayBtn:true,
	clearBtn:true
    })
   </script>
@endpush

<div class="tab-pane fade" id="product_setting">
   <h3>{{ trans('admin.product_setting') }}</h3>                                               <div class="row">
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="price">{{trans('admin.price')}}</label>                                                  
<input type="text" class="form-control" id="price" name="price" placeholder="{{trans('admin.price')}}" value="{{$product->price}}">                                             <span class="is-invalid text-danger" id="price_feedback"></span>        
    </div>
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="stock">{{trans('admin.stock')}}</label>                                                  
<input type="text" class="form-control" id="stock" name="stock" placeholder="{{trans('admin.stock')}}" value="{{$product->stock}}">                                             <span class="is-invalid text-danger" id="stock_feedback"></span>       
    </div>
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="currency">{{trans('admin.currency')}}</label>  
    <?php $currencies = \App\Models\Country::all(['currency' , 'id']); ?>                                                
<select name="currency_id" id="currency_id" class="form-control">
   <option>.....</option> 
   @foreach ($currencies as $item)
<option value="{{$item->id}}" {{$product->currency_id == $item->id ? 'selected' : ''}}>{{$item->currency}}</option>  
   @endforeach
</select>                                        <span class="is-invalid text-danger" id="currency_feedback"></span>         
    </div>
</div>
    <div class="row">
   <div class="form-group col-md-6 col-sm-6 col-12">
    <label for="start_at">{{trans('admin.start_at')}}</label>                                                  
<input type="text" class="form-control datepickerInput" id="start_at" name="start_at" placeholder="{{trans('admin.start_at')}}" value="{{$product->start_at}}" >                                              <span class="is-invalid text-danger" id="start_at_feedback"></span>      
    </div>
   <div class="form-group col-md-6 col-sm-6 col-12 ">
    <label for="end_at">{{trans('admin.end_at')}}</label>                                                  
<input type="text" class="form-control datepickerInput" id="end_at" name="end_at" placeholder="{{trans('admin.end_at')}}" value="{{$product->end_at}}">                                             <span class="is-invalid text-danger" id="end_at_feedback"></span>       
    </div>
</div>
<div class="clearfix"></div>
    <div class="row">
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="offer_price">{{trans('admin.offer_price')}}</label>                                                  
<input type="text" class="form-control" id="offer_price" name="offer_price" placeholder="{{trans('admin.offer_price')}}" value="{{$product->offer_price}}">                                             <span class="is-invalid text-danger" id="price_offer_feedback"></span>       
    </div>
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="offer_start_at">{{trans('admin.offer_start_at')}}</label>                                                  
<input type="text" class="form-control datepickerInput" id="offer_start_at" name="offer_start_at" placeholder="{{trans('admin.offer_start_at')}}" value="{{$product->offer_start_at}}">                                             <span class="is-invalid text-danger" id="offer_start_at_feedback"></span>       
    </div>
   <div class="form-group col-md-4 col-sm-6 col-12">
    <label for="offer_end_at">{{trans('admin.offer_end_at')}}</label>                                                  
<input type="text" class="form-control  datepickerInput" id="offer_end_at" name="offer_end_at" placeholder="{{trans('admin.offer_end_at')}}" value="{{$product->offer_end_at}}">                                            <span class="is-invalid text-danger" id="offer_end_at_feedback"></span>        
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group">
    <label for="state">{{trans('admin.state')}}</label>                                                  
<select  class="form-control" id="state" name="state" value="{{$product->state}}">                                                    <option>.....</option>
    
    <option value="active" {{$product->state == 'active' ? 'selected' : ''}}>{{ trans('admin.active') }}</option>
    <option value="pending" {{$product->state == 'pending' ? 'selected' : ''}}>{{ trans('admin.pending') }}</option>
    <option value="refused" {{$product->state == 'refused' ? 'selected' : ''}}>{{ trans('admin.refused') }}</option>
</select>   
<span class="is-invalid text-danger" id="state_feedback"></span>
</div>

<div class="form-group  d-none" id="display_reason">
    <label for="reason">{{trans('admin.reason')}}</label>                                                  
<textarea type="text" class="form-control" id="reason" name="reason" placeholder="{{trans('admin.reason')}}" value="{{$product->reason}}">  </textarea>                                      <span class="is-invalid text-danger" id="reason_feedback"></span>          
    </div>

</div>