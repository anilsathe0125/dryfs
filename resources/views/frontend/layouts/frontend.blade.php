<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $setting->title }} -@yield('title')</title>
    <!-- SEO Meta Tags-->
    @yield('meta')
    <meta name="author" content="{{ $setting->title }}">
    <meta name="distribution" content="web">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon Icons-->
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset($setting->favicon) }}">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset('frontend/css/plugins.min.css') }}">

    @yield('styleplugins')

    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('frontend/css/styles.min.css') }}">
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Color css -->
    <link href="{{ asset('frontend/css/color.php?primary_color=') . str_replace('#', '', $setting->primary_color) }}"
        rel="stylesheet">

    <!-- Modernizr-->
    <script src="{{ asset('frontend/js/modernizr.min.js') }}"></script>

    @if (App\Models\Language::where('is_default', 1)->first()->rtl == 1)
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
    @endif

    {{-- Google AdSense Start --}}
    @if ($setting->is_google_adsense == '1')
        {!! $setting->google_adsense !!}
    @endif
    {{-- Google AdSense End --}}

    {{-- Google AnalyTics Start --}}
    @if ($setting->is_google_analytics == '1')
        {!! $setting->google_analytics !!}
    @endif
    {{-- Google AnalyTics End --}}

    {{-- Facebook pixel  Start --}}
    @if ($setting->is_facebook_pixel == '1')
        {!! $setting->facebook_pixel !!}
    @endif
    {{-- Facebook pixel End --}}

</head>
<!-- Body-->

