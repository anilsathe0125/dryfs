@extends('frontend.layouts.frontend')
@section('title')
    {{ __('Password Reset') }}
@endsection
@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('frontend.index') }}">{{ __('Home') }}</a> </li>
                        <li class="separator"></li>
                        <li>{{ __('Password Reset') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <form class="card mt-4" method="POST" action="{{ route('user.change.password') }}">
                    @csrf
                    <input type="hidden" name="file_token" value="{{ $token }}">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="d-block text-center mb-4">{{ __('Reset Password') }}</h4>
                            <label for="new_password">{{ __('New Password') }}</label>
                            <input class="form-control" type="password" name="new_password" id="new_password" placeholder="{{ __('Enter your email address') }}">
                            @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="renew_password">{{ __('Re-Type New Password') }}</label>
                            <input class="form-control" type="password" name="renew_password" id="renew_password" placeholder="{{ __('Enter your email address') }}">
                            @error('renew_password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
