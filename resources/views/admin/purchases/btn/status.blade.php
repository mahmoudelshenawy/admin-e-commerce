<span class="label 
{{ $status == 'ordered'?'btn btn-danger btn-sm':'' }}
{{ $status == 'pending'?'btn btn-warning btn-sm':'' }}
{{ $status == 'received'?'btn btn-success btn-sm':'' }}
">
{{trans('admin.' .$status)}}
</span>