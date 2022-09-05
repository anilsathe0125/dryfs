@php
$categories = App\Models\Category::whereStatus(1)
    ->orderby('serial', 'asc')
    ->take(8)
    ->get();
@endphp


<div class="widget-categories mobile-cat">
    <ul id="category_list">
        @foreach ($categories as $getcategory)
            <li class="has-children">
                <a class="category_search"
                    href="{{ route('frontend.catalog') . '?category=' . $getcategory->slug }}">{{ $getcategory->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
