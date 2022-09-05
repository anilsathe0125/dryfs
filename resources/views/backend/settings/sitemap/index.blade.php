@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Sitemap') }}</h1>
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
                <a href="{{ route('backend.sitemap.add') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ __('Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('File Name') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->sitemap_url }}</td>
                            <td>{{ $data->filename }}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('backend.sitemap.download') }}">
                                        <button type="submit" class="btn btn-info btn-sm mr-1">
                                            <i class="fas fa-arrow-alt-circle-down"></i> {{ __('Download') }}
                                        </button>
                                    </form>
                                    <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                                        data-title="{{ __('Confirm Delete?') }}"
                                        data-text="{{ __('You are going to delete this sitemap. All contents related with this sitemap will be lost.') }} {{ __('Do you want to delete it?') }}"
                                        data-cancel_btn="{{ __('Cancel') }}"
                                        data-ok_btn="{{ __('Delete') }}"
                                        data-href="{{ route('backend.sitemap.delete', $data->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                      @endforeach
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
