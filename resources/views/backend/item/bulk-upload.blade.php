@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Product CSV Import & Export') }}</h1>
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
                <!-- /.card-header -->
                <div class="card-header ">
                    <a href="{{ route('backend.csv.export') }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-file-csv"></i> {{ __('Products CSV Export') }}</a>
                    <a href="{{ asset('backend/test_csv_file.csv') }}" download="" type="button" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> {{ __('Sample CSV Download') }}</a>
                </div>
                <!-- form start -->
                <form action="{{ route('backend.csv.import') }}" method="POST" enctype="multipart/form-data" id="quickForm">
                @csrf
                <input type="hidden" name="itema_type" value="normal">
                  <div class="card-body row">

                    <div class="form-group col-md-6">
                        <label for="file">{{ __('Upload Your CSV File') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="csv" class="custom-file-input upload-photo" id="file" aria-label="File browser" accept="csv">
                              <label class="custom-file-label" for="exampleInputFile">{{ __('Browse CSV File') }}</label>
                            </div>
                          </div>
                      </div>

                    <div class="form-group  col-md-3 p-2">
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Submit') }}</button>
                    </div>

                  </div>

                </form>
              </div>


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
