@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Update Role') }}</h1>
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
              <form action="{{ route('backend.role.update', $role->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                  <div class="col-md-12">
                    @include('alerts.alerts')
                  </div>
                  @php
                  if ($role->section != 'null'){
                      $section = json_decode($role->section, true);
                  }else{
                      $section = [];
                  }
                  @endphp
                  <div class="form-group  col-md-12">
                    <label for="name">{{ __('Name') }} *</label>
                    <input type="text" name="name" class="form-control " id="name" placeholder="{{ __('Enter Name') }}" value="{{ $role->name }}">
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_categories" value="Manage Categories" {{ in_array('Manage Categories', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="manage_categories">{{ __('Manage Categories') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_products" value="Manage Products" {{ in_array('Manage Products', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="manage_products">{{ __('Manage Products') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_orders" value="Manage Orders" {{ in_array('Manage Orders', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="manage_orders">{{ __('Manage Orders') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="transactions" value="Transactions" {{ in_array('Transactions', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="transactions">{{ __('Manage Transactions') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="ecommerce" value="Ecommerce" {{ in_array('Ecommerce', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="ecommerce">{{ __('Manage Ecommerce') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="customer_list" value="Customer List" {{ in_array('Customer List', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customer_list">{{ __('Manage Customer List') }}</label>
                    </div>
                  </div>


                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_site" value="Manage Site" {{ in_array('Manage Site', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="manage_site">{{ __('Manage Site') }}</label>
                    </div>
                  </div>


                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_system_user" value="Manage System User" {{ in_array('Manage System User', $section) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="manage_system_user">{{ __('Manage System User') }}</label>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.role.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
