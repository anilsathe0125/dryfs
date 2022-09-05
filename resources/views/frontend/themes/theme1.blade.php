@extends('frontend.layouts.frontend')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('title')
    {{ __('Home') }}
@endsection
@section('content')
    @php
    function renderStarRating($rating, $maxRating = 5)
    {
        $fullStar = "<i class='far fa-star filled'></i>";
        $halfStar = "<i class='far fa-star-half filled'></i>";
        $emptyStar = "<i class='far fa-star'></i>";
        $rating = $rating <= $maxRating ? $rating : $maxRating;

        $fullStarCount = (int) $rating;
        $halfStarCount = ceil($rating) - $fullStarCount;
        $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

        $html = str_repeat($fullStar, $fullStarCount);
        $html .= str_repeat($halfStar, $halfStarCount);
        $html .= str_repeat($emptyStar, $emptyStarCount);
        return $html;
    }
    @endphp

    @if ($setting->is_slider == 1)
        <div class="slider-area-wrapper">
            <div class="container">
                <div class="row g-3">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-9">
                        <!-- Main Slider-->
                        <div class="hero-slider">
                            <div class="hero-slider-main owl-carousel dots-inside">
                                @foreach ($sliders as $slider)
                                    <div class="item
                            @if (DB::table('languages')->where('is_default', 1)->first()->rtl == 1) d-flex justify-content-end @endif
                            "
                                        style="background: url('{{ asset($slider->photo) }}')">
                                        <div class="item-inner">
                                            <div class="from-bottom">
                                                @if ($slider->logo)
                                                    <img class="d-inline-block brand-logo"
                                                        src="{{ asset($slider->logo) }}" alt="logo">
                                                @endif
                                                <div class="title text-body">{{ $slider->title }}</div>
                                                <div class="subtitle text-body mb-4">{{ $slider->details }}</div>
                                            </div>
                                            <a class="btn btn-primary btn-sm scale-up delay-1"
                                                href="{{ $slider->link }}">{{ __('View Offers') }}
                                                <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($setting->is_three_c_b_first == 1)
        <div class="bannner-section mt-30">
            <div class="container ">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ $banner_first['firsturl1'] }}" class="genius-banner">
                            <img src="{{ asset($banner_first['img1']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ $banner_first['firsturl2'] }}" class="genius-banner">
                            <img src="{{ asset($banner_first['img2']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ $banner_first['firsturl3'] }}" class="genius-banner">
                            <img src="{{ asset($banner_first['img3']) }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($setting->is_popular_category == 1)
        <section class="newproduct-section mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="h3">{{ $popular_category_title }}</h2>
                            <div class="links">
                                @foreach ($popular_categories as $key => $popular_categorie)
                                    <a class="category_get {{ $loop->first ? 'active' : '' }}"
                                        data-target="popular_category_view"
                                        data-href="{{ route('frontend.popular.category', [$popular_categorie->slug, 'popular_category', 'slider']) }}"
                                        href="javascript:;"
                                        class="{{ $loop->first ? 'active' : '' }}">{{ $popular_categorie->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popular_category_view d-none">
                    <img src="{{ asset('frontend/images/ajax_loader.gif') }}" alt="">
                </div>

                <div class="row" id="popular_category_view">
                    <div class="col-lg-12">
                        <div class="popular-category-slider  owl-carousel">
                            @foreach ($popular_category_items as $popular_category_item)
                                <div class="slider-item">
                                    <div class="product-card">
                                        <a class="product-thumb"
                                            href="{{ route('frontend.product', $popular_category_item->slug) }}">

                                            @if (!$popular_category_item->is_stock())
                                                <div
                                                    class="product-badge bg-secondary border-default text-body
                                    ">
                                                    {{ __('out of stock') }}</div>
                                            @endif
                                            @if ($popular_category_item->previous_price && $popular_category_item->previous_price != 0)
                                                <div class="product-badge product-badge2 bg-info">
                                                    -{{ PriceHelper::DiscountPercentage($popular_category_item) }}</div>
                                            @endif
                                            <img class="lazy" src="{{ $setting->loader ? asset($setting->loader) : asset('frontend/images/ajax_loader.gif')}}"
                                                data-src="{{ asset($popular_category_item->thumbnail) }}"
                                                alt="Product">
                                        </a>
                                        <div class="product-card-body">
                                            <div class="product-category"><a
                                                    href="{{ route('frontend.catalog') . '?category=' . $popular_category_item->category->slug }}">{{ $popular_category_item->category->name }}</a>
                                            </div>
                                            <h3 class="product-title"><a
                                                    href="{{ route('frontend.product', $popular_category_item->slug) }}">
                                                    {{ strlen(strip_tags($popular_category_item->name)) > 35? substr(strip_tags($popular_category_item->name), 0, 35): strip_tags($popular_category_item->name) }}
                                                </a></h3>
                                            <div class="rating-stars">
                                                <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i
                                                    class="far fa-star filled"></i><i class="far fa-star filled"></i><i
                                                    class="far fa-star filled"></i>
                                            </div>
                                            <h4 class="product-price">
                                                @if ($popular_category_item->previous_price != 0)
                                                    <del>{{ PriceHelper::setPreviousPrice($popular_category_item->previous_price) }}</del>
                                                @endif

                                                {{ PriceHelper::grandCurrencyPrice($popular_category_item) }}
                                            </h4>
                                        </div>

                                        <div class="product-button-group">
                                            @if ($popular_category_item->is_stock())
                                                <a class="product-button add_to_single_cart" data-target="{{ $popular_category_item->id }}" href="javascript:;">
                                                    <i class="icon-shopping-cart"></i><span>{{ __('To Cart') }}</span>
                                                </a>
                                            @else
                                                <a class="product-button" href="{{ route('frontend.product', $popular_category_item->slug) }}"><i class="icon-arrow-right"></i><span>{{ __('Details') }}</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

@endsection
