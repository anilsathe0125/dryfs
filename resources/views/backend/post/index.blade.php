@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Manage Blogs') }}</h1>
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
              <!-- /.card -->
            <div class="card">
              <div class="card-header text-right">
                <a href="{{ route('backend.post.create') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Add') }}</a>
                <form action="{{ route('backend.bulk.delete') }}" method="GET" class="d-inline-block">
                      <input type="hidden" name="ids[]" id="bulk_delete" value="">
                      <input type="hidden" name="table" value="posts">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __('Bulk Delete') }}</button>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th><input type="checkbox" name="" data-target="blog-bulk-delete" class=" bulk_all_delete" id=""></th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @include('backend.post.table', compact('datas'))
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
