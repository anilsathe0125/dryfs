@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Notifications List') }}</h1>
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
                <a href="javascript:void(0)" id="clear-notification" data-href="{{ route('backend.notifications.clear') }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ __('Clear All') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="admin-table" class="table table-striped">
                  <thead>
                  <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('Notification') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse (App\Models\Notification::orderBy('id', 'desc')->get() as $notification)
                      <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            @if (!is_null($notification->order_id))
                                <td>
                                    <a href="{{ route('backend.order.invoice', $notification->order_id) }}">
                                        <i class="fas fa-donate mr-2 text-info"></i> {{ __('You have recieved a new order.') }}
                                    </a>
                                </td>
                            @endif
                            @if (!is_null($notification->user_id))
                                <td>
                                    <a href="{{ route('backend.user.show', $notification->user_id) }}">
                                        <i class="fas fa-user mr-2 text-info"></i> {{ __('A new user has registered.') }}
                                    </a>
                                </td>
                            @endif
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                                        data-title="{{ __('Confirm Delete?') }}"
                                        data-text="{{ __('Are you sure!') }} {{ __('Do you want to delete it?') }}"
                                        data-cancel_btn="{{ __('Cancel') }}"
                                        data-ok_btn="{{ __('Delete') }}"
                                        data-href="{{ route('backend.notification.delete', $notification->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                      </tr>
                      @empty
                      <tr class="text-center text-info">
                          <td colspan="5">
                            <h5>{{ __('No Notifications.') }}</h5>
                          </td>
                      </tr>
                      @endforelse
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
