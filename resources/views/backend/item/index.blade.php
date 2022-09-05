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
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('backend.item.index') }}" id="quickForm">
                  <div class="card-header">
                    <h3 class="card-title">
                      {{ __('Product Filter :') }}
                    </h3>
                  </div>
                  <div class="card-body row">

                    <div class="form-group  col-md-3">
                        <select name="item_type"  class="form-control select2">
                            <option value="">{{ __('All Product') }}</option>
                            <option value="normal" {{ request()->input('item_type') == 'normal' ? 'selected' : '' }}>{{ __('Physical Product') }}</option>
                            <option value="digital" {{ request()->input('item_type') == 'digital' ? 'selected' : '' }}>{{ __('Digital Product') }}</option>
                            <option value="license" {{ request()->input('item_type') == 'license' ? 'selected' : '' }}>{{ __('License Product') }}</option>
                        </select>
                    </div>

                    <div class="form-group  col-md-3">
                        <select name="is_type"  class="form-control select2">
                            <option disabled>{{ __('Select Type') }}</option>
                            <option value="">{{ __('All Type') }}</option>
                            <option value="new" {{ request()->input('is_type') == 'new' ? 'selected' : '' }}>{{ __('Undefine Product') }}</option>
                            <option value="flash_deal" {{ request()->input('is_type') == 'flash_deal' ? 'selected' : '' }}>{{ __('Flash Deal Product') }}</option>
                            <option value="feature" {{ request()->input('is_type') == 'feature' ? 'selected' : '' }}>{{ __('Featured Product') }}</option>
                            <option value="best" {{ request()->input('is_type') == 'best' ? 'selected' : '' }}>{{ __('Best Product') }}</option>
                            <option value="top" {{ request()->input('is_type') == 'top' ? 'selected' : '' }}>{{ __('Top Product') }}</option>
                        </select>
                    </div>

                    <div class="form-group  col-md-3">
                        <select name="category_id"  class="form-control select2">
                            <option disabled>{{ __('Select Category') }}</option>
                            <option value="">{{ __('All Category') }}</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request()->input('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group  col-md-3">
                        <select name="orderby"  class="form-control select2">
                            <option disabled>{{ __('Select Order') }}</option>
                            <option value="asc" {{ request()->input('orderby') == 'asc' ? 'selected' : '' }}>{{__('Ascending order')}}</option>
                            <option value="desc" {{ request()->input('orderby') == 'desc' ? 'selected' : '' }}>{{__('Descending order')}}</option>
                        </select>
                    </div>

                    <div class="form-group  col-md-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> {{ __('Filter Product') }}</button>
                    </div>

                  </div>

                </form>
              </div>
              <!-- /.card -->
            <div class="card">
              <div class="card-header text-right">
                  <a href="{{ route('backend.csv.export') }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-file-csv"></i> {{ __('CSV Export') }}</a>
                  <form action="{{ route('backend.bulk.delete') }}" method="GET" class="d-inline-block">
                      <input type="hidden" name="ids[]" id="bulk_delete" value="">
                      <input type="hidden" name="table" value="items">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __('Bulk Delete') }}</button>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th><input type="checkbox" name="" data-target="product-bulk-delete" class=" bulk_all_delete" id=""></th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Item Type') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @include('backend.item.table', compact('datas'))
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
