@push('scripts')
<script>
  $(document).ready(function(){
    $('#jstree').jstree({
  "core" : {
    'data' : {!! load_department($product->department_id)  !!},
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
    
    }
    $('.department_id').val(r.join(' , '))
   

    

   
})
</script>
@endpush

<div class="tab-pane fade" id="department">
    <h3>{{ trans('admin.departments') }}</h3>
    <div id="jstree"></div>
    <input type="hidden" name="department_id" class="department_id" id="department_id" value="">     
    <span class="is-invalid text-danger" id="department_id_feedback"></span>                                      
</div>