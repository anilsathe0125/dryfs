@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Announcement') }}</h1>
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
                    <div class="col-md-12">
                        <form action="{{ route("backend.setting.update") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" row">
                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" id="is_announcement" class="email_smtp_check" name="is_announcement" value="1" {{ $setting->is_announcement == 1 ? 'checked' : '' }}>
                                            <label for="is_announcement">{{ __('Announcement Banner') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <!-- SMTP Details Row -->
                            <div class="row email_smtp_row {{ $setting->is_announcement == 1 ? '' : 'd-none' }}">

                              <div class="col-md-2"></div>
                                <div class="form-group col-md-8">
                                    <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                    <br>
                                    <img src="{{ $setting->announcement ? asset($setting->announcement) : asset('backend/images/placeholder.png') }}" class="admin-setting-img admin-image-preview" alt="No Image Found">
                                    <br>
                                    <span>{{ __('Image Size Should Be 520 x 530.') }}</span>
                                </div>
                              <div class="col-md-2"></div>

                              <div class="col-md-2"></div>
                                <div class="form-group col-md-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="announcement" accept="image/*" class="custom-file-input upload-photo" id="announcement" aria-label="File browser">
                                        <label class="custom-file-label" for="announcement">{{ __('Upload Image...') }}</label>
                                        </div>
                                    </div>
                                </div>
                              <div class="col-md-2"></div>


                              <div class="col-md-2"></div>
                              <div class="form-group  col-md-8">
                                <label for="announcement_delay">{{ __('Announcement Delay (seconds)') }} </label>
                                <input type="number" min="0" step="0.01" name="announcement_delay" class="form-control " id="announcement_delay" placeholder="{{ __('Enter Announcement Delay') }}" value="{{ $setting->announcement_delay }}" >
                              </div>
                              <div class="col-md-2"></div>

                              <div class="col-md-2"></div>
                              <div class="form-group  col-md-8">
                                <label for="announcement_link">{{ __('Link') }} </label>
                                <input type="text" name="announcement_link" class="form-control " id="announcement_link" placeholder="{{ __('Enter Link') }}" value="{{ $setting->announcement_link }}" >
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
