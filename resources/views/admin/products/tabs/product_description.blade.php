 @push('scripts')
<script>
$(document).ready(function(){
    $('#mall_id').select2();
const unit_selected = $('#unit_id').val();
if(unit_selected !== null || unit_selected !== ''){
    $.ajax({
    dataType:'json',
type:'post',
url:"{{aurl('products/get_size_of_unit/' . $product->id)}}",
data:{_token:'{{csrf_token()}}' ,id:unit_selected , proId : '{{$product->id}}' }
  }).done(function(data){
      var selected = ''
     var result = '<option>....</option>';
     var selected = false;
     if(data.selectedSize !== null){
         selected = true
     }
      data.sizes.forEach(element => {
        
      result += `<option value='${element.id}' selected=${selected}>${element.name}</option>`
  });
      $('#size_id').html(result)

  });  
}

    $(document).on('change','#unit_id' , function(e){
        
if(e.target.value != null){
  $.ajax({
    dataType:'json',
type:'post',
url:"{{aurl('products/get_size_of_unit/' . $product->id)}}",
data:{_token:'{{csrf_token()}}' ,id: e.target.value}
  }).done(function(data){
      console.log(data)
     var result = '<option>....</option>';
      data.sizes.forEach(element => {
      result += `<option value='${element.id}'>${element.name}</option>`
  });
      $('#size_id').html(result)

  });
}
    });
});


</script>
   
