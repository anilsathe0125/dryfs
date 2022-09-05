@extends('backend.layouts.auth')
@section('title')
    {{ __('Reset Password') }}
@endsection
@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <p  class="h1">{{ __('Change Password') }}</p>
        </div>
        <div class="card-body">

        @include('alerts.alerts')

        <form action="{{ route("backend.change.password") }}" method="POST" >
            @csrf
            <div class="input-group mb-3">
                <input type="password" name="new_password" class="form-control" placeholder="{{ __('New Password') }}" value="">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="renew_password" class="form-control" placeholder="{{ __('Re-Type New Password') }}" value="">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="file_token" value="{{ $token }}">
            <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Change Password') }}</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
