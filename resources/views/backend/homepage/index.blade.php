@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Home Page') }}</h1>
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
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">{{ __('3 column banner First') }}</a>

                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <div class="tab-content" id="vert-tabs-tabContent">

                        <div class="tab-pane text-left fade show active" id="tab1" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{ route('backend.first.banner.update') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputEmail1">{{ __('Image 1') }} *</label>
                                        <br>
                                        <img src="{{ $first_banner['img1'] ? asset($first_banner['img1']) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                        <br>
                                        <span>{{ __('Image Size Should Be 496 x 204.') }}</span>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" name="img1" class="custom-file-input upload-photo" id="img1" aria-label="File browser">
                                            <label class="custom-file-label" for="img1">{{ __('Upload Image...') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2"></div>
                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8 border-bottom mb-4"></div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputEmail1">{{ __('Image 2') }} *</label>
                                        <br>
                                        <img src="{{ $first_banner['img2'] ? asset($first_banner['img2']) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                        <br>
                                        <span>{{ __('Image Size Should Be 496 x 204.') }}</span>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" name="img2" class="custom-file-input upload-photo" id="img2" aria-label="File browser">
                                            <label class="custom-file-label" for="img2">{{ __('Upload Image...') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8 border-bottom mb-4"></div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputEmail1">{{ __('Image 3') }} *</label>
                                        <br>
                                        <img src="{{ $first_banner['img3'] ? asset($first_banner['img3']) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                        <br>
                                        <span>{{ __('Image Size Should Be 496 x 204.') }}</span>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" name="img3" class="custom-file-input upload-photo" id="img3" aria-label="File browser">
                                            <label class="custom-file-label" for="img3">{{ __('Upload Image...') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group col-md-8 border-bottom mb-4"></div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                        <label for="firsturl1">{{ __('URL 1') }} *</label>
                                        <input type="text" name="firsturl1" class="form-control " id="firsturl1" placeholder="{{ __('Enter Banner Url') }}" value="{{ $first_banner['firsturl1'] }}" >
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                        <label for="firsturl2">{{ __('URL 2') }} *</label>
                                        <input type="text" name="firsturl2" class="form-control " id="firsturl2" placeholder="{{ __('Enter Banner Url') }}" value="{{ $first_banner['firsturl2'] }}" >
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                        <label for="firsturl3">{{ __('URL 3') }} *</label>
                                        <input type="text" name="firsturl3" class="form-control " id="firsturl3" placeholder="{{ __('Enter Banner Url') }}" value="{{ $first_banner['firsturl3'] }}" >
                                    </div>
                                    <div class="col-md-2"></div>

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
