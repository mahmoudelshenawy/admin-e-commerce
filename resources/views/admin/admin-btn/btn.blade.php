<a href="{{aurl('admins/'.$id.'/edit')}}" class="btn btn-info mr-3"><i class="fa fa-edit"></i></a> 


<button type="button" data-toggle="modal" data-target="#del_admin{{ $id }}" class="btn btn-danger"><i class="fa fa-trash"></i></button>


<!-- Modal -->
<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
        </div>
        {{--  {{ route('admins.destroy', [$id]) }}--}}
       <form action="{{ aurl('admins/'.$id) }}" method="POST">
        @csrf
        @method('delete')
        <div class="modal-body">
          <h4>{{ trans('admin.delete_this',['name'=>$name]) }}</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
        <button type="submit" class="btn btn-danger">{{trans('admin.delete')}}</button>
        </div>
    </form>
      </div>
  
    </div>
  </div>
  