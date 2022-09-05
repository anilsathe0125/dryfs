
@foreach ($datas as $data)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $data->title }}</td>
    <td>{{ strlen(strip_tags($data->details)) > 250 ? substr(strip_tags($data->details), 0, 250) . '...' : strip_tags($data->details) }}</td>
    <td>
        <div class="input-group-prepend">
            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
              {{ $data->pos == 2 ? __('Both') : ( $data->pos == 0 ? __('Header') : __('Footer') ) }}
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route("backend.page.pos", [$data->id, 2]) }}">{{ __('Both') }}</a>
              <a class="dropdown-item" href="{{ route("backend.page.pos", [$data->id, 0]) }}">{{ __('Header') }}</a>
              <a class="dropdown-item" href="{{ route("backend.page.pos", [$data->id, 1]) }}">{{ __('Footer') }}</a>
            </div>
        </div>
    </td>
    <td>
        <div class="btn-group">
            <a class="btn btn-info btn-sm mr-1"
                href="{{ route('backend.page.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                data-title="{{ __('Confirm Delete?') }}"
                data-text="{{ __('You are going to delete this page. All contents related with this page will be lost.') }} {{ __('Do you want to delete it?') }}"
                data-cancel_btn="{{ __('Cancel') }}"
                data-ok_btn="{{ __('Delete') }}"
                data-href="{{ route('backend.page.destroy', $data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
