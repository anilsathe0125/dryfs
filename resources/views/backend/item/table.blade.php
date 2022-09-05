@foreach ($datas as $data)
    <tr id="product-bulk-delete">
        <td>
            <input type="checkbox" name="" class="bulk-item" value="{{ $data->id }}">
        </td>
        <td>
            <img src="{{ $data->thumbnail ? asset($data->thumbnail) : asset('backend/images/placeholder.png') }}" alt="Image Not Found">
        </td>
        <td>{{ $data->name }}</td>
        <td>{{ PriceHelper::adminCurrencyPrice($data->discount_price) }}</td>
        <td>
            <div class="input-group-prepend">
                <button type="button" class="btn btn-{{ $data->status == 1 ? 'success' : 'danger' }} btn-sm dropdown-toggle" data-toggle="dropdown">
                  {{ $data->status == 1 ? __('Publish') : __('Unpublish') }}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route("backend.item.status", [$data->id, 1]) }}">{{ __('Publish') }}</a>
                  <a class="dropdown-item" href="{{ route("backend.item.status", [$data->id, 0]) }}">{{ __('Unpublish') }}</a>
                </div>
            </div>
        </td>
        <td>
            <span class="{{ $data->is_type != 'new' ? 'badge badge-info' : '' }}">
                @if ($data->is_type == 'new')
                    {{ __('Not Define') }}
                @else
                    {{ $data->is_type ? ucfirst(str_replace('_', '', $data->is_type)) : __('New') }}
                @endif
            </span>
        </td>
        <td>{{ ucfirst($data->item_type) }}</td>
        <td>
            <div class="input-group-prepend">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    {{  __('Options') }}
                </button>
                <div class="dropdown-menu">

                    @if ($data->item_type == 'normal')
                    <a class="dropdown-item" href="{{ route('backend.item.edit',$data->id) }}">
                        <i class="fas fa-angle-double-right"></i> {{ __('Edit') }}
                    </a>
                    @elseif ($data->item_type == 'digital')
                        <a class="dropdown-item" href="{{ route('backend.digital.item.edit', $data->id) }}">
                            <i class="fas fa-angle-double-right"></i> {{ __('Edit') }}
                        </a>
                    @else
                        <a class="dropdown-item" href="{{ route('backend.license.item.edit', $data->id) }}">
                            <i class="fas fa-angle-double-right"></i> {{ __('Edit') }}
                        </a>
                    @endif
                    @if ($data->status == 1)
                        <a class="dropdown-item" href="{{ route('frontend.product', $data->slug) }}" target="_blank">
                            <i class="fas fa-angle-double-right"></i> {{ __('View') }}
                        </a>
                    @endif
                    <a href="javascript:void(0)" class="dropdown-item delete-record" data-toggle="modal"
                        data-title="{{ __('Confirm Delete?') }}"
                        data-text="{{ __('You are going to delete this item. All contents related with this item will be lost.') }} {{ __('Do you want to delete it?') }}"
                        data-cancel_btn="{{ __('Cancel') }}"
                        data-ok_btn="{{ __('Delete') }}"
                        data-href="{{ route('backend.item.destroy', $data->id) }}">
                        <i class="fas fa-angle-double-right"></i> {{ __('Delete') }}
                    </a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
