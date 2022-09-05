@extends('backend.layouts.auth')
@section('title')
    Forgot Password
@endsection
@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <p  class="h1">{{ __('Forgot Password') }}</p>
        </div>
        <div class="card-body">

        @include('alerts.alerts')

        <form action="{{ route("backend.forgot.submit") }}" method="POST" >
            @csrf
            <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Reset My Password') }}</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

        <p class="mb-1 text-center mt-2">
            <a href="{{ route('backend.login') }}">{{ __('Remember Password?') }}</a>
        </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
