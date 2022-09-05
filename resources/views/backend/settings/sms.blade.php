@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('SMS Setting') }}</h1>
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
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#config" role="tab" aria-controls="config" aria-selected="true">{{ _('Configuration') }}</a>

                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#templates" role="tab" aria-controls="templates" aria-selected="false">{{ __('SMS Section') }}</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div  class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="config" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{ route("backend.sms.update") }}" method="POST">
                                @csrf
                                <div class=" row">
                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_twilio" class="email_smtp_check" name="is_twilio" value="1" {{ $setting->is_twilio == 1 ? 'checked' : '' }}>
                                                <label for="is_twilio">{{ __('SMS Service') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <!-- SMTP Details Row -->
                                <div class="row email_smtp_row {{ $setting->is_twilio == 0 ? 'd-none' : '' }}">
                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="twilio_sid">{{ __('Twilio Sid') }} </label>
                                    <input type="text" name="twilio_sid" class="form-control " id="twilio_sid" placeholder="{{ __('Enter Twilio Sid') }}" value="{{ $setting->twilio_sid }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="twilio_token">{{ __('Twilio Token') }} </label>
                                    <input type="text" name="twilio_token" class="form-control " id="twilio_token" placeholder="{{ __('Enter Twilio Token') }}" value="{{ $setting->twilio_token }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="twilio_form_number">{{ __('Twilio Form Number') }} </label>
                                    <input type="text" name="twilio_form_number" class="form-control " id="twilio_form_number" placeholder="{{ __('Enter Twilio Form Number') }}" value="{{ $setting->twilio_form_number }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="twilio_country_code">{{ __('Country Number Code') }} </label>
                                    <input type="text" name="twilio_country_code" class="form-control " id="twilio_country_code" placeholder="{{ __('Country Number Code') }}" value="{{ $setting->twilio_country_code }}" >
                                    <strong>{{__('Note')}}</strong> : <small class="text-primary">{{__('Must use (+) sign before country code')}}</small>
                                  </div>
                                  <div class="col-md-2"></div>

                                </div>

                                <div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="templates" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <form action="{{ route("backend.setting.update") }}" method="POST">
                                @csrf
                                @php
                                    $sms_section = json_decode($setting->twilio_section ,true);
                                @endphp
                                <!-- SMS Section -->
                                <div class="row ">

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="order_purchase">{{ __('Order Purchase') }} </label>
                                    <textarea type="text" name="twilio_section['purchase']" class="form-control " id="order_purchase" placeholder="{{ __('Enter Message') }}" >{{ $sms_section["'purchase'"] }}</textarea>
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="order_status">{{ __('Order Status') }} </label>
                                    <textarea type="text" name="twilio_section['order_status']" class="form-control " id="order_status" placeholder="{{ __('Enter Message') }}" >{{ $sms_section["'order_status'"] }}</textarea>
                                  </div>
                                  <div class="col-md-2"></div>

                                </div>

                                <div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>
                                </div>
                            </form>
                        </div>
                      </div>
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
