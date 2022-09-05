@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Email') }}</h1>
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
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#config" role="tab" aria-controls="config" aria-selected="true">{{ __('Configuration') }}</a>

                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#templates" role="tab" aria-controls="templates" aria-selected="false">{{ __('Templates') }}</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div  class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="config" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{ route("backend.setting.update") }}" method="POST">
                                @csrf
                                <div class=" row">
                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="smtp_check" class="email_smtp_check" name="smtp_check" value="1" {{ $setting->smtp_check == 1 ? 'checked' : '' }}>
                                                <label for="smtp_check">{{ __('SMTP Service') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <!-- SMTP Details Row -->
                                <div class="row email_smtp_row {{ $setting->smtp_check == 0 ? 'd-none' : '' }}">
                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_host">{{ __('SMTP Host') }} </label>
                                    <input type="text" name="email_host" class="form-control " id="email_host" placeholder="{{ __('Enter SMTP Host') }}" value="{{ $setting->email_host }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_port">{{ __('SMTP Port') }} </label>
                                    <input type="text" name="email_port" class="form-control " id="email_port" placeholder="{{ __('Enter SMTP Port') }}" value="{{ $setting->email_port }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_encryption">{{ __('SMTP Encryption') }} </label>
                                    <input type="text" name="email_encryption" class="form-control " id="email_encryption" placeholder="{{ __('Enter SMTP Encryption') }}" value="{{ $setting->email_encryption }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_user">{{ __('SMTP Username') }} </label>
                                    <input type="text" name="email_user" class="form-control " id="email_user" placeholder="{{ __('Enter SMTP Username') }}" value="{{ $setting->email_user }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_pass">{{ __('SMTP Password') }} </label>
                                    <input type="text" name="email_pass" class="form-control " id="email_pass" placeholder="{{ __('Enter SMTP Password') }}" value="{{ $setting->email_pass }}" >
                                  </div>
                                  <div class="col-md-2"></div>
                                </div>

                                <div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_from">{{ __('Email From') }} </label>
                                    <input type="text" name="email_from" class="form-control " id="email_from" placeholder="{{ __('Enter Email From') }}" value="{{ $setting->email_from }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="email_from_name">{{ __('Email From Name') }} </label>
                                    <input type="text" name="email_from_name" class="form-control " id="email_from_name" placeholder="{{ __('Enter Email From Name') }}" value="{{ $setting->email_from_name }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <label for="contact_email">{{ __('Contact Email') }} </label>
                                    <input type="text" name="contact_email" class="form-control " id="contact_email" placeholder="{{ __('Enter Contact Email') }}" value="{{ $setting->contact_email }}" >
                                  </div>
                                  <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="templates" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <div class=" row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <table id="admin-table" class="table table-bordered">
                                        <thead>
                                        <tr>
                                          <th>{{ __('Type') }}</th>
                                          <th>{{ __('Subject') }}</th>
                                          <th>{{ __('Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td>{{ $data->type }}</td>
                                                    <td>{{ $data->subject }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-info btn-sm mr-1"
                                                                href="{{ route('backend.template.edit',$data->id) }}">
                                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
