
@foreach ($datas as $data)
    <tr id="blog-bulk-delete">
        <td>
            <input type="checkbox" name="" class="bulk-item" value="{{ $data->id }}">
        </td>
        <td>
            <img src="{{ isset(json_decode($data->photo, true)[array_key_first(json_decode($data->photo, true))]) ? asset(json_decode($data->photo, true)[array_key_first(json_decode($data->photo, true))]) : asset('backend/images/placeholder.png') }}" alt="Image Not Found">
        </td>
        <td>{{ $data->title }}</td>
        <td>{{ $data->category->name }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-info btn-sm mr-1"
                    href="{{ route('backend.post.edit',$data->id) }}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                    data-title="{{ __('Confirm Delete?') }}"
                    data-text="{{ __('You are going to delete this post. All contents related with this post will be lost.') }} {{ __('Do you want to delete it?') }}"
                    data-cancel_btn="{{ __('Cancel') }}"
                    data-ok_btn="{{ __('Delete') }}"
                    data-href="{{ route('backend.post.destroy', $data->id) }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
