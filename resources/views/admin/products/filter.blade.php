@push('scripts')
    <script>
        $(document).ready(function(){
           
        });
            
    </script>
@endpush
<div class="col-12 col-md-12 my-2" style="border-bottom: 2px solid primary">
    <div id="accordion" >
        <div class="">
            <div class="text-center" id="headingOne">
                <h3 class="mb-0">
                    <a class="text-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Filter Products <i class="fas fa-filter"></i>
                    </a>
                </h3>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                <div class="p-3">
                   <form id="filter">
                    @csrf
                       <div class="row">
                           <div class="form-group col-lg-3 col-md-4 col sm-6">
                               <label for="category">category</label>
                               <?php $cats = \App\Models\Category::all(); ?>                              
<select name="category_id" id="category_id" class="form-control">
    <option>choose category</option>
    @foreach ($cats as $cat)
    <option value="{{$cat->id}}">{{session('lang') == 'ar' ?$cat->name_ar : $cat->name_en}}</option>  
        @endforeach
</select>
                           </div>
                           <div class="form-group col-lg-3 col-md-4 col sm-6">
                            <label for="manufact">manufact</label>
                            <?php $manufacts = \App\Models\Manufacturer::all(); ?>
                            <select name="manufact_id" id="manufact" class="form-control">
                                <option>choose manufacturer</option>
                                @foreach ($manufacts as $manufact)
                            <option value="{{$manufact->id}}">{{session('lang') == 'ar' ?$manufact->name_ar : $manufact->name_en}}</option>  
                                @endforeach
                            </select>
                           </div>
                           <div class="form-group col-lg-3 col-md-4 col sm-6">
                            <label for="trade">trade</label>
                            <?php $trades = \App\Models\TradeMark::all(); ?>
                            <select name="trade" id="trade_id" class="form-control">
                                <option>choose Brand</option>
                                @foreach ($trades as $trade)
                            <option value="{{$trade->id}}">{{session('lang') == 'ar' ?$trade->name_ar : $trade->name_en}}</option>  
                                @endforeach
                            </select>
                           </div>
                           <div class="form-group col-lg-2 col-md-3 col sm-6">
                            <label for="color">color</label>
                            <?php $colors = \App\Models\Color::all(); ?>
                            <select name="color" id="color_id" class="form-control">
                                <option>choose Color</option>
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{session('lang') == 'ar' ?$color->name_ar : $color->name_en}}</option>  
                                    @endforeach
                            </select>
                           </div>
                           <div class="col-lg-1 col-md-1 col-sm-6 align-self-center">
                          <a href="#" class="btn btn-primary">
                              <i class="fa fa-search"></i>
                          </a>
                           </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

</div>