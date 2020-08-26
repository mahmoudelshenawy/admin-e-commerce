 <!-- START: Breadcrumbs-->
 <div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Admin Panel</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <?php $segments = ''; ?>
                <?php $lastElement = array_key_last(Request::segments()); ?>
                @foreach(Request::segments() as $segment)
                    <?php $segments .= '/'.$segment; ?>
                   
            <li class="breadcrumb-item {{$segment == $lastElement ? 'active' : ''}}">
                        <a href="{{ $segments }}">{{$segment}}</a>
                    </li>
                @endforeach
                {{-- <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Table</li>
                <li class="breadcrumb-item active"><a href="#">Datatable</a></li> --}}
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->