@endpush
<div class="tab-pane fade" id="product_description">
    <div class="form-group">
        <label for="unit_id">{{trans('admin.units')}}</label>                                <?php $units = \App\Models\Unit::all(); ?> 

    <select name="unit_id" id="unit_id" class="form-control">
        <option>....</option>
        @foreach ($units as $unit)
    <option value="{{$unit->id}}" {{$product->unit_id == $unit->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $unit->name_ar : $unit->name_en}}</option> 
        @endforeach
    </select>                                   <span class="is-invalid text-danger" id="unit_id_feedback"></span>   
        </div>    
       
        <div class="row">
            <div class="form-group col-md-4 col-sm-6 col-12">
             <label for="weight">{{trans('admin.weight')}}</label>                                                  
         <input type="text" class="form-control" id="weight" name="weight" placeholder="{{trans('admin.weight')}}" value="{{$product->weight}}" >                                    <span class="is-invalid text-danger" id="weight_feedback"></span>                
             </div>
            <div class="form-group col-md-4 col-sm-6 col-12 ">
             <label for="size_id">{{trans('admin.size')}}</label>

             <select name="size_id" id="size_id" class="form-control">
            <option>.....</option>  
            
            </select>                           <span class="is-invalid text-danger" id="size_id_feedback"></span>                                          
             </div>
            <div class="form-group col-md-4 col-sm-6 col-12 ">
             <label for="color">{{trans('admin.color')}}</label>

             <select name="color_id" id="color_id" class="form-control">
            <option>...</option>  
            <?php $colors = \App\Models\Color::all(['name_ar' , 'name_en' , 'id']); ?>
            @foreach ($colors as $color)
             <option value="{{$color->id}}" {{$product->color_id == $color->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $color->name_ar : $color->name_en}}</option>
            @endforeach
            </select>                           <span class="is-invalid text-danger" id="color_id_feedback"></span>                                          
             </div>
         </div>
         <br>
        <div class="row">
            
            <div class="form-group col-md-6 col-sm-6 col-12 ">
             <label for="parent_category">{{trans('admin.category')}}</label>
             <select name="category_id[]" id="parent_category" class="form-control">
            <option>.....</option> 
            <?php $products_cats = $product->categories()->get(); ?>
           
            @foreach ( $parentCategories as $pcat)
           
            @forelse ($products_cats as $cat)   
            <option value="{{$pcat->id}}" {{$cat->pivot->category_id == $pcat->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $pcat->name_ar : $pcat->name_en}}</option>
            @empty
            <option value="{{$pcat->id}}">{{session('lang') == 'ar' ? $pcat->name_ar : $pcat->name_en}}</option>
            @endforelse                   
            @endforeach
            </select>                                                             <span class="is-invalid text-danger" id="category_id_feedback"></span>        
             </div>
            <div class="form-group col-md-6 col-sm-6 col-12 ">
             <label for="subcat">{{trans('admin.subcategory')}}</label>

             <select name="category_id[]" id="subcat" class="form-control">
            <option>...</option>  
            
            @foreach ($subCategories as $scat)
            @forelse ($products_cats as $cat)
             <option value="{{$scat->id}}" {{$cat->pivot->category_id == $scat->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $scat->name_ar : $scat->name_en}}</option>
             @empty 
             <option value="{{$scat->id}}">{{session('lang') == 'ar' ? $scat->name_ar : $scat->name_en}}</option>
             @endforelse
            @endforeach
            </select>                                                                     
             </div>
         </div>
         <br>
         <div class="row">
            {{-- <div class="form-group col-md-4 col-sm-6 col-12">
             <label for="manufact">{{trans('admin.manufact')}}</label>                                                  
         <input type="text" class="form-control" id="manufact" name="manufact_id" placeholder="{{trans('admin.manufact')}}" value="{{$product->manufact_id}}" >                                                    
             </div> --}}
            <div class="form-group col-md-6 col-sm-6 col-12 ">
             <label for="manufact">{{trans('admin.manufacturers')}}</label>
             <?php $manufacts = \App\Models\Manufacturer::all(['name_ar' , 'name_en' , 'id']); ?>
             <select name="manufact_id" id="manufact_id" class="form-control">
            <option>.....</option> 
            @foreach ($manufacts as $manufact)
            <option value="{{$manufact->id}}" {{$product->manufact_id == $manufact->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $manufact->name_ar : $manufact->name_en}}</option>
           @endforeach
            
            </select>                           <span class="is-invalid text-danger" id="manufact_id_feedback"></span>                                          
             </div>
            <div class="form-group col-md-6 col-sm-6 col-12 ">
             <label for="trade">{{trans('admin.trademarks')}}</label>

             <select name="trade_id" id="trade_id" class="form-control">
            <option>...</option>  
            <?php $trades = \App\Models\TradeMark::all(['name_ar' , 'name_en' , 'id']); ?>
            @foreach ($trades as $trade)
             <option value="{{$trade->id}}" {{$product->trade_id == $trade->id ? 'selected' : ''}}>{{session('lang') == 'ar' ? $trade->name_ar : $trade->name_en}}</option>
            @endforeach
            </select>                           <span class="is-invalid text-danger" id="trade_id_feedback"></span>                                          
             </div>
                       
         </div>
         <br>  
         <div class="row">
            <div class="form-group col-md-12 col-sm-6 col-12 ">
               <label for="mall_id">{{trans('admin.malls')}}</label>

               <select name="mall_id[]" id="mall_id" class="form-control mall_id" style="width: 100%" multiple>
              <option>...</option>  
              
              <?php $countries = \App\Models\Country::all(); ?>
              @foreach ($countries as $country)
               <optgroup label="{{session('lang') == 'ar' ? $country->country_name_ar : $country->country_name_en}}">
                @foreach ($country->malls()->get() as $mall)
                @if (count($product->malls()->get()) > 0)
                @foreach ($product->malls()->get() as $mo)
                
                @if ($mo->id == $mall->id)
                <option value="{{$mall->id}}" selected>{{$mall->name_ar}}</option> 
                @else
                  
                @endif
            @endforeach
                @else
                <option value="{{$mall->id}}">{{$mall->name_ar}}</option> 
                @endif
               
               
                @endforeach
            </optgroup>
              @endforeach
              </select>  

            </div>
        </div>
</div>