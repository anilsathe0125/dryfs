
@foreach ($datas as $data)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $data->title }}</td>
    <td>{{ $data->category->name }}</td>
    <td>
        <details>
            <summary class="text-info">{{ __('View Details') }}</i></summary>
            <p>
                {{ $data->details }}</td>
            </p>
        </details>
    <td>
        <div class="btn-group">
            <a class="btn btn-info btn-sm mr-1"
                href="{{ route('backend.faq.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                data-title="{{ __('Confirm Delete?') }}"
                data-text="{{ __('You are going to delete this FAQ. All contents related with this FAQ will be lost.') }} {{ __('Do you want to delete it?') }}"
                data-cancel_btn="{{ __('Cancel') }}"
                data-ok_btn="{{ __('Delete') }}"
                data-href="{{ route('backend.faq.destroy', $data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
