@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Customers Details') }}</h1>
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
                    <a href="{{ route('backend.user.index') }}" type="button" class="btn btn-danger btn-sm"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  </div>
              <form action="{{ route('backend.user.update', $user->id) }}" method="POST" class="card-body">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <table id="admin-table" class="table table-bordered">
                  <tr>
                    <th>{{ __('First Name') }}</th>
                    <td>
                        <input type="text" name="first_name" class="form-control item-name" id="first_name" value="{{ $user->first_name }}">
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Last Name') }}</th>
                    <td>
                        <input type="text" name="last_name" class="form-control item-name" id="first_name" value="{{ $user->last_name }}">
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Email Address') }}</th>
                    <td>
                        <input type="text" name="email" class="form-control item-name" id="email" value="{{ $user->email }}">
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Phone Number') }}</th>
                    <td>
                        <input type="text" name="phone" class="form-control item-name" id="phone" value="{{ $user->phone }}">
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Password') }}</th>
                    <td>
                        <input type="password" name="password" class="form-control item-name" id="password" placeholder="{{ __('Password') }}">
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Total Orders') }}</th>
                    <td>{{ count($user->orders) }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Joined') }}</th>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                  </tr>
                </table>
                <button type="submit" class="btn btn-primary mt-2">{{ __('Submit') }}</button>
              </form>
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
