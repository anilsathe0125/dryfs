@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Payment') }}</h1>
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
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#cod" role="tab" aria-controls="cod" aria-selected="true">{{ __('Cash On Delivery') }}</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div class="tab-content" id="vert-tabs-tabContent">

                        <div class="tab-pane text-left fade show active" id="cod" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{ route('backend.setting.payment.update') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">
                                    <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                   <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        <input type="checkbox" id="status" class="" name="status" value="1" {{ $cod->status == 1 ? 'checked' : '' }}>
                                        <label for="status">{{ __('Display Cash On Delivery') }}</label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                        <br>
                                        <img src="{{ $cod->photo ? asset($cod->photo) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                        <br>
                                        <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                    </div>
                                    <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input upload-photo" id="photo" aria-label="File browser">
                                        <label class="custom-file-label" for="photo">{{ __('Upload Image...') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>


                                  <div class="col-md-3"></div>
                                  <div class="form-group  col-md-6">
                                    <label for="text">{{ __('Enter Text') }} *</label>
                                    <textarea name="text" class="form-control " id="text" placeholder="{{ __('Enter Text') }}" rows="5">{{ $cod->text }}</textarea>
                                  </div>
                                  <div class="col-md-3"></div>

                                  <div class="col-md-3"></div>
                                  <div class="form-group  col-md-6">
                                    <input type="hidden" name="unique_keyword" value="cod">
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
