@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Create Blog') }}</h1>
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
              <form action="{{ route('backend.post.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">{{ __('Set Image') }} *</label>
                    <br>
                    <img src="{{ asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 708 x 277.') }}</span>
                  </div>
                  <div class="col-md-8"></div>
                  <div class="form-group col-md-4">
                    <label for="file">{{ __('Upload Image...') }}</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="photo[]" class="custom-file-input upload-photo" id="file" aria-label="File browser" multiple>
                          <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Images...') }}</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-8"></div>

                  <div class="form-group  col-md-12">
                    <label for="title">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="category_id">{{ __('Select Category') }} *</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="" selected >{{ __('Select One') }}</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" >{{ $cat->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="details">{{ __('Details') }} *</label>
                    <textarea name="details" id="details" class='form-control summernote' placeholder="{{ __('Enter Details') }}" rows="5">{!! old('details') !!}</textarea>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="tags">{{ __('Tags') }}</label>
                    <input type="text" name='tags' id="tags" class='form-control tags' placeholder="{{ __('Tags') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="meta_keywords">{{ __('Meta Keywords') }}</label>
                    <input type="text" name='meta_keywords' id="meta_keywords" class='form-control tags' placeholder="{{ __('Enter Meta Keywords') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="meta_descriptions">{{ __('Meta Description') }}</label>
                    <textarea name="meta_descriptions" id="meta_descriptions" class='form-control' placeholder="{{ __('Enter Meta Description') }}" rows="5">{{ old('meta_descriptions') }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.post.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
