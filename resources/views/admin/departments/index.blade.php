@extends('layouts.app')
@section('content')

@push('scripts')
<script>
  $(document).ready(function(){
    $('#jstree').jstree({
  "core" : {
    'data' : {!! load_department(old('parent'))  !!},
    "themes" : {
      "variant" : "large"
    }
  },
  "checkbox" : {
    "keep_selected_style" : false
  },
  "plugins" : [ "wholerow"]
});
  })
  $('#jstree').on('changed.jstree', function(e,data){
    var i, j, r = [];
    var name = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).id);
      name.push(data.instance.get_node(data.selected[i]).text);
    }
    $('.parent_id').val(r.join(' , '))
    $('.dep_name').text(name.join(' , '))

    if(r.join(' , ') !== ''){
      $('.show_dep').removeClass('d-none');
      $('.delete_btn').removeClass('d-none');
      
$('.show_dep').attr('href' , '{{aurl('departments')}}/' + r.join(' , ') + '/edit')

$('.del_dep_form').attr('action' , '{{aurl('departments')}}/' + r.join(' , '))
    }else{
      $('.show_dep').addClass('d-none');
    }

   
})
</script>
@endpush
<div class="row">
  {{--  "{{aurl('depa/'.$id.'/edit')}}" --}}
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
            <h4 class="card-title">{{__('admin.departments')}}</h4> 
            </div>
            <div class="card-body">
            <a href="" class="btn btn-info mr-3 d-none show_dep"><i class="fa fa-edit"></i>{{__('admin.edit')}}</a> 
            <button type="button" data-toggle="modal" data-target="#del_department" class="btn btn-danger d-none delete_btn"><i class="fa fa-trash">{{__('admin.delete')}}</i></button>
              <div class="my-2">
              <div id="jstree"></div>
              <input type="hidden" name="parent" class="parent_id" value="">
            </div>
            </div>
        </div> 

    </div>                  
</div>



<!-- Modal -->
<div id="del_department" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      {{-- {{ aurl('departments/'.$id) }} --}}

     <form class="del_dep_form" action="" method="POST">
      @csrf
      @method('delete')
      <div class="modal-body">
      <span>{{__('admin.ask_delete_item')}}</span>
      <span class="dep_name"></span>
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

