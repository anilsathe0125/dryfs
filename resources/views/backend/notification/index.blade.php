@if (App\Models\Notification::count() > 0)
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ App\Models\Notification::count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ App\Models\Notification::count() }} {{ __('Notifications') }} <a href="javascript:void(0)" id="clear-notification" data-href="{{ route('backend.notifications.clear') }}" class="float-right text-danger">{{ __('Clear All') }}</a></span>
        @foreach (App\Models\Notification::orderBy('id', 'desc')->get() as $notification)
            @if (!is_null($notification->user_id))
                <div class="dropdown-divider"></div>
                <a href="{{ route('backend.user.show', $notification->user_id) }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> {{ __('A new user has registered.') }}
                    <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @endif
            @if (!is_null($notification->order_id))
                <div class="dropdown-divider"></div>
                <a href="{{ route('backend.order.invoice', $notification->order_id) }}" class="dropdown-item">
                    <i class="fas fa-donate mr-2"></i> {{ __('You have recieved a new order.') }}
                    <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @endif
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="{{ route('backend.view.notification') }}" class="dropdown-item dropdown-footer">{{__('View All')}}</a>
    </div>
@else
<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">{{ __('0') }}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">{{ __('Notifications') }} </span>
    <a href="javascript:void(0)" class="dropdown-item dropdown-footer">{{ __('No Notifications') }}</a>
</div>
@endif
