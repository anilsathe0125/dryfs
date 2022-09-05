@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Edit Service') }}</h1>
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
              <form action="{{ route('backend.service.update', $service->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">{{ __('Set Image') }} *</label>
                    <br>
                    <img src="{{ $service->photo ? asset($service->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 65 x 65.') }}</span>
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

                  <div class="form-group  col-md-12">
                    <label for="title">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ $service->title }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="details">{{ __('Details') }}</label>
                    <textarea name='details' class='form-control' placeholder="{{ __('Enter Details') }}" rows="5">{{ $service->details }}</textarea>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.service.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
