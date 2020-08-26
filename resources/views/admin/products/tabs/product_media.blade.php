@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(document).ready(function(){
        $('#dropzonefileupload').dropzone({
url:"{{aurl('upload/image/' . $product->id)}}",
paramName:'file',
autoDiscover:false,
uploadMultiple : false,
maxFiles:15,
 	maxFilessize:3, // MB
 	acceptedFiles:'image/*',
 	dictDefaultMessage:'اضغط هنا لرفع الملفات او قم بسحب الملفات  وافلاتها هنا',
 	dictRemoveFile:'{{ trans('admin.delete') }}',
 	params:{
 		_token:'{{ csrf_token() }}'
 	},
     addRemoveLinks : true,
     removedfile:function(file){
         console.log(file)
    $.ajax({
dataType:'json',
type:'post',
url:"{{aurl('delete/image')}}",
data:{_token:'{{csrf_token()}}' , id:file.fid}
    });

    var Rmock = file.previewElement;
    return Rmock  != null ? Rmock.parentNode.removeChild(file.previewElement) : void 0;
     },
     init : function(){
        @foreach ($product->files()->get() as $file)
            var mock = {
                name : '{{$file->id}}',
                size:'{{$file->size}}',
                type:'{{$file->mime_type}}',
                fid:'{{$file->id}}'
            };
this.emit('addedfile' , mock)
this.options.thumbnail.call(this,mock, "{{url('storage/' . $file->full_file)}}")
            @endforeach  

this.on('sending' , function(file,xhr,formData){
formData.append('fid' , '');
file.fid = ''
});
this.on('success' , function(file,response){
    file.fid = response.id
})
     }
});

// main image of product
   $('#mainImage').dropzone({
url:"{{aurl('update/product/image/' . $product->id)}}",
paramName:'file',
autoDiscover:false,
uploadMultiple : false,
maxFiles:1,
 	maxFilessize:3, // MB
 	acceptedFiles:'image/*',
 	dictDefaultMessage:'اضغط هنا لرفع الصوره الرئيسيه',
 	dictRemoveFile:'{{ trans('admin.delete') }}',
 	params:{
 		_token:'{{ csrf_token() }}'
 	},
     addRemoveLinks : true,
     removedfile:function(file){
         
    $.ajax({
dataType:'json',
type:'post',
url:"{{aurl('delete/product/image/' . $product->id)}}",
data:{_token:'{{csrf_token()}}'}
    });

    var Rmock = file.previewElement;
    return Rmock  != null ? Rmock.parentNode.removeChild(file.previewElement) : void 0;
     },
     init : function(){
        @if(!empty($product->photo))
            var mock = {
                name : '{{$product->title}}',
                size:'',
                type:'',              
            };

this.emit('addedfile' , mock)

this.options.thumbnail.call(this,mock, "{{url('storage/' . $product->photo)}}")
            
$('.dz-progress').remove();
 		@endif

this.on('sending' , function(file,xhr,formData){
formData.append('fid' , '');
file.fid = ''
});
this.on('success' , function(file,response){
    file.fid = response.id
})
     }
});

    })
    
</script>
<style type="text/css">
    .dz-image img {
        width:100px;
        height:100px;
    }
    </style>
@endpush

<div class="tab-pane fade" id="product_media">
    <h3>{{ trans('admin.main_imge') }}</h3>

    <hr />
    <div class="dropzone" id="mainImage">
        <div class="fallback">
           
          </div>
        </div>  

    <h3>{{ trans('admin.product_media') }}</h3>

    <hr />
    <div class="dropzone" id="dropzonefileupload">
        <div class="fallback">
           
          </div>
        </div>                                        
</div>