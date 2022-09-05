
@foreach ($datas as $data)
<tr id="transaction-bulk-delete">
    <td>
        <input type="checkbox" name="" class="bulk-item" value="{{ $data->id }}">
    </td>
    <td>
        @if (!$data->user->id)
            {{ $data->user_email }}
        @else
            <a href="{{ route('backend.user.show', $data->user->id) }}">{{ $data->user_email }}</a>
        @endif
    </td>
    <td>
        <a href="{{ route('backend.order.invoice', $data->order->id) }}">{{ $data->txn_id }}</a>
    </td>
    <td>
        <span class="badge badge-dark">{{ $data->order->order_status }}</span>
    </td>
    <td>
        <span class="badge badge-primary">{{ $data->order->payment_status }}</span>
    </td>
    <td>
        @if ($setting->currency_direction == 1)
            {{ $data->currency_sign }}{{ round($data->amount * $data->currency_value, 2) }}
        @else
            {{ round($data->amount * $data->currency_value, 2) }}{{ $data->currency_sign }}
        @endif
    </td>
    <td>
        <div class="btn-group">
            <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                data-title="{{ __('Confirm Delete?') }}"
                data-text="{{ __('You are going to delete this Transaction. All contents related with this Transaction will be lost.') }} {{ __('Do you want to delete it?') }}"
                data-cancel_btn="{{ __('Cancel') }}"
                data-ok_btn="{{ __('Delete') }}"
                data-href="{{ route('backend.transaction.delete', $data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
