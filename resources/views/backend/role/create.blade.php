@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Create Role') }}</h1>
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
              <form action="{{ route('backend.role.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                  <div class="col-md-12">
                    @include('alerts.alerts')
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="name">{{ __('Name') }} *</label>
                    <input type="text" name="name" class="form-control " id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_categories" value="Manage Categories">
                        <label class="custom-control-label" for="manage_categories">{{ __('Manage Categories') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_products" value="Manage Products">
                        <label class="custom-control-label" for="manage_products">{{ __('Manage Products') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_orders" value="Manage Orders">
                        <label class="custom-control-label" for="manage_orders">{{ __('Manage Orders') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="transactions" value="Transactions">
                        <label class="custom-control-label" for="transactions">{{ __('Manage Transactions') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="ecommerce" value="Ecommerce">
                        <label class="custom-control-label" for="ecommerce">{{ __('Manage Ecommerce') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="customer_list" value="Customer List">
                        <label class="custom-control-label" for="customer_list">{{ __('Manage Customer List') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manages_tickets" value="Manage Tickets">
                        <label class="custom-control-label" for="manages_tickets">{{ __('Manage Tickets') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_site" value="Manage Site">
                        <label class="custom-control-label" for="manage_site">{{ __('Manage Site') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_blogs" value="Manage Blogs">
                        <label class="custom-control-label" for="manage_blogs">{{ __('Manage Blogs') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="subscribers_list" value="Subscribers List">
                        <label class="custom-control-label" for="subscribers_list">{{ __('Manage Subscribers List') }}</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="section[]" class="custom-control-input" id="manage_system_user" value="Manage System User">
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
