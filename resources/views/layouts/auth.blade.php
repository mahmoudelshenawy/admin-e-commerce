<!DOCTYPE html>
<html>
    <meta charset="utf-8">
@include('layouts.header')
    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <img src="{{ asset('dist/images/logo.png') }}" alt="logo" width="23" class="img-fluid"/>
        </div>
        <main>
            <div class="container-fluid">
                @include('layouts.message')
     
               @yield('content')
            </div>
        </main>
        <!-- END: Content-->
@include('layouts.footer')
      
     @stack('scripts')
    </body>
    <!-- END: Body-->
</html>
