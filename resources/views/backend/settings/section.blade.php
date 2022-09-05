@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Visibility') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              @include('alerts.alerts')
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-5 col-sm-3">
                      <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#home1" role="tab" aria-controls="home1" aria-selected="true">{{ __('Home One') }}</a>

                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#home2" role="tab" aria-controls="home2" aria-selected="false">{{ __('Home Two') }}</a>

                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#home3" role="tab" aria-controls="home3" aria-selected="false">{{ __('Home Three') }}</a>

                        <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#home4" role="tab" aria-controls="home4" aria-selected="false">{{ __('Home Four') }}</a>
                      </div>
                    </div>
                    <div class="col-7 col-sm-9">
                      <form action="{{ route('backend.setting.visible.update') }}" method="POST" id="quickForm" enctype="multipart/form-data" class="tab-content" id="vert-tabs-tabContent">

                            @csrf
                            <div class="tab-pane text-left fade show active" id="home1" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class=" row">

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_slider" class="" name="is_slider" value="1" {{ $setting->is_slider == 1 ? 'checked' : '' }}>
                                                <label for="is_slider">{{ __('Slider Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_three_c_b_first" class="" name="is_three_c_b_first" value="1" {{ $setting->is_three_c_b_first == 1 ? 'checked' : '' }}>
                                                <label for="is_three_c_b_first">{{ __('3 column banner First') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_popular_category" class="" name="is_popular_category" value="1" {{ $setting->is_popular_category == 1 ? 'checked' : '' }}>
                                                <label for="is_popular_category">{{ __('Popular Categories') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_three_c_b_second" class="" name="is_three_c_b_second" value="1" {{ $setting->is_three_c_b_second == 1 ? 'checked' : '' }}>
                                                <label for="is_three_c_b_second">{{ __('3 column banner Second') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_highlighted" class="" name="is_highlighted" value="1" {{ $setting->is_highlighted == 1 ? 'checked' : '' }}>
                                                <label for="is_highlighted">{{ __('Featured, Best Seller, Top Rated, New Product') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_two_column_category" class="" name="is_two_column_category" value="1" {{ $setting->is_two_column_category == 1 ? 'checked' : '' }}>
                                                <label for="is_two_column_category">{{ __('Two column category') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_popular_brand" class="" name="is_popular_brand" value="1" {{ $setting->is_popular_brand == 1 ? 'checked' : '' }}>
                                                <label for="is_popular_brand">{{ __('Popular Brands') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_featured_category" class="" name="is_featured_category" value="1" {{ $setting->is_featured_category == 1 ? 'checked' : '' }}>
                                                <label for="is_featured_category">{{ __('Featured Categories') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_two_c_b" class="" name="is_two_c_b" value="1" {{ $setting->is_two_c_b == 1 ? 'checked' : '' }}>
                                                <label for="is_two_c_b">{{ __('Two column banner') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_blogs" class="" name="is_blogs" value="1" {{ $setting->is_blogs == 1 ? 'checked' : '' }}>
                                                <label for="is_blogs">{{ __('blog Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_service" class="" name="is_service" value="1" {{ $setting->is_service == 1 ? 'checked' : '' }}>
                                                <label for="is_service">{{ __('Service Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="home2" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                <div class=" row">

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_slider" class="" name="is_t2_slider" value="1" {{ $extra_settings->is_t2_slider == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_slider">{{ __('Slider Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_service_section" class="" name="is_t2_service_section" value="1" {{ $extra_settings->is_t2_service_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_service_section">{{ __('Service Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_3_column_banner_first" class="" name="is_t2_3_column_banner_first" value="1" {{ $extra_settings->is_t2_3_column_banner_first == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_3_column_banner_first">{{ __('3 column banner First') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_flashdeal" class="" name="is_t2_flashdeal" value="1" {{ $extra_settings->is_t2_flashdeal == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_flashdeal">{{ __('Flash Deal') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_new_product" class="" name="is_t2_new_product" value="1" {{ $extra_settings->is_t2_new_product == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_new_product">{{ __('New Product Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_3_column_banner_second" class="" name="is_t2_3_column_banner_second" value="1" {{ $extra_settings->is_t2_3_column_banner_second == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_3_column_banner_second">{{ __('3 column banner Second') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_featured_product" class="" name="is_t2_featured_product" value="1" {{ $extra_settings->is_t2_featured_product == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_featured_product">{{ __('Featured Product Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_bestseller_product" class="" name="is_t2_bestseller_product" value="1" {{ $extra_settings->is_t2_bestseller_product == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_bestseller_product">{{ __('Bestseller Product Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_toprated_product" class="" name="is_t2_toprated_product" value="1" {{ $extra_settings->is_t2_toprated_product == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_toprated_product">{{ __('Top Rated Product Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_2_column_banner" class="" name="is_t2_2_column_banner" value="1" {{ $extra_settings->is_t2_2_column_banner == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_2_column_banner">{{ __('2 Column Banner') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_blog_section" class="" name="is_t2_blog_section" value="1" {{ $extra_settings->is_t2_blog_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_blog_section">{{ __('Blog Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t2_brand_section" class="" name="is_t2_brand_section" value="1" {{ $extra_settings->is_t2_brand_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t2_brand_section">{{ __('Brand Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="home3" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                <div class=" row">

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_slider" class="" name="is_t3_slider" value="1" {{ $extra_settings->is_t3_slider == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_slider">{{ __('Slider Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_service_section" class="" name="is_t3_service_section" value="1" {{ $extra_settings->is_t3_service_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_service_section">{{ __('Service Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_3_column_banner_first" class="" name="is_t3_3_column_banner_first" value="1" {{ $extra_settings->is_t3_3_column_banner_first == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_3_column_banner_first">{{ __('3 column banner First') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_popular_category" class="" name="is_t3_popular_category" value="1" {{ $extra_settings->is_t3_popular_category == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_popular_category">{{ __('Popular Category') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_flashdeal" class="" name="is_t3_flashdeal" value="1" {{ $extra_settings->is_t3_flashdeal == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_flashdeal">{{ __('Flash Deal') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_3_column_banner_second" class="" name="is_t3_3_column_banner_second" value="1" {{ $extra_settings->is_t3_3_column_banner_second == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_3_column_banner_second">{{ __('3 column banner Second') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_pecialpick" class="" name="is_t3_pecialpick" value="1" {{ $extra_settings->is_t3_pecialpick == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_pecialpick">{{ __('Special Pick') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_brand_section" class="" name="is_t3_brand_section" value="1" {{ $extra_settings->is_t3_brand_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_brand_section">{{ __('Brand Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_2_column_banner" class="" name="is_t3_2_column_banner" value="1" {{ $extra_settings->is_t3_2_column_banner == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_2_column_banner">{{ __('2 Column Banner') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t3_blog_section" class="" name="is_t3_blog_section" value="1" {{ $extra_settings->is_t3_blog_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t3_blog_section">{{ __('Blog Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="home4" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                <div class=" row">

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_slider" class="" name="is_t4_slider" value="1" {{ $extra_settings->is_t4_slider == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_slider">{{ __('Slider Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_featured_banner" class="" name="is_t4_featured_banner" value="1" {{ $extra_settings->is_t4_featured_banner == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_featured_banner">{{ __('Featured Banner') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_specialpick" class="" name="is_t4_specialpick" value="1" {{ $extra_settings->is_t4_specialpick == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_specialpick">{{ __('Special Pick') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_3_column_banner_first" class="" name="is_t4_3_column_banner_first" value="1" {{ $extra_settings->is_t4_3_column_banner_first == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_3_column_banner_first">{{ __('3 Column Banner First') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_flashdeal" class="" name="is_t4_flashdeal" value="1" {{ $extra_settings->is_t4_flashdeal == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_flashdeal">{{ __('Flash Deal') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_3_column_banner_second" class="" name="is_t4_3_column_banner_second" value="1" {{ $extra_settings->is_t4_3_column_banner_second == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_3_column_banner_second">{{ __('3 Column Banner Second') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_popular_category" class="" name="is_t4_popular_category" value="1" {{ $extra_settings->is_t4_popular_category == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_popular_category">{{ __('Popular Category') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_2_column_banner" class="" name="is_t4_2_column_banner" value="1" {{ $extra_settings->is_t4_2_column_banner == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_2_column_banner">{{ __('2 Column Banner') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_blog_section" class="" name="is_t4_blog_section" value="1" {{ $extra_settings->is_t4_blog_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_blog_section">{{ __('Blog Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_brand_section" class="" name="is_t4_brand_section" value="1" {{ $extra_settings->is_t4_brand_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_brand_section">{{ __('Brand Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                    <div class="col-md-3"></div>
                                    <div class="form-group  col-md-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="is_t4_service_section" class="" name="is_t4_service_section" value="1" {{ $extra_settings->is_t4_service_section == 1 ? 'checked' : '' }}>
                                                <label for="is_t4_service_section">{{ __('Service Section') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="form-group  col-md-6">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
