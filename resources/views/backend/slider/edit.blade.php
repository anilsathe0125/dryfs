@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Slider') }}</h1>
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
              <form action="{{ route('backend.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="">
                @csrf
                @method('PUT')
                <input type="hidden" name="home_page" value="{{ $slider->home_page }}">
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>

                    @if ($slider->home_page != 'theme4')
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">{{ $slider->home_page == 'theme3' ? __('Feature Image') : __('Brand Logo') }} </label>
                            <br>
                            <img src="{{ $slider->logo ? asset($slider->logo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                            <br>
                            <span>{{ $slider->home_page == 'theme3' ? __('Image Size Should Be 320 x 320.') : __('Image Size Should Be 130 x 40.') }}</span>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="form-group col-md-4">
                            <label for="logo">{{ __('Upload Image...') }}</label>
                            <div class="input-group file">
                                <div class="custom-file">
                                <input type="file" name="logo" accept="image/*" class="custom-file-input upload-photo" id="file" aria-label="File browser">
                                <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="form-group  col-md-12">
                            <label for="title">{{ __('Title') }} *</label>
                            <input type="text" name="title" class="form-control " id="title" placeholder="{{ __('Enter Title') }}" value="{{ $slider->title }}">
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="slider-link">{{ __('Link') }} *</label>
                            <input type="text" name="link" class="form-control " id="slider-link" placeholder="{{ __('Enter Link') }}" value="{{ $slider->link }}">
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="details">{{ __('Details') }}</label>
                            <textarea name='details' id="details" class='form-control' placeholder="{{ __('Enter Meta Description') }}" rows="5">{{ $slider->details }}</textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">{{ $slider->home_page == 'theme3' ? __('Set Background Image') : __('Set Slider Image') }} *</label>
                            <br>
                            <img src="{{ $slider->photo ? asset($slider->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview2" alt="">
                            <br>
                            <span>{{ $slider->home_page == 'theme3' ? __('Image Size Should Be 1920 x 750.') : __('Image Size Should Be 1000 x 530.') }}</span>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="form-group col-md-4">
                            <label for="photo">{{ __('Upload Image...') }}</label>
                            <div class="input-group">
                                <div class="custom-file file">
                                <input type="file" name="photo" accept="image/*" class="custom-file-input upload-photo2" id="file" aria-label="File browser">
                                <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group  col-md-12">
                            <label for="slider-link">{{ __('Link') }} *</label>
                            <input type="text" name="link" class="form-control " id="slider-link" placeholder="{{ __('Enter Link') }}" value="{{ $slider->link }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">{{ __('Set Slider Image') }} *</label>
                            <br>
                            <img src="{{ $slider->photo ? asset($slider->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview7" alt="">
                            <br>
                            <span>{{ __('Image Size Should Be 1000 x 530.') }}</span>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="form-group col-md-4">
                            <label for="photo">{{ __('Upload Image...') }}</label>
                            <div class="input-group">
                                <div class="custom-file file">
                                <input type="file" name="photo" accept="image/*" class="custom-file-input upload-photo7" id="file" aria-label="File browser">
                                <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                                </div>
                            </div>
                        </div>
                    @endif


                        <div class="col-md-12">
                            <a href="{{ route("backend.slider.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>


                </div>
                <!-- /.card-body -->
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
