@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('All Products') }}</h1>
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
                  <a href="{{ route('backend.csv.transaction.export') }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-file-csv"></i> {{ __('CSV Export') }}</a>
                  <form action="{{ route('backend.bulk.delete') }}" method="GET" class="d-inline-block">
                      <input type="hidden" name="ids[]" id="bulk_delete" value="">
                      <input type="hidden" name="table" value="transactions">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __('Bulk Delete') }}</button>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th><input type="checkbox" name="" data-target="transaction-bulk-delete" class=" bulk_all_delete" id=""></th>
                    <th>{{ __('Customer Email') }}</th>
                    <th>{{ __('Transaction ID') }}</th>
                    <th>{{ __('Order Status') }}</th>
                    <th>{{ __('Payment Status') }}</th>
                    <th>{{ __('Total Amount') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @include('backend.transaction.table', compact('datas'))
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
