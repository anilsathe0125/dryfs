@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Change Password') }}</h1>
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
              <form action="{{ route('backend.password.update') }}" class="p-4" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        @include('alerts.alerts')
                    </div>
                    <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="current_password">{{ __('Current Password') }} *</label>
                    <input type="password" name="current_password" class="form-control" id="current_password" placeholder="{{ __('Enter Your Current Password') }}" >
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="new_password">{{ __('New Password') }} *</label>
                    <input type="password" name="new_password" class="form-control " id="new_password" placeholder="{{ __('Enter Your New Password') }}" >
                  </div>
                  <div class="col-md-3"></div>

                  <div class="col-md-3"></div>
                  <div class="form-group  col-md-6">
                    <label for="renew_password">{{ __('Re-Type New Password') }} *</label>
                    <input type="password" name='renew_password' id="renew_password" class='form-control' placeholder="{{ __('Re-Type New Password') }}">
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
