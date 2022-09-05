@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Highlight Product') }}</h1>
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
              <form action="{{ route('backend.item.highlight.update', $item->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>

                  <div class="form-group  col-md-6">
                    <label for="is_type">{{ __('Select Type') }} *</label>
                    <select name="is_type" id="is_type"  class="form-control select2">
                        <option value="" disabled>{{__('Select One')}}</option>
                        <option value="new" {{$item->is_type == 'new' ? 'selected' : ''}} >{{ __('Undefine Product') }}</option>
                        <option value="feature" {{$item->is_type == 'feature' ? 'selected' : ''}} >{{ __('Feature Product') }}</option>
                        <option value="top" {{$item->is_type == 'top' ? 'selected' : ''}} >{{ __('Top Product') }}</option>
                        <option value="best" {{$item->is_type == 'best' ? 'selected' : ''}} >{{ __('Best Product') }}</option>
                        <option value="flash_deal" {{$item->is_type == 'flash_deal' ? 'selected' : ''}} >{{ __('Flash Deal Product') }}</option>
                    </select>
                  </div>

                <div class="form-group col-md-6 show-datepicket {{ $item->is_type =='flash_deal' ? '' : 'd-none'}} ">
                    <label for="date">{{ __('Enter Date') }} *</label>
                      <div class="input-group date date-picker" data-target-input="nearest">
                          <input type="text" name="date" class="form-control  flash-deal-datepicker datetimepicker-input" data-target=".date-picker" value="{{ $item->date }}"/>
                          <div class="input-group-append" data-target=".date-picker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.item.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
