@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Social Login') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              @include('alerts.alerts')
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-5 col-sm-3">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#facebook" role="tab" aria-controls="facebook" aria-selected="true">{{ _('Facebook') }}</a>

                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#google" role="tab" aria-controls="google" aria-selected="false">{{ __('Google') }}</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <form action="{{ route('backend.setting.update') }}" method="POST" id="quickForm" enctype="multipart/form-data" class="tab-content" id="vert-tabs-tabContent">
                        @csrf

                        <div class="tab-pane text-left fade show active" id="facebook" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class=" row">
                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" id="facebook_check" class="" name="facebook_check" value="1" {{ $setting->facebook_check == 1 ? 'checked' : '' }}>
                                            <label for="facebook_check">{{ __('Facebook Login') }}</label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                  <div class="col-md-3"></div>
                                  <div class="form-group  col-md-6">
                                    <label for="facebook_client_id">{{ __('App ID') }} </label> <small>({{ __('From developers.facebook.com') }})</small>
                                    <input type="text" name="facebook_client_id" class="form-control " id="facebook_client_id" placeholder="{{ __('Enter App ID') }}" value="{{ $setting->facebook_client_id }}" >
                                  </div>
                                  <div class="col-md-3"></div>

                                  <div class="col-md-3"></div>
                                  <div class="form-group  col-md-6">
                                    <label for="facebook_client_secret">{{ __('App Secret') }} </label> <small>({{ __('From developers.facebook.com') }})</small>
                                    <input type="text" name="facebook_client_secret" class="form-control " id="facebook_client_secret" placeholder="{{ __('Enter App Secret') }}" value="{{ $setting->facebook_client_secret }}" >
                                  </div>
                                  <div class="col-md-3"></div>

                                  <div class="col-md-3"></div>
                                  <div class="form-group  col-md-6">
                                    <label for="facebook_redirect">{{ __('Redirect URL') }} </label> <small>({{ __('Set this to your Valid OAuth Redirect URI in developers.facebook.com') }})</small>
                                    <input type="text" name="facebook_redirect" class="form-control " id="facebook_redirect" placeholder="{{ __('Enter Redirect URL') }}" value="{{ $facebook_url }}" readonly>
                                  </div>
                                  <div class="col-md-3"></div>



                                </div>
                        </div>

                        <div class="tab-pane fade" id="google" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <div class=" row">
                                <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" id="google_check" class="" name="google_check" value="1" {{ $setting->facebook_check == 1 ? 'checked' : '' }}>
                                        <label for="google_check">{{ __('Google Login') }}</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>

                                <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                <label for="google_client_id">{{ __('Client ID') }} </label> <small>({{ __('From console.cloud.google.com') }})</small>
                                <input type="text" name="google_client_id" class="form-control " id="google_client_id" placeholder="{{ __('Enter App ID') }}" value="{{ $setting->google_client_id }}" >
                                </div>
                                <div class="col-md-3"></div>

                                <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                <label for="google_client_secret">{{ __('Client Secret') }} </label> <small>({{ __('From console.cloud.google.com') }})</small>
                                <input type="text" name="google_client_secret" class="form-control " id="google_client_secret" placeholder="{{ __('Enter App ID') }}" value="{{ $setting->google_client_secret }}" >
                                </div>
                                <div class="col-md-3"></div>

                                <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                <label for="google_redirect">{{ __('Redirect URL') }} </label> <small>({{ __('Set this to your Redirect URL in console.cloud.google.com') }})</small>
                                <input type="text" name="google_redirect" class="form-control " id="google_redirect" placeholder="{{ __('Enter App ID') }}" value="{{ $google_url }}" >
                                </div>
                                <div class="col-md-3"></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="form-group  col-md-6">
                              <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
