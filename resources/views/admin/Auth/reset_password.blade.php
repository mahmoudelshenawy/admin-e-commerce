@extends('layouts.auth')

@section('content')

    @include('layouts.breadcrumbs')
<div class="row vh-100 justify-content-between align-items-center" style="margin-top: -100px">
    <div class="col-12">
        @if ($errors->all())
            @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
    <form action="{{ route('login') }}" method="POST" class="row row-eq-height lockscreen  mt-5 mb-5">
            @csrf
            <div class="lock-image col-12 col-sm-5"></div>
            <div class="login-form col-12 col-sm-7">

                <div class="form-group mb-3">
                    <label for="emailaddress">{{ __('auth.email') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" id="emailaddress" required="" name="email" value="{{$data->email}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">{{ __('auth.password') }}</label>
                    <input class="form-control" type="password" required="" id="password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">{{ __('auth.password_confirmation') }}</label>
                    <input class="form-control" type="password" required="" id="password" name="password_confirmation">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary" type="submit"> {{ __('auth.reset') }} </button>
                    {{-- @if (Route::has('password.request')) --}}
                        {{-- @endif --}}
                    </div>

                </div>
            </form>
        </div>

    </div>

    @endsection
