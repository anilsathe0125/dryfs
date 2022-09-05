@extends('backend.layouts.backend')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Basic Information') }}</h1>
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
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#basic" role="tab" aria-controls="basic" aria-selected="true">{{ __('Basic Information') }}</a>

                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#media" role="tab" aria-controls="media" aria-selected="false">{{ __('Media') }}</a>

                        <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#seo" role="tab" aria-controls="seo" aria-selected="false">{{ __('Seo') }}</a>

                        <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#links" role="tab" aria-controls="links" aria-selected="false">{{ __('Menu') }}</a>

                        <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#footer" role="tab" aria-controls="footer" aria-selected="false">{{ __('Footer & Contact Page') }}</a>

                      </div>
                    </div>
                    <form action="{{ route('backend.setting.update') }}" method="POST" enctype="multipart/form-data" class="col-7 col-sm-9" >
                        @csrf
                        <input type="hidden" name="is_validate" value="1">

                      <div class="tab-content" id="vert-tabs-tabContent">

                        <div class="tab-pane text-left fade show active" id="basic" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            <form action="{{ route('backend.setting.update') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="is_validate" value="1">
                                <div class=" row">
                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                      <label for="title">{{ __('Title') }} *</label>
                                      <input type="text" name="title" class="form-control item-name" id="title" placeholder="{{ __('Enter Website Title') }}" value="{{ $setting->title }}" required>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                      <label for="primary_color">{{ __('Primary Colour Code') }} *</label>
                                      <input type="color" name="primary_color" class="form-control item-name" id="primary_color" placeholder="{{ __('Enter Website Primary Colour Code') }}" value="{{ $setting->primary_color }}" required>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                      <label for="currency_direction">{{ __('Currency Direction') }} *</label>
                                        <select name="currency_direction" id="currency_direction" class="form-control select2" required>
                                            <option value="1" {{ $setting->currency_direction == 1 ? 'selected' : '' }}>{{ __('Left ($100.00)') }}</option>
                                            <option value="0" {{ $setting->currency_direction == 0 ? 'selected' : '' }}>{{__('Right (100.00$)')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>

                            </form>
                        </div>

                        <div class="tab-pane fade" id="theme" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            <div  id="quickForm" >
                                <div class=" row">
                                    <div class="col-md-2"></div>
                                    <div class="form-group  col-md-8">
                                      <label for="select_theme">{{ __('Select Home Page') }} *</label>
                                        <select name="theme" id="select_theme" class="form-control select2" required>
                                            <option value="theme1" {{ $setting->theme == 'theme1' ? 'selected' : '' }}>{{ __('Hom 1') }}</option>
                                            <option value="theme2" {{ $setting->theme == 'theme2' ? 'selected' : '' }}>{{__('Hom 2')}}</option>
                                            <option value="theme3" {{ $setting->theme == 'theme3' ? 'selected' : '' }}>{{__('Home 3')}}</option>
                                            <option value="theme4" {{ $setting->theme == 'theme4' ? 'selected' : '' }}>{{__('Home 4')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="card  card-outline card-tabs">
                                            <div class="card-header p-0 pt-1 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link  {{$setting->theme == 'theme1' ? 'active' : ''}}" id="theme1-tab" data-toggle="pill" href="#theme1" role="tab" aria-controls="theme1" aria-selected="false">{{ __('Home 1') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link  {{$setting->theme == 'theme2' ? 'active' : ''}}" id="theme2-tab" data-toggle="pill" href="#theme2" role="tab" aria-controls="theme2" aria-selected="false">{{ __('Home 2') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link  {{$setting->theme == 'theme3' ? 'active' : ''}}" id="theme3-tab" data-toggle="pill" href="#theme3" role="tab" aria-controls="theme3" aria-selected="false">{{ __('Home 3') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link  {{$setting->theme == 'theme4' ? 'active' : ''}}" id="theme4-tab" data-toggle="pill" href="#theme4" role="tab" aria-controls="theme4" aria-selected="true">{{ __('Home 4') }}</a>
                                                </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                                <div class="tab-pane fade {{$setting->theme == 'theme1' ? 'active show' : ''}} text-center" id="theme1" role="tabpanel" aria-labelledby="theme1-tab">
                                                    <img src="{{ asset("backend/images/themes/theme1.png") }}" class="admin-setting-img" alt="No Image Found">
                                                </div>
                                                <div class="tab-pane fade {{$setting->theme == 'theme2' ? 'active show' : ''}} text-center" id="theme2" role="tabpanel" aria-labelledby="theme2-tab">
                                                    <img src="{{ asset("backend/images/themes/theme2.png") }}" class="admin-setting-img" alt="No Image Found">
                                                </div>
                                                <div class="tab-pane fade {{$setting->theme == 'theme3' ? 'active show' : ''}} text-center" id="theme3" role="tabpanel" aria-labelledby="theme3-tab">
                                                    <img src="{{ asset("backend/images/themes/theme3.png") }}" class="admin-setting-img" alt="No Image Found">
                                                </div>
                                                <div class="tab-pane fade  {{$setting->theme == 'theme4' ? 'active show' : ''}} text-center" id="theme4" role="tabpanel" aria-labelledby="theme4-tab">
                                                    <img src="{{ asset("backend/images/themes/theme4.png") }}" class="admin-setting-img" alt="No Image Found">
                                                </div>
                                                </div>
                                            </div>
                                        <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                            <div id="quickForm" enctype="multipart/form-data">
                                <div class=" row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="card  card-outline card-tabs">
                                            <div class="card-header p-0 pt-1 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="logo-tab" data-toggle="pill" href="#logo" role="tab" aria-controls="logo" aria-selected="false">{{ __('Logo') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="favicon-tab" data-toggle="pill" href="#favicon" role="tab" aria-controls="favicon" aria-selected="false">{{ __('Favicon') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="loader-tab" data-toggle="pill" href="#loader" role="tab" aria-controls="loader" aria-selected="false">{{ __('Loader') }}</a>
                                                </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="media-tabContent">

                                                <div class="tab-pane fade active show " id="logo" role="tabpanel" aria-labelledby="logo-tab">

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                                        <br>
                                                        <img src="{{ $setting->logo ? asset($setting->logo) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                                        <br>
                                                        <span>{{ __('Image Size Should Be 140 x 40.') }}</span>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                            <input type="file" name="logo" accept="image/*" class="custom-file-input upload-photo" id="logo" aria-label="File browser">
                                                            <label class="custom-file-label" for="logo">{{ __('Upload Image...') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade " id="favicon" role="tabpanel" aria-labelledby="favicon-tab">
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                                        <br>
                                                        <img src="{{ $setting->favicon ? asset($setting->favicon) : asset('backend/images/placeholder.png') }}" class="admin-setting-img my-mw-100" alt="No Image Found">
                                                        <br>
                                                        <span>{{ __('Image Size Should Be 16 x 16.') }}</span>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                            <input type="file" name="favicon" class="custom-file-input upload-photo" id="favicon" aria-label="File browser">
                                                            <label class="custom-file-label" for="favicon">{{ __('Upload Image...') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade " id="loader" role="tabpanel" aria-labelledby="loader-tab">
                                                    <div class="form-group  col-md-12">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="is_loader" class="" name="is_loader" value="1" {{ $setting->is_loader == 1 ? 'checked' : '' }}>
                                                            <label for="is_loader">{{ __('Display Loader') }}</label>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1">{{ __('Current Image') }} *</label>
                                                        <br>
                                                        <img src="{{ $setting->loader ? asset($setting->loader) : asset('backend/images/placeholder.png') }}" class="admin-setting-img my-mw-100" alt="No Image Found">
                                                        <br>
                                                        <span>{{ __('Image Size Should Be 124 x 124.') }}</span>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                            <input type="file" name="loader" class="custom-file-input upload-photo" id="loader" aria-label="File browser">
                                                            <label class="custom-file-label" for="loader">{{ __('Upload Image...') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                            <div id="quickForm" enctype="multipart/form-data">
                                <div class=" row">
                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                    <label for="meta_keywords">{{ __('Site Meta Keywords') }} *</label>
                                    <input type="text" name='meta_keywords' id="meta_keywords" class='form-control tags' placeholder="{{ __('Site Meta Keywords') }}" value="{{ $setting->meta_keywords }}" required>
                                  </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                    <label for="meta_description">{{ __('Site Meta Description') }} *</label>
                                    <textarea name='meta_description' class='form-control' id="meta_description" placeholder="{{ __('Enter Site Meta Description') }}" rows="5">{{ $setting->meta_description }}</textarea>
                                  </div>
                                <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="links" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                            <div >

                                <div class=" row">

                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                   <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        <input type="checkbox" id="is_shop" class="" name="is_shop" value="1" {{ $setting->is_shop == 1 ? 'checked' : '' }}>
                                        <label for="is_shop">{{ __('Display Shop') }}</label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                   <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        <input type="checkbox" id="is_faq" class="" name="is_faq" value="1" {{ $setting->is_faq == 1 ? 'checked' : '' }}>
                                        <label for="is_faq">{{ __('Display Faq') }}</label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                   <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        <input type="checkbox" id="is_contact" class="" name="is_contact" value="1" {{ $setting->is_contact == 1 ? 'checked' : '' }}>
                                        <label for="is_contact">{{ __('Display Contact') }}</label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                  <div class="col-md-2"></div>
                                  <div class="form-group  col-md-8">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                  </div>

                                </div>

                            </div>
                        </div>


                        <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">

                            <div class=" row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="card  card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="footer_basic-tab" data-toggle="pill" href="#footer_basic" role="tab" aria-controls="footer_basic" aria-selected="false">{{ __('Basic') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="footer_link-tab" data-toggle="pill" href="#footer_link" role="tab" aria-controls="footer_link" aria-selected="false">{{ __('Social Link') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="working_days-tab" data-toggle="pill" href="#working_days" role="tab" aria-controls="working_days" aria-selected="false">{{ __('Working Days') }}</a>
                                            </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="footer-tabContent">

                                            <div class="tab-pane fade active show " id="footer_basic" role="tabpanel" aria-labelledby="footer_basic-tab">

                                                <div class="form-group  col-md-12">
                                                    <label for="footer_address">{{ __('Store Address') }} *</label>
                                                    <input type="text" name="footer_address" class="form-control " id="footer_address" placeholder="{{ __('Store Address') }}" value="{{ $setting->footer_address }}" >
                                                </div>

                                                <div class="form-group  col-md-12">
                                                    <label for="footer_phone">{{ __('Store Phone Number') }} *</label>
                                                    <input type="text" name="footer_phone" class="form-control " id="footer_phone" placeholder="{{ __('Store Phone Number') }}" value="{{ $setting->footer_phone }}" >
                                                </div>

                                                <div class="form-group  col-md-12">
                                                    <label for="footer_email">{{ __('Store Email') }} *</label>
                                                    <input type="email" name="footer_email" class="form-control " id="footer_email" placeholder="{{ __('Store Email') }}" value="{{ $setting->footer_email }}" >
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1">{{ __('Current Gateway Image') }} *</label>
                                                    <br>
                                                    <img src="{{ $setting->footer_gateway_img ? asset($setting->footer_gateway_img) : asset('backend/images/placeholder.png') }}" class="admin-setting-img" alt="No Image Found">
                                                    <br>
                                                    <span>{{ __('Image Size Should Be 324 x 31.') }}</span>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                        <input type="file" name="footer_gateway_img" accept="image/*" class="custom-file-input upload-photo" id="footer_gateway_img" aria-label="File browser">
                                                        <label class="custom-file-label" for="footer_gateway_img">{{ __('Upload Image...') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group  col-md-12 ">
                                                    <label for="copy_right">{{ __('Copyright') }} *</label>
                                                    <textarea name='copy_right' class='form-control' id="copy_right" placeholder="{{ __('Copyright') }}" rows="5">{{ $setting->copy_right }}</textarea>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade " id="footer_link" role="tabpanel" aria-labelledby="footer_link-tab">
                                                @php
                                                    $links = json_decode($setting->social_link, true)['links'];
                                                    $icons = json_decode($setting->social_link, true)['icons'];
                                                @endphp
                                                <div class="col-md-12" id="icon-picket-section">
                                                    @foreach ($links as $link_key => $link)
                                                        <div class="row">
                                                            <div class="form-group  col-md-2">
                                                                <button class="btn btn-primary social-picker " name="social_icons[]" data-icon="{{ $icons[$link_key] }}"></button>
                                                            </div>

                                                            <!-- /.col-lg-6 -->
                                                            <div class="form-group  col-md-9">
                                                                <input type="text" name='social_links[]' class='form-control' placeholder="{{ __('Social Link') }}" value="{{ $link }}">
                                                            </div>
                                                            <!-- /.col-lg-6 -->

                                                            <div class="form-group  col-md-1">
                                                                @if (in_array($icons[$link_key], ["fab fa-facebook-f","fab fa-twitter","fab fa-youtube","fab fa-linkedin-in"]))
                                                                    <button data-text="{{ __('Social Link') }}" type="button" class="btn btn-info btn-md add-social"><i class="fa fa-plus"></i></button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger btn-md remove-social"><i class="fa fa-minus"></i></button>
                                                                @endif
                                                            </div>
                                                            <!-- /.col-lg-6 -->
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>

                                            <div class="tab-pane fade " id="working_days" role="tabpanel" aria-labelledby="working_days-tab">

                                                <div class="form-group col-md-12">
                                                <label>{{ __('Monday-Friday from') }} *</label>
                                                <div class="input-group date timepicker" id="timepicker1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="friday_start" data-target="#timepicker1" placeholder="{{ __('Monday-Friday from') }}" value="{{ $setting->friday_start }}"/>
                                                    <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->

                                                <div class="form-group col-md-12">
                                                <label>{{ __('Till') }} *</label>
                                                <div class="input-group date timepicker" id="timepicker2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="friday_end" data-target="#timepicker2" placeholder="{{ __('Till') }}" value="{{ $setting->friday_end }}"/>
                                                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->

                                                <div class="form-group col-md-12">
                                                <label>{{ __('Saturday-Sunday from') }} *</label>
                                                <div class="input-group date timepicker" id="timepicker3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="satureday_start" data-target="#timepicker3" placeholder="{{ __('Saturday-Sunday from') }}" value="{{ $setting->satureday_start }}"/>
                                                    <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->

                                                <div class="form-group col-md-12">
                                                <label>{{ __('Till') }} *</label>
                                                <div class="input-group date timepicker" id="timepicker4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="satureday_end" data-target="#timepicker4" placeholder="{{ __('Till') }}" value="{{ $setting->satureday_end }}"/>
                                                    <div class="input-group-append" data-target="#timepicker4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->

                                            </div>
                                            </div>
                                        </div>
                                    <!-- /.card -->
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-2"></div>
                                <div class="form-group  col-md-8">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>

                            </div>
                        </div>

                      </div>
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
