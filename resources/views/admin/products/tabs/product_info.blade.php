<div class="tab-pane fade active show" id="product_info">
<h3>{{trans('admin.product_info')}}</h3>   

<div class="form-group">
    <label for="title">{{trans('admin.title')}}</label>                                                  
<input type="text" class="form-control" id="title" name="title" placeholder="{{trans('admin.title')}}" value="{{$product->title}}">                                                <span class="is-invalid text-danger" id="title_feedback"></span>    
    </div>
<div class="form-group">
    <label for="content">{{trans('admin.content')}}</label>                                                  
<textarea type="text" class="form-control" id="content" name="content" placeholder="{{trans('admin.content')}}" value="{{$product->content}}">{{$product->content}}</textarea>                                       <span class="is-invalid text-danger" id="content_feedback"></span>           
    </div>

</div>