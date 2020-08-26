<span class="label
{{ $payment_status == 'paid' ? 'btn btn-success btn-sm':'' }}
{{ $payment_status == 'due' ? 'btn btn-warning btn-sm':'' }}
">
{{trans('admin.' . $payment_status)}}
</span>