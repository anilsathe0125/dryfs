@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update User') }}</h1>
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
              <form action="{{ route('backend.staff.update', $admin->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">{{ __('Set Image') }} *</label>
                    <br>

                    <img src="{{ $admin->photo ? asset($admin->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 70 x 70.') }}</span>
                  </div>
                  <div class="col-md-8"></div>
                  <div class="form-group col-md-4">
                    <label for="file">{{ __('Upload Image...') }}</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="photo" class="custom-file-input upload-photo" id="file" aria-label="File browser">
                          <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-8"></div>

                  <div class="form-group  col-md-6">
                    <label for="name">{{ __('User Name') }} *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $admin->name }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="email">{{ __('Email Address') }} *</label>
                    <input type="email" name="email" class="form-control " id="email" placeholder="{{ __('Enter Email') }}" value="{{ $admin->email }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input type="text" name='phone' class='form-control ' placeholder="{{ __('Enter Phone Number') }}" value="{{ $admin->phone }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name='password' class='form-control ' placeholder="{{ __('Enter Password') }}" >
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="role_id">{{ __('Select Role') }} *</label>
                    <select name="role_id" id="role_id"  class="form-control select2">
                        <option value="" selected disabled>{{ __('Select One') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.staff.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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
