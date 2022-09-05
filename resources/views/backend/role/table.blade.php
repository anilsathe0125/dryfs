
@foreach ($datas as $data)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $data->name }}</td>
    <td>
        @if ($data->section != 'null')
            @foreach (json_decode($data->section, true) as $item)
                <span class="badge badge-primary m-1 p-2">{{ $item }}</span>
            @endforeach
        @else
            {{ __('--') }}
        @endif
    </td>
    <td>
        <div class="btn-group">
            <a class="btn btn-info btn-sm mr-1"
                href="{{ route('backend.role.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                data-title="{{ __('Confirm Delete?') }}"
                data-text="{{ __('You are going to delete this Role. All contents related with this Role will be lost.') }} {{ __('Do you want to delete it?') }}"
                data-cancel_btn="{{ __('Cancel') }}"
                data-ok_btn="{{ __('Delete') }}"
                data-href="{{ route('backend.role.destroy', $data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
