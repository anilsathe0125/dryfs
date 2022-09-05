@foreach ($datas as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ $data->phone }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-info btn-sm mr-1"
                    href="{{ route('backend.user.show',$data->id) }}">
                    <i class="fas fa-eye"></i>
                </a>
                <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                    data-title="{{ __('Confirm Delete?') }}"
                    data-text="{{ __('You are going to delete this Customer. All contents related with this Customer will be lost.') }} {{ __('Do you want to delete it?') }}"
                    data-cancel_btn="{{ __('Cancel') }}"
                    data-ok_btn="{{ __('Delete') }}"
                    data-href="{{ route('backend.user.destroy', $data->id) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
