@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ request()->input('type') ? request()->input('type') : __('All') }}{{ __('Orders') }}</h1>
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
                <!-- form start -->
                <form action="{{ route('backend.order.index') }}" method="GEt" id="quickForm">
                  <div class="card-body row">

                    <div class="form-group col-md-3">
                        <label for="start_date">{{ __('Start Date') }} *</label>
                          <div class="input-group date date-picker" data-target-input="nearest">
                              <input type="text" name="start_date" class="form-control datetimepicker-input" data-target=".date-picker" value="{{ request()->input('start_date') }}" required/>
                              <div class="input-group-append" data-target=".date-picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="end_date">{{ __('End Date') }} *</label>
                          <div class="input-group date date-picker1" data-target-input="nearest">
                              <input type="text" name="end_date" class="form-control datetimepicker-input" data-target=".date-picker1" value="{{ request()->input('end_date') }}" required/>
                              <div class="input-group-append" data-target=".date-picker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group  col-md-3 p-2">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Filter') }}</button>
                        @if (count(request()->all()))

                        <a href="{{ route('backend.order.index') }}" class="btn btn-info mt-4">{{ __('Reset') }}</a>
                        @endif
                    </div>

                  </div>

                </form>
              </div>
              <!-- /.card -->
            <div class="card">
              <div class="card-header text-right">
                <h3 class="card-title">
                    {{ __('Product Filter :') }}
                  </h3>
                  <a href="{{ route('backend.csv.order.export') }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-file-csv"></i> {{ __('CSV Export') }}</a>
                  <form action="{{ route('backend.bulk.delete') }}" method="GET" class="d-inline-block">
                      <input type="hidden" name="ids[]" id="bulk_delete" value="">
                      <input type="hidden" name="table" value="orders">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __('Bulk Delete') }}</button>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th><input type="checkbox" name="" data-target="product-bulk-delete" class=" bulk_all_delete" id=""></th>
                    <th>{{ __('Order ID') }}</th>
                    <th>{{ __('Total Amount') }}</th>
                    <th>{{ __('Payment Status') }}</th>
                    <th>{{ __('Order Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @include('backend.order.table', compact('datas'))
                  </tbody>
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
