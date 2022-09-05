
@foreach ($datas as $data)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>
        <img src="{{ $data->photo ? asset($data->photo) : asset('backend/images/placeholder.png') }}" alt="Image Not Found">
    </td>
    <td>
        @if ($data->home_page != 'theme4')
            {{ $data->title }}
        @else
            --
        @endif
    </td>
    <td>{{ strtoupper($data->home_page) }}</td>
    <td>
        @if ($data->home_page != 'theme4')
            {{ strlen(strip_tags($data->details)) > 250 ? substr(strip_tags($data->details), 0, 250) . '...' : strip_tags($data->details) }}
        @else
            --
        @endif
    </td>
    <td>
        <div class="btn-group">
            <a class="btn btn-info btn-sm mr-1"
                href="{{ route('backend.slider.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm delete-record"
                data-title="{{ __('Confirm Delete?') }}"
                data-text="{{ __('You are going to delete this slider. All contents related with this slider will be lost.') }} {{ __('Do you want to delete it?') }}"
                data-cancel_btn="{{ __('Cancel') }}"
                data-ok_btn="{{ __('Delete') }}"
                data-href="{{ route('backend.slider.destroy', $data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
