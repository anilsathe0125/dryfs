@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Maintainance') }}</h1>
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
                                            <input type="checkbox" id="is_maintainance" class="email_smtp_check" name="is_maintainance" value="1" {{ $setting->is_maintainance == 1 ? 'checked' : '' }}>
                                            <label for="is_maintainance">{{ __('Maintainance Mode') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <!-- SMTP Details Row -->
                            <div class="row email_smtp_row {{ $setting->is_maintainance == 1 ? '' : 'd-none' }}">

                              <div class="col-md-2"></div>
                                <div class="form-group col-md-8">
                                    <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                    <br>
                                    <img src="{{ $setting->maintainance_image ? asset($setting->maintainance_image) : asset('backend/images/placeholder.png') }}" class="admin-setting-img admin-image-preview" alt="No Image Found">
                                    <br>
                                    <span>{{ __('Image Size Should Be 520 x 530.') }}</span>
                                </div>
                              <div class="col-md-2"></div>

                              <div class="col-md-2"></div>
                                <div class="form-group col-md-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="maintainance_image" accept="image/*" class="custom-file-input upload-photo" id="maintainance_image" aria-label="File browser">
                                        <label class="custom-file-label" for="maintainance_image">{{ __('Upload Image...') }}</label>
                                        </div>
                                    </div>
                                </div>
                              <div class="col-md-2"></div>

                              <div class="col-md-2"></div>
                              <div class="form-group  col-md-8">
                                <label for="maintainance_text">{{ __('Maintainance Mode Text') }} </label>
                                <textarea name="maintainance_text" class="form-control " id="maintainance_text" placeholder="{{ __('Enter Link') }}" rows="5" >{{ $setting->maintainance_text }}</textarea>
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
