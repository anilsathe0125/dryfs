@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Coupon') }}</h1>
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
              <form action="{{ route('backend.code.update', $code->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>

                  <div class="form-group  col-md-12">
                    <label for="title">{{ __('Title') }} *</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ $code->title }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="code_name">{{ __('Code') }} *</label>
                    <input type="text" name="code_name" class="form-control " id="code_name" placeholder="{{ __('Enter Code') }}" value="{{ $code->code_name }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="no_of_times">{{ __('Number of Times') }} *</label>
                    <input type="number" name="no_of_times" class="form-control " min="1" id="no_of_times" placeholder="{{ __('Enter Number of Times') }}" value="{{ $code->no_of_times }}">
                  </div>

                  <div class="form-group  col-md-3">
                    <label for="type">{{ __('Discount Type') }} *</label>
                    <select name="type" id="type" class="form-control select2">
                        <option value="percentage" {{ $code->type == 'percentage' ? 'selected' : '' }} >{{ __('Percentage') }} (%)</option>
                        <option value="amount" {{ $code->type == 'amount' ? 'selected' : '' }} >{{ __('Ammount') }} ({{ PriceHelper::adminCurrency() }})</option>
                    </select>
                  </div>

                  <div class="form-group  col-md-9">
                    <label for="discount">{{ __('Discount') }} *</label>
                    <input type="number" name="discount" class="form-control " min="0" step="0.1" id="discount" placeholder="{{ __('Enter Discount') }}" value="{{ $code->discount }}">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.code.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
