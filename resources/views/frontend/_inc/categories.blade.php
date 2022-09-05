@php
$categories = App\Models\Category::whereStatus(1)
    ->orderby('serial', 'asc')
    ->take(8)
    ->get();
@endphp


<div class="left-category-area">
    <div class="category-header">
        <h4><i class="icon-align-left"></i> {{ __('Categories') }}</h4>
    </div>
    <div
        class="category-list {{ request()->routeIs('frontend.index') && $setting->theme == 'theme1' ? 'active' : '' }}">
        @foreach ($categories as $key => $pcategory)
            <div class="c-item">
                <a class="d-block navi-link" href="{{ route('frontend.catalog') . '?category=' . $pcategory->slug }}">
                    <img class="lazy" src="{{ $setting->loader ? asset($setting->loader) : asset('frontend/images/ajax_loader.gif')}}" data-src="{{ asset($pcategory->photo) }}">
                    <span class="text-gray-dark">{{ $pcategory->name }}</span>

                </a>
            </div>
        @endforeach
        <a href="{{ route('frontend.catalog') }}" class="d-block navi-link view-all-category">
            <img class="lazy" src="{{ $setting->loader ? asset($setting->loader) : asset('frontend/images/ajax_loader.gif')}}" data-src="{{ asset('frontend/images/category.jpg') }}" alt="">
            <span class="text-gray-dark">{{ __('All Categories') }}</span>
        </a>
    </div>


</div>
