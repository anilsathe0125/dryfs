@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Template') }}</h1>
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
              <form action="{{ route('backend.template.update', $template->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('BB Code') }}</th>
                                    <th>{{ __('Meaning') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{user_name}</td>
                                    <td>{{ __('Name of the customer') }}</td>
                                </tr>
                                <tr>
                                    <td>{order_cost}</td>
                                    <td>{{ __('Order Cost') }}</td>
                                </tr>
                                <tr>
                                    <td>{site_title}</td>
                                    <td>{{ __('Site Title') }}</td>
                                </tr>
                                <tr>
                                    <td>{transaction_number}</td>
                                    <td>{{ __('Order Transaction Number') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group  col-md-12">
                          <label for="subject">{{ __('Subject') }} *</label>
                          <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('Enter Subject') }}" value="{{ $template->subject }}" >
                        </div>

                        <div class="form-group  col-md-12">
                          <label for="body">{{ __('Body') }} *</label>
                          <textarea name='body' class='form-control summernote' placeholder="{{ __('Enter Email Body') }}" rows="5" >{{ $template->body }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <a href="{{ route("backend.setting.email") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
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
