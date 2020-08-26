@push('scripts')
@if ($errors->all())
<script>toastr.error('invalid inputs please check your data.', 'Error!')</script> 
@endif

{{-- <?php $inputs = ['admin_id','user_id','product_id', 'quantity','status','purchase_price','discount','tax','coupon','total_price','payment_type','payment_status','payment_price','submit_time','delivery_time']; ?>
@if($errors->all())
@foreach($inputs as $input)

@error('{{$input}}')
<script>
$('#' + '{{$input}}').addClass('is-invalid');
$('#' +'{{$input}}' + '_feedback').html('{{$message}}')
console.log('{{$input}}')
console.log('true')
</script>
@enderror
@endforeach  
@endif --}}
    <script>
        $(document).ready(function(){
            // the variables
              //calculate the total price
var purchase_price =  parseInt($('#purchase_price').val());
var tax = parseInt($('#tax').val());
var discount =  parseInt($('#discount').val());
var payment_price =  parseInt($('#payment_price').val());
let final_price =  0;
            // end of variables
            $('.datepickerInput').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:false,
	todayBtn:true,
	clearBtn:true
    });
    // call the price of product
    $('#product_id').on('change' , function(e){
var product_id = e.target.value;
if(product_id !== null){
    $.ajax({
url:"{{aurl('products/')}}" +'/' +product_id,
dataType:'json',
type:'get',
success:function(data){
    $('#purchase_price').val(data)
    purchase_price = data;
    final_price = purchase_price + tax - discount;
    $('.total_price').html(final_price)
    $('#sent_total_price').val(final_price)
},
error(response){
    var errors = response.responseJSON.errors
    console.log(errors)
   
}
});
}
     });

  

$('#purchase_price').on('change' , function(e){
    purchase_price = parseInt(e.target.value)
    final_price = purchase_price + tax - discount;
    $('.total_price').html(final_price)
    $('#sent_total_price').val(final_price)
    
    });
$('#tax').on('change' , function(e){
    tax = parseInt(e.target.value)
    final_price = purchase_price + tax - discount;
    $('.total_price').html(final_price)
    $('#sent_total_price').val(final_price)
    
    })
$('#discount').on('change' , function(e){
    discount = parseInt(e.target.value)
    final_price = purchase_price + tax - discount;
    $('.total_price').html(final_price)
    $('#sent_total_price').val(final_price)
    })

    $('#payment_price').on('change' , function(e){
    payment_price = parseInt(e.target.value)
    if(payment_price === final_price){
        $('#payment_status').val('paid')
    }else{
        $('#payment_status').val('due')
    }
})
        })

    </script>
@endpush
@extends('layouts.app')
@section('content')
@include('layouts.breadcrumbs')
<div class="container">
    @include('layouts.message')
   
