@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Profile') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('backend.profile.update') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        @include('alerts.alerts')
                    </div>
                    <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                    <br>
                    <img src="{{ $data->photo ? asset($data->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 40 x 40.') }}</span>
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group col-md-6">
                    <label for="file">{{ __('Upload Image...') }}</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="photo" class="custom-file-input upload-photo" id="file" aria-label="File browser">
                          <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="name">{{ __('User Name') }} *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('User Name') }}" value="{{ $data->name }}">
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="email">{{ __('Email Address') }} *</label>
                    <input type="email" name="email" class="form-control " id="email" placeholder="{{ __('Email Address') }}" value="{{ $data->email }}">
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input type="text" name='phone' id="phone" class='form-control' placeholder="{{ __('Phone Number') }}" value="{{ $data->phone }}">
                  </div>
                  <div class="col-md-3"></div>

                </div>
                <!-- /.card-body -->
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="card-footer col-md-6">
                      <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>
                    </div>
                    <div class="col-md-3"></div>
                </div>

              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
