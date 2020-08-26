@push('scripts')

<script>
    $(document).ready(function(){
        $(document).on('click' , '.copy_product' , function(){

$.ajax({
url:"{{aurl('products/copy/' . $product->id)}}",
dataType:'json',
type:'post',
data:{_token : '{{csrf_token()}}'},
beforeSend: function(){
$('.loading_copy').removeClass('d-none');
},
success:function(data){
    if(data.status == true){
    $('.loading_copy').addClass('d-none');
    toastr.success('product copied successfully now wait!' , 'success');
    setTimeout(() => {
        // window.location.href = `admin/products/${data.id}/edit`;
        window.location.href = '{{aurl("products")}}/' + data.id +'/edit';
    },2000)
   
    }
},
error(response){
    var errors = response.responseJSON.errors
    $('.loading_copy').addClass('d-none');
    toastr.error('error happened while copying', 'Error!')
}
});
       });   

       $(document).on('click' , '.save_and_continue' , function(){
var form_data = $('#form_product').serialize();
$.ajax({
url:"{{aurl('products/' . $product->id)}}",
dataType:'json',
type:'post',
data:form_data,
beforeSend: function(){
$('.loading_save_c').removeClass('d-none');
},
success:function(data){
    if(data.status == true){
    $('.loading_save_c').addClass('d-none');
    toastr.success('success' , 'product updated')
    }
},
error(response){
    var errors = response.responseJSON.errors
    console.log(errors)
   $.each(errors , function(index,value){
       $('#' + index).addClass('is-invalid');
       $('#' + index + '_feedback').html(value)
   });
    $('.loading_save_c').addClass('d-none');
    toastr.error('invalid inputs please check your data.', 'Error!')
}
});
       });


       $("input, select, textarea").on('change' , function(e){
           if($(this).hasClass('is-invalid')){
               $(this).removeClass('is-invalid');
               $(this).next().html('')
           }
 })      
    });
</script>
@endpush

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
   
