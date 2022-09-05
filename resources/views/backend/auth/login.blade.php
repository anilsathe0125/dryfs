@extends('backend.layouts.auth')
@section('title')
    Login
@endsection
@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <p  class="h1">{{ __('Sign In To Admin') }}</p>
        </div>
        <div class="card-body">
        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

        @include('alerts.alerts')

        <form action="{{ route("backend.login.submit") }}" method="POST" >
            @csrf
            <div class="input-group mb-3">
            <input type="email" name="login_email" class="form-control" placeholder="{{ __('Email Address') }}" value="{{ old('login_email') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" name="login_password" class="form-control" placeholder="{{ __('Password') }}" value="">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Sign In') }}</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

        <p class="mb-1 text-center mt-2">
            <a href="{{ route('backend.forgot') }}">{{ __('Forget Password ?') }}</a>
        </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
