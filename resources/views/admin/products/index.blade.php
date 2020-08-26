@push('scripts')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json"></script> --}}

<script>
    $(document).ready(function() {
        var product_table = $("#product_table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dom: "Bfrtip",
        buttons: [
            {
                text: "Create New Product",
                className: "btn btn-primary",
                action: function(e, dt, node, config) {
                    window.location.href = "{{URL::current()}}" + "/create";
                }
            },
            {
                text: "Reload",
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                }
            },
            {
                text: '<i class="fa fa-trash"></i>',
                className: "btn btn-danger delBtn"
            },
            "colvis",
            "excel",
            "print",
            "pdf"
        ],
        ajax: "{{aurl('products')}}",
        columnDefs: [
            {
                targets: 3,
                orderable: false,
                searchable: false
            }
        ],
        columns: [
            {
                data: "checkbox",
                name: "checkbox",
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false
            },
            { data: "id", name: "id" },
            { data: "title", name: "title" },
            { data: "price", name: "price" },
            { data: "stock", name: "stock" },
            { data: "offer_price", name: "offer_price" },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false
            }
        ]
    });

    $(document).on('change' ,'#category_id' ,function(e){
             var category_id = e.target.value;
             $.ajax({
    dataType:'json',
url:"{{aurl('products?filter=true')}}",
data:{_token:'{{csrf_token()}}' ,category_id:category_id },
  beforeSend: function(){
},
success:function(data){
    
    product_table.ajax.reload();
console.log(data)
},
error(response){
    var errors = response.responseJSON.errors
    toastr.error('error happened while copying', 'Error!')
}  
        });
            });

            $(document).on('change' ,'#color_id' ,function(e){
             var color_id = e.target.value;
     $.ajax({
    dataType:'json',
url:"{{aurl('products')}}",
data:{_token:'{{csrf_token()}}' ,color_id:color_id , filter:true},
  beforeSend: function(){
},
success:function(data){
    product_table.ajax.reload();
console.log(data)
},
error(response){
    var errors = response.responseJSON.errors
    toastr.error('error happened while copying', 'Error!')
}  
        });
            });

            $('#filter').on('submit' , function(){
                var form_data = $('#filter').serialize();
                console.log(form_data)
            $.ajax({
    dataType:'json',
    type:'post',
url:"{{aurl('products/filter')}}",
data:{_token:'{{csrf_token()}}' ,data:form_data },
  beforeSend: function(){
},
success:function(data){
    if(data.status == true){

   
    }
},
error(response){
    var errors = response.responseJSON.errors
    toastr.error('error happened while copying', 'Error!')
}  
        });
            });
});
check_all()
    delete_all()
</script>

     
{{-- {{$dataTable->scripts()}} --}}
@if (session('success'))
<script>
    toastr.success('success' , 'product deleted')
</script>
@endif
@endpush

@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title">products</h4> 

                @include('admin.products.filter')
            </div>
            <div class="card-body">
              <form id="form_data" action="{{ aurl('products/delete/all') }}" method="post">
                {{ csrf_field() }}
                {{method_field('delete')}}
              
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="product_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check_all" onclick="check_all()" /></th>
                                <th>ID</th>
                                <th>@lang( 'admin.title' )</th>
                                <th>@lang( 'admin.price' )</th>
                                <th>@lang( 'admin.stock' )</th>
                                <th>@lang( 'admin.offer_price' ) </th>
                                <th>@lang( 'admin.actions' )</th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
              </form>
            </div>
        </div> 

    </div>                  
</div>

<!-- Modal -->
<div id="mutlipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger">
        	<div class="empty_record hidden">
        	<h4>{{ trans('admin.please_check_some_records') }} </h4>
        	</div>
        	<div class="not_empty_record hidden">
        	<h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span> ? </h4>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
      	<div class="empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
      	</div>
      	<div class="not_empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
        <input type="submit"  value="{{ trans('admin.yes') }}"  class="btn btn-danger del_all" />
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