<div class="row justify-content-between align-items-center" style="margin-top:40px">
<div class="col-12">
    <div class="card">
        <div class="card-header">                               
        <h4 class="card-title">{{ trans('admin.create_or_update') }}</h4>                                
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">                                           
                    <div class="col-12">
                        <form action="{{ route('products.update' , $product->id) }}" method="post" enctype="multipart/form-data" id="form_product">
                            <a href="#" class="btn btn-primary save">{{ trans('admin.save') }}  <i class="fa fa-floppy-o"></i></a>
  <a href="#" class="btn btn-success save_and_continue" id="test_toastr">{{ trans('admin.save_and_continue') }} <i class="fa fa-floppy-o"></i>
    <i class="fa fa-spin fa-spinner loading_save_c d-none"></i>
  </a>
  <a href="#" class="btn btn-info copy_product">{{ trans('admin.copy_product') }}
    <i class="fa fa-spin fa-spinner loading_copy d-none"></i>
    <i class="fa fa-copy"></i> </a>
  <a href="#" class="btn btn-danger delete"  data-toggle="modal" data-target="#del_admin{{ $product->id }}">{{ trans('admin.delete') }} <i class="fa fa-trash"></i></a>
  <hr />
                            @csrf
                           @method('PUT')
                            <div class="col-12 mx-auto mt-3">

                                <div class="">
                                    <div class="">
                                        <div class="wizard mb-4">                                            
                                            <div class="connecting-line"></div>
                                            <ul class="nav nav-tabs d-flex mb-3 p-0">
                                                <li class="nav-item ml-auto ">
                                                    <a class="nav-link position-relative round-tab text-left p-0 border-0 active" data-toggle="tab" href="#product_info"> 
                                                        <i class="fa fa-info position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block ">{{ trans('admin.product_info') }} </small>
                                                    </a>
                                                </li>
                                                <li class="nav-item ml-auto ">
                                                    <a class="nav-link position-relative round-tab text-sm-center text-left p-0 border-0" data-toggle="tab" href="#department"> 
                                                        <i class="fas fa-list position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block ">{{ trans('admin.departments') }} </small>
                                                    </a>
                                                </li>
                                                <li class="nav-item mx-auto">
                                                    <a class="nav-link position-relative round-tab text-sm-center text-left p-0 border-0" data-toggle="tab" href="#product_setting"> 
                                                        <i class="fa fa-cog position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block">{{ trans('admin.product_setting') }}</small>
                                                    </a>
                                                </li>
                                                <li class="nav-item mx-auto">
                                                    <a class="nav-link position-relative round-tab text-sm-center text-left p-0 border-0" data-toggle="tab" href="#product_media"> 
                                                        <i class="far fa-file-image position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block">{{ trans('admin.product_media') }}</small>
                                                    </a>
                                                </li>
                                                <li class="nav-item mx-auto">
                                                    <a class="nav-link position-relative round-tab text-sm-center text-left p-0 border-0" data-toggle="tab" href="#product_description"> 
                                                        <i class="far fa-gem position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block">{{ trans('admin.product_description') }}</small>
                                                    </a>
                                                </li>
                                                <li class="nav-item mx-auto">
                                                    <a class="nav-link position-relative round-tab text-sm-center text-left p-0 border-0" data-toggle="tab" href="#other_data"> 
                                                        <i class="fas fa-folder-plus position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block">{{ trans('admin.other_data') }}</small>
                                                    </a>
                                                </li>
                                                <li class="nav-item mr-auto">
                                                    <a class="nav-link position-relative round-tab text-sm-right text-left p-0 border-0" data-toggle="tab" href="#related_product"> 
                                                        <i class="icon-credit-card position-relative text-white h5 mb-3"></i>
                                                        <small class="d-none d-md-block">{{ trans('admin.related_product') }}</small>
                                                    </a>
                                                </li>
                                            </ul>                                          

                                            <div class="tab-content">
                                                @include('admin.products.tabs.product_info')
                                                @include('admin.products.tabs.department')
                                                @include('admin.products.tabs.product_setting')
                                                @include('admin.products.tabs.product_media')
                                                @include('admin.products.tabs.product_description')
                                                @include('admin.products.tabs.other_data')
                                                @include('admin.products.tabs.related_product')
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                               
                               <hr> 
                            <a href="#" class="btn btn-primary save">{{ trans('admin.save') }}  <i class="fa fa-floppy-o"></i></a>
                            <a href="#" class="btn btn-success save_and_continue" id="test_toastr">{{ trans('admin.save_and_continue') }} <i class="fa fa-floppy-o"></i>
                              <i class="fa fa-spin fa-spinner loading_save_c d-none"></i>
                            </a>
                            <a href="#" class="btn btn-info copy_product">{{ trans('admin.copy_product') }}
                              <i class="fa fa-spin fa-spinner loading_copy d-none"></i>
                              <i class="fa fa-copy"></i> </a>
                            <a href="#" class="btn btn-danger delete"  data-toggle="modal" data-target="#del_admin{{ $product->id }}">{{ trans('admin.delete') }} <i class="fa fa-trash"></i></a>                                                                               
                                   

                            {{-- <div class="form-group">                                                  
                            <button type="submit" class="btn btn-primary">{{ trans('admin.add') }}</button></button>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>
</div>

<!-- Modal -->
<div id="del_admin{{ $product->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
        </div>
        {{--  {{ route('admins.destroy', [$id]) }}--}}
       <form action="{{ aurl('products/'.$product->id) }}" method="POST">
        @csrf
        @method('delete')
        <div class="modal-body">
          <h4>{{ trans('admin.delete_this',['name'=>$product->title ]) }}</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
        <button type="submit" class="btn btn-danger">{{trans('admin.delete')}}</button>
        </div>
    </form>
      </div>
  
    </div>
  </div>
@endsection