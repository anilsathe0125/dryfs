@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Create FAQ') }}</h1>
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
              <form action="{{ route('backend.faq.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>

                    <div class="form-group  col-md-12">
                      <label for="title">{{ __('Title') }} *</label>
                      <input type="text" name="title" class="form-control " id="title" placeholder="{{ __('Enter Title') }}" required value="{{ old('title') }}">
                    </div>

                  <div class="form-group  col-md-12">
                    <label for="category_id">{{ __('Select Category') }} *</label>
                    <select name="category_id" id="category_id" class="form-control select2" required>
                        <option value="" selected disabled>{{ __('Select Category') }}</option>
                        @foreach ($fcategories as $fcat)
                            <option value="{{ $fcat->id }}" {{ old('category_id') && old('category_id') == $fcat->id ? 'selected' : '' }}>{{ $fcat->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="details">{{ __('Details') }} *</label>
                    <textarea name="details" class="form-control " id="details" placeholder="{{ __('Enter Details') }}" rows="5" required>{{ old('details') }}</textarea>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.faq.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  <button type="submit" class="btn btn-primary"> {{ __('Submit') }}</button>
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
