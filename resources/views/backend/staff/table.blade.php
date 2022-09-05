
@foreach ($datas as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <img src="{{ $data->photo ? asset($data->photo) : asset('backend/images/placeholder.png') }}" alt="Image Not Found">
        </td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->role->name }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ $data->phone }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-info btn-sm mr-1"
                    href="{{ route('backend.staff.edit', $data->id) }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                    data-title="{{ __('Confirm Delete?') }}"
                    data-text="{{ __('You are going to delete this system user. All contents related with this system user will be lost.') }} {{ __('Do you want to delete it?') }}"
                    data-cancel_btn="{{ __('Cancel') }}"
                    data-ok_btn="{{ __('Delete') }}"
                    data-href="{{ route('backend.staff.destroy', $data->id) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
