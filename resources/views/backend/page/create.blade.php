@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Create Page') }}</h1>
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
              <form action="{{ route('backend.page.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                  <div class="col-md-12">
                    @include('alerts.alerts')
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="title">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control item-name" id="title" placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="slug">{{ __('Slug') }} *</label>
                    <input type="text" name="slug" class="form-control " id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="details">{{ __('Details') }} *</label>
                    <textarea name="details" id="details" class='form-control summernote' placeholder="{{ __('Enter Details') }}" rows="5">{!! old('details') !!}</textarea>
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="exampleInputPassword1">{{ __('Meta Keywords') }}</label>
                    <input type="text" name='meta_keywords' class='form-control tags' placeholder="{{ __('Enter Meta Keywords') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="meta_descriptions">{{ __('Meta Description') }}</label>
                    <textarea type="number" name='meta_descriptions' class='form-control' placeholder="{{ __('Enter Meta Description') }}" rows="5" id="meta_descriptions">{{ old('meta_descriptions') }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.page.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
