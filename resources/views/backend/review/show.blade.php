@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Review Details') }}</h1>
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
                <div class="card-header text-right">
                    <a href="{{ route('backend.review.index') }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  </div>
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <tr>
                    <th>{{ __('First Name') }}</th>
                    <td>{{ $review->user->first_name }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Last Name') }}</th>
                    <td>{{ $review->user->last_name }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Email Address') }}</th>
                    <td>{{ $review->user->email }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Phone Number') }}</th>
                    <td>{{ $review->user->phone }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Country Name') }}</th>
                    <td>{{ $review->user->ship_country }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Rating') }}</th>
                    <td>{{ $review->rating }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Review') }}</th>
                    <td>{{ $review->review }}</td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
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
