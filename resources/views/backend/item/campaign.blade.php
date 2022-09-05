@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Campaign Offer') }}</h1>
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
                <form action="{{ route('backend.setting.update') }}" method="POST" id="quickForm">
                @csrf
                  <div class="card-body row">

                    <div class="form-group  col-md-3">
                        <label for="campaign_title">{{ __('Campaign Title') }} *</label>
                        <input type="text" name="campaign_title" class="form-control item-name" id="campaign_title" placeholder="{{ __('Campaign Section Title') }}" value="{{ $setting->campaign_title }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campaign_end_date">{{ __('Campaign Last Date Time') }} *</label>
                          <div class="input-group date date-picker" data-target-input="nearest">
                              <input type="text" name="campaign_end_date" class="form-control datetimepicker-input" data-target=".date-picker" value="{{ $setting->campaign_end_date }}"/>
                              <div class="input-group-append" data-target=".date-picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group  col-md-3">
                        <label for="campaign_status">{{ __('Status') }} </label>
                        <select name="campaign_status" id="campaign_status"  class="form-control select2">
                            <option value="1" {{ $setting->campaign_status == 1 ? 'selected' : '' }}>{{ __('Publish') }}</option>
                            <option value="2" {{ $setting->campaign_status == 2 ? 'selected' : '' }}>{{ __('Unpublish') }}</option>

                        </select>
                    </div>

                    <div class="form-group  col-md-3 p-2">
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                    </div>

                  </div>

                </form>
              </div>
              <div class="card">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('backend.campaign.store') }}" method="POST" id="quickForm">
                @csrf
                  <div class="card-body row">

                    <div class="form-group  col-md-6">
                        <label for="item_id">{{ __('Select Product') }} </label>
                        <select name="item_id" id="item_id"  class="form-control select2">
                            <option value="" disabled selected>{{__('Select Product')}}</option>
                            @foreach ($datas as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group  col-md-3 p-2">
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Add To Campaign') }}</button>
                    </div>

                  </div>

                </form>
              </div>
              <!-- /.card -->
            <div class="card">
              <div class="card-header text-right">
                <h4 class="card-title">{{__('Product Added for Campaign')}}</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Show Home Page') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($items->count() > 0)
                        @foreach ($items as $data)
                            <tr>
                                <td>
                                   <img src="{{ $data->item->photo ? asset($data->item->photo) : asset('backend/images/placeholder.png') }}" alt="Image Not Found">
                                </td>
                                <td>{{ $data->item->name }}</td>
                                <td>{{ PriceHelper::adminCurrencyPrice($data->item->discount_price) }}</td>
                                <td>
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-{{ $data->status == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle" data-toggle="dropdown">
                                          {{ $data->status == 1 ? __('Publish') : __('Unpublish') }}
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="{{ route("backend.campaign.status", [$data->id, 1, 'status']) }}">{{ __('Publish') }}</a>
                                          <a class="dropdown-item" href="{{ route("backend.campaign.status", [$data->id, 0, 'status']) }}">{{ __('Unpublish') }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-{{ $data->is_feature == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle" data-toggle="dropdown">
                                          {{ $data->is_feature == 1 ? __('Active') : __('Deactive') }}
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="{{ route("backend.campaign.status", [$data->id, 1, 'is_feature']) }}">{{ __('Active') }}</a>
                                          <a class="dropdown-item" href="{{ route("backend.campaign.status", [$data->id, 0, 'is_feature']) }}">{{ __('Deactivate') }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                                        data-title="{{ __('Confirm Delete?') }}"
                                        data-text="{{ __('You are going to delete this campaign. All contents related with this campaign will be lost.') }} {{ __('Do you want to delete it?') }}"
                                        data-cancel_btn="{{ __('Cancel') }}"
                                        data-ok_btn="{{ __('Delete') }}"
                                        data-href="{{ route('backend.campaign.destroy', $data->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
