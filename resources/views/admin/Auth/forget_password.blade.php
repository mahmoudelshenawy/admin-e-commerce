@extends('layouts.app')

@section('content')

    @include('layouts.breadcrumbs')
<div class="row vh-100 justify-content-between align-items-center" style="margin-top: -100px">
    @if (session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="col-12">
    <form action="{{ aurl('forgot/password') }}" method="POST" class="row row-eq-height lockscreen  mt-5 mb-5">
            @csrf
            <div class="lock-image col-12 col-sm-5"></div>
            <div class="login-form col-12 col-sm-7">
<h1>Reset your Password</h1>
                <div class="form-group mb-3">
                    <label for="emailaddress">{{ __('auth.email') }}</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="emailaddress" required="" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary" type="submit"> {{ __('auth.reset') }} </button>
                    </div>

                </div>
            </form>
        </div>

    </div>

    @endsection
