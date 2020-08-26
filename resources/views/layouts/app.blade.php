<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    {{-- {{dd(app()->getLocale(lang()))}} --}}
    {{-- @if (direction() == 'ltr')
    @include('layouts.header')
    @else 
    @include('layouts.ar-header')
    @endif --}}
@include('layouts.header')
    <!-- START: Body-->
    <body id="main-container" class="default semi-dark">
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <img src="{{ asset('dist/images/logo.png') }}" alt="logo" width="23" class="img-fluid"/>
        </div>
        <!-- END: Pre Loader-->

      @include('layouts.navbar')

      
      @include('layouts.sidebar')
      
        <!-- START: Main Content-->
        <main>
            <div class="container-fluid">
                @include('layouts.message')
     
               @yield('content')
            </div>
        </main>
        <!-- END: Content-->
@include('layouts.footer')
        {{-- @if (direction() == 'ltr')       
        @include('layouts.footer')
        @else 
        @include('layouts.ar-footer')
        @endif --}}
     @stack('scripts')
    </body>
    <!-- END: Body-->
</html>