<div class="row justify-content-between align-items-center mt-4" style="">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.create_purchase') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        
                        <form action="{{ route('purchases.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                            <label for="admin_id">{{trans('admin.added_by')}}</label>         
                            <?php $admins = \App\Admin::all(['id' , 'name']); ?>                                         
                                <select name="admin_id" id="admin_id" class="form-control">
                                <option>select admin</option>   
                                @forelse ($admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                                @empty
                                    <option>NO data available</option>
                                @endforelse 
                                </select> 
                                @error('admin_id')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror                                                 
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="user_id">{{trans('admin.user_name')}}</label>                                                  
                                <?php $users = \App\User::all(['id' , 'name']); ?>                                         
                                <select name="user_id" id="user_id" class="form-control">
                                <option>select customer</option>   
                                @forelse ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @empty
                                    <option>NO data available</option>
                                @endforelse 
                                </select>   
                                @error('user_id')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror                                               
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="product_id">{{trans('admin.product_title')}}</label>                  
                                    <select name="product_id" id="product_id" class="form-control">
                                        <option>select the product</option>
                                        <?php $products = \App\Models\Product::where('title' , '!=' , '')->select('id' , 'title')->get(); ?>  
                                        @forelse ($products as $product)
                                <option value="{{$product->id}}">{{$product->title}}</option>
                                @empty
                                    <option>NO data available</option>
                                @endforelse
                                    </select>
                                    @error('product_id')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror 
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="quantity">{{trans('admin.quantity')}}</label>                  
                                            <input type="number" class="form-control" id="quantity" 
                                    name="quantity" placeholder="{{trans('admin.quantity')}}" value="1">
                                    @error('quantity')
    
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                        </div>
                                       
                                        
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="status">{{trans('admin.status')}}</label> 
                                            <?php $status = ['ordered' , 'pending' , 'received']; ?>
                                            <select name="status" id="status" class="form-control">
                                                <option>....</option>
                                            @foreach ($status as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                     @enderror 
                                            </div>
                                        </div>

                                    <div class="row">
                                    <div class="form-group col-md-3 col-sm-6">
                                        <label for="purchase_price">{{trans('admin.purchase_price')}}</label>                  
                                            <input type="number" class="form-control" id="purchase_price" 
                                    name="purchase_price" placeholder="{{trans('admin.purchase_price')}}" value="0">
                                    @error('purchase_price')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror 
                                        </div>

                                    <div class="form-group col-md-3 col-sm-6">
                                        <label for="discount">{{trans('admin.discount')}}</label>                  
                                            <input type="number" class="form-control" id="discount" 
                                    name="discount" placeholder="{{trans('admin.discount')}}" value="0">
                                    @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror 
                                        </div>
                                    <div class="form-group col-md-3 col-sm-6">
                                        <label for="tax">{{trans('admin.tax')}}</label>                  
                                            <input type="number" class="form-control" id="tax" 
                                    name="tax" placeholder="{{trans('admin.tax')}}" value="0">
                                    @error('tax')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror 
                                        </div>
                                       
                                        
                                        <div class="form-group col-md-3 col-sm-6">
                                            <label for="coupon">{{trans('admin.coupon')}}</label>                  
                                                <input type="text" class="form-control" id="coupon" 
                                        name="coupon" placeholder="{{trans('admin.coupon')}}" value="{{old('coupon')}}">
                                        @error('coupon')
                                        <span class="text-danger">{{ $message }}</span>
                                     @enderror 
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col md-6 col-6">
                                                <h3>Total Price:</h3>
                                            </div>
                                            <div class="col md-6 col-6">
                                                <h3 class="total_price">0.00</h3>
                                                <input type="hidden" name="total_price" value="" id="sent_total_price">
                                            </div>
                                        </div>
                                        <hr>
                                        <br>

                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6">
                                                <label for="payment_type">{{trans('admin.payment_type')}}</label>                  
                                                    <?php $payment_types = ['cash' , 'visa' , 'mastercard']; ?>
                                                    <select name="payment_type" id="payment_type" class="form-control">
                                                        <option>...</option>
                                                        @foreach ($payment_types as $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('payment_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                 @enderror 
                                                </div> 
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label for="payment_price">{{trans('admin.payment_price')}}</label>  
                                                    <input type="number" class="form-control" id="payment_price" 
                                                    name="payment_price" placeholder="{{trans('admin.payment_price')}}" value="{{old('payment_price')}}">  
                                                    @error('payment_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                 @enderror   
                                                </div> 
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label for="payment_status">{{trans('admin.payment_status')}}</label>                  
                                                        <?php $payment_status = ['paid' , 'due']; ?>
                                                        <select name="payment_status" id="payment_status" class="form-control">
                                                            <option>....</option>
                                                            @foreach ($payment_status as $item)
                                                        <option value="{{$item}}">{{$item}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('payment_status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                     @enderror 
                                                    </div>  
                                        </div>
                                        
<div class="row">
    <div class="form-group col-md-6 col-12">
        <label for="submit_time">{{trans('admin.submit_time')}}</label>  
        <input type="date" class="form-control datepickerInput" name="submit_time" id="submit_time">
        @error('submit_time')
        <span class="text-danger">{{ $message }}</span>
     @enderror 
    </div>
    <div class="form-group col-md-6 col-12">
        <label for="delivery_time">{{trans('admin.delivery_time')}}</label>  
        <input type="date" class="form-control datepickerInput" name="delivery_time" id="delivery_time">
        @error('delivery_time')
        <span class="text-danger">{{ $message }}</span>
     @enderror 
    </div>
</div>
                            <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.create_purchase') }}</button></button>
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
@endpush
@endsection