@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Category') }}</h1>
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
              <form action="{{ route('backend.category.update', $category->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">{{ __('Set Image') }} *</label>
                    <br>
                    <img src="{{ $category->photo ? asset($category->photo) : asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 60 x 60.') }}</span>
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
                    <label for="name">{{ __('Name') }} *</label>
                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $category->name }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="slug">{{ __('Slug') }} *</label>
                    <input type="text" name="slug" class="form-control " id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ $category->slug }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="exampleInputPassword1">{{ __('Meta Keywords') }}</label>
                    <input type="text" name='meta_keywords' class='form-control tags' placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $category->meta_keywords }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="exampleInputPassword1">{{ __('Meta Description') }}</label>
                    <textarea name='meta_descriptions' class='form-control' placeholder="{{ __('Enter Meta Description') }}" rows="5">{{ $category->meta_descriptions }}</textarea>
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="exampleInputPassword1">{{ __('Serial') }} *</label>
                    <input type="number" name='serial' class='form-control' placeholder="{{ __('Enter Serial Serial') }}" value="{{ $category->serial }}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="{{ route("backend.category.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