<body
    class="
        @if ($setting->theme == 'theme1') body_theme1
        @endif
        ">
    @if ($setting->is_loader == 1)
    <!-- Preloader Start -->
    <div id="preloader">
        <img src="{{ asset($setting->loader) }}" alt="">
    </div>
    <!-- Preloader endif -->
    @endif

    <!-- Header-->
    <header class="site-header navbar-sticky">
        <div class="menu-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="right-area">
                            <a class="track-order-link wishlist-mobile d-inline-block d-lg-none" href="{{ route('user.wishlist.index') }}"><i class="icon-heart"></i>{{ __('Wishlist') }}</a>

                            <div class="login-register ">
                                @if (!Auth::user())
                                    <a class="track-order-link mr-0" href="{{ route('user.login') }}">
                                        {{ __('Login/Register') }}
                                    </a>
                                @else
                                    <div class="t-h-dropdown">
                                        <div class="main-link">
                                            <i class="icon-user pr-2"></i> <span class="text-label">{{ Auth::user()->first_name }}</span>
                                        </div>
                                        <div class="t-h-dropdown-menu">
                                            <a href="{{ route('user.dashboard') }}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                            <a href="{{ route('user.logout') }}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar-->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <!-- Logo-->
                            <div class="site-branding"><a class="site-logo align-self-center" href="{{ route('frontend.index') }}"><img src="{{ asset($setting->logo) }}" alt="{{ $setting->title }}"></a></div>
                            <!-- Search / Categories-->
                            <div class="search-box-wrap d-none d-lg-block d-flex">
                                <div class="search-box-inner align-self-center">
                                    <div class="search-box d-flex">
                                        <form class="input-group" action="{{ route('frontend.catalog') }}" method="get">
                                            <span class="input-group-btn">
                                                <button type="submit"><i class="icon-search"></i></button>
                                            </span>
                                            <input class="form-control" type="text" name="search" placeholder="{{ __('Search by product name') }}">
                                        </form>
                                    </div>
                                </div>
                                <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                            </div>
                            <!-- Toolbar-->
                            <div class="toolbar d-flex">

                                <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#">
                                        <div>
                                            <i class="icon-search"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                                        <div><i class="icon-menu"></i><span class="text-label">{{ __('Menu') }}</span></div>
                                    </a>
                                </div>

                                <div class="toolbar-item">
                                    <a href="{{ route('frontend.cart') }}">
                                        <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label cart_count">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }} </span></span><span class="text-label">{{ __('Cart') }}</span></div>
                                    </a>
                                    <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="{{ route('frontend.header.cart') }}">
                                        @include('frontend._inc.header_cart')
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Menu-->
                            <div class="mobile-menu">
                                <!-- Slideable (Mobile) Menu-->
                                <div class="mm-heading-area">
                                    <h4>{{ __('Navigation') }}</h4>
                                    <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                        <a href="#">
                                            <div> <i class="icon-x"></i></div>
                                        </a>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation99">
                                        <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu" role="tab" aria-controls="mmenu" aria-selected="true">{{ __('Menu') }}</span>
                                    </li>
                                    <li class="nav-item" role="presentation99">
                                        <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat" role="tab" aria-controls="mcat" aria-selected="false">{{ __('Category') }}</span>
                                    </li>

                                </ul>
                                <div class="tab-content p-0">
                                    <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                                        <nav class="slideable-menu">
                                            <ul>
                                                <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                                                    <a href="{{ route('frontend.index') }}"><i class="icon-chevron-right"></i>{{ __('Home') }}</a></li>
                                                @if ($setting->is_shop == 1)
                                                    <li class="{{ request()->routeIs('frontend.catalog*') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.catalog') }}"><i class="icon-chevron-right"></i>{{ __('Shop') }}</a>
                                                    </li>
                                                @endif
                                                @if ($setting->is_campaign == 1)
                                                    <li class="{{ request()->routeIs('frontend.campaign') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.campaign') }}"><i class="icon-chevron-right"></i>{{ __('Campaign') }}</a>
                                                    </li>
                                                @endif
                                                @if ($setting->is_brands == 1)
                                                    <li class="{{ request()->routeIs('frontend.brands') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.brands') }}"><i class="icon-chevron-right"></i>{{ __('Brand') }}</a>
                                                    </li>
                                                @endif

                                                @if ($setting->is_blog == 1)
                                                    <li class="{{ request()->routeIs('frontend.blog*') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.blog') }}"><i class="icon-chevron-right"></i>{{ __('Blog') }}</a>
                                                    </li>
                                                @endif

                                                @if ($setting->is_faq == 1)
                                                    <li class="{{ request()->routeIs('frontend.faq*') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.faq') }}"><i class="icon-chevron-right"></i>{{ __('Faq') }}</a>
                                                    </li>
                                                @endif


                                                @if ($setting->is_contact == 1)
                                                    <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                                                        <a href="{{ route('frontend.contact') }}"><i class="icon-chevron-right"></i>{{ __('Contact') }}</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                                        <nav class="slideable-menu">
                                            @include('frontend._inc.mobile-category')
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar-->
        <div class="navbar">
            <div class="container">
                <div class="row g-3 w-100">
                    <div class="col-lg-3">
                        @include('frontend._inc.categories')
                    </div>
                    <div class="col-lg-9">
                        <div class="nav-inner">
                            <nav class="site-menu">
                                <ul>
                                    <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                                        <a href="{{ route('frontend.index') }}">{{ __('Home') }}</a>
                                    </li>
                                    @if ($setting->is_shop == 1)
                                        <li class="{{ request()->routeIs('frontend.catalog*') ? 'active' : '' }}">
                                            <a href="{{ route('frontend.catalog') }}">{{ __('Shop') }}</a>
                                        </li>
                                    @endif

                                    <li class="t-h-dropdown">
                                        <a class="main-link" href="#">{{ __('Pages') }} <i class="icon-chevron-down"></i></a>
                                        <div class="t-h-dropdown-menu">
                                            @if ($setting->is_faq == 1)
                                                <a class="{{ request()->routeIs('frontend.faq*') ? 'active' : '' }}" href="{{ route('frontend.faq') }}"><i class="icon-chevron-right pr-2"></i>{{ __("FAQ's") }}</a>
                                            @endif
                                            @foreach (DB::table('pages')->wherePos(0)->orwhere('pos', 2)->get() as $page)
                                                <a class="{{ request()->url() == route('frontend.page', $page->slug) ? 'active' : '' }} " href="{{ route('frontend.page', $page->slug) }}"><i class="icon-chevron-right pr-2"></i>{{ $page->title }}</a>
                                            @endforeach
                                        </div>
                                    </li>

                                    @if ($setting->is_contact == 1)
                                        <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}"><a href="{{ route('frontend.contact') }}">{{ __('Contact') }}</a></li>
                                    @endif
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Page Content-->
    @yield('content')

    <!--    announcement banner section start   -->
    <a class="announcement-banner" href="#announcement-modal"></a>
    <div id="announcement-modal" class="mfp-hide white-popup">
        <a href="{{ $setting->announcement_link }}">
            <img src="{{ asset($setting->announcement) }}" alt="">
        </a>
    </div>
    <!--    announcement banner section end   -->

    <!-- Site Footer-->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Contact Info-->
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title">{{ __('Get In Touch With Us') }}</h3>
                        <p class="">{{ __('Address') }}: {{ $setting->footer_address }}</p>
                        <p class="">{{ __('Phone') }}: {{ $setting->footer_phone }}</p>
                        <ul class="list-unstyled text-sm">
                            <li><span class="opacity-80">{{ __('Monday-Friday') }}:&nbsp;</span>{{ $setting->friday_start }} - {{ $setting->friday_end }}</li>
                            <li><span class="opacity-80">{{ __('Saturday') }}:&nbsp;</span>{{ $setting->satureday_start }} - {{ $setting->satureday_end }}</li>
                        </ul>
                        <p><a class="navi-link" href="mailto:{{ $setting->footer_email }}">{{ $setting->footer_email }}</a></p>

                    </section>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Customer Info-->
                    <div class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">{{ __('Usefull Links') }}</h3>
                        <ul>
                            @foreach (DB::table('pages')->wherePos(2)->orwhere('pos', 1)->get() as $page)
                                <li><a href="{{ route('frontend.page', $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Subscription-->
                    <section class="widget">
                        <h3 class="widget-title">{{ __('Newsletter') }}</h3>
                        <div class="pt-3"><img class="d-block gateway_image" src="{{ $setting->footer_gateway_img ? asset($setting->footer_gateway_img) : asset('backend/images/placeholder.png') }}">
                        </div>
                    </section>
                </div>
            </div>
            <!-- Copyright-->
            <p class="footer-copyright"> {{ $setting->copy_right }}</p>
        </div>
    </footer>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#">
        <i class="icon-chevron-up"></i>
    </a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>

    <script type="text/javascript">
        let extra_index_url = '{{ route('frontend.extraindex') }}';
    </script>

    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp

    <script>
        var mainbs = {!! $mainbs !!};
    </script>

    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script type="text/javascript" src="{{ asset('frontend/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('frontend/js/scripts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/lazy.plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/myscript.js') }}"></script>
    @yield('script')

    @if ($setting->is_facebook_messenger == '1')
        {!! $setting->facebook_messenger !!}
    @endif

    <script type="text/javascript">
        let mainurl = '{{ route('frontend.index') }}';

        let view_extra_index = 0;
        // Notifications
        function SuccessNotification(title) {
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
            }, {
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title) {
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                DangerNotification('{{ Session::get('error') }}')
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                SuccessNotification('{{ Session::get('success') }}');
            })
        </script>
    @endif

</body>

</html>
