<span class="label
{{ $level == 'customer'?'btn btn-info':'' }}
{{ $level == 'vendor'?'btn btn-primary':'' }}
{{ $level == 'company'?'btn btn-success':'' }}
">

{{ trans('admin.'.$level) }}
</span>