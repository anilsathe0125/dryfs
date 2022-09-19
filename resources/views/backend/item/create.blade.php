@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Create Product') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('backend.item.store') }}" method="POST" id="quickForm" enctype="multipart/form-data">
                <input type="hidden" name="item_type" value="normal">
                @csrf
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">{{ __('Current Featured Image') }} *</label>
                    <br>
                    <img src="{{ asset('backend/images/placeholder.png') }}" class="admin-image-preview" alt="">
                    <br>
                    <span>{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                  </div>
                  <div class="col-md-8"></div>
                  <div class="form-group col-md-6">
                    <label for="file">{{ __('Upload Image...') }}</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="photo" class="custom-file-input upload-photo" id="file" aria-label="File browser">
                          <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6"></div>

                  <div class="form-group  col-md-6">
                    <label for="name">{{ __('Name') }} *</label>
                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="slug">{{ __('Slug') }} *</label>
                    <input type="text" name="slug" class="form-control " id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="category_id">{{ __('Select Category') }} *</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="" selected >{{ __('Select One') }}</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="discount_price">{{ __('Current Price') }} *</label>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                {{ PriceHelper::adminCurrency() }}
                            </div>
                        </div>
                        <input type="number" name="discount_price" id="discount_price" min="0" step="0.01" class="form-control" placeholder="{{ __('Enter Current Price') }}" value="{{ old('discount_price') }}">
                    </div>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="previous_price">{{ __('Previous Price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                {{ $curr->sign }}
                            </div>
                        </div>
                        <input type="number" name="previous_price" id="previous_price" min="0" step="0.01" class="form-control" placeholder="{{ __('Enter Previous Price') }}" value="{{ old('previous_price') }}">
                    </div>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="sku">{{ __('SKU') }} *</label>
                    <input type="text" name='sku' id="sku" class='form-control' placeholder="{{ __('Enter SKU') }}" value="{{ Str::random(10) }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="stock">{{ __('Total in stock') }} *</label>
                    <input type="number" name='stock' id="stock" class='form-control' placeholder="{{ __('Total in stock') }}" value="{{ old('stock') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="short_details">{{ __('Short Description') }} *</label>
                    <textarea name="short_details" id="short_details" class='form-control' placeholder="{{ __('Short Description') }}" rows="5">{{ old('short_details') }}</textarea>
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="details">{{ __('Description') }} *</label>
                    <textarea name="details" id="details" class='form-control summernote' placeholder="{{ __('Enter Description') }}" rows="5">{!! old('details') !!}</textarea>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="tax_id">{{ __('Select Tax') }} *</label>
                    <select name="tax_id" id="tax_id"  class="form-control select2">
                        <option value="" selected >{{ __('Select One') }}</option>
                        @foreach ($taxes as $tax)
                            <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->value }}%)</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="tags">{{ __('Tags') }}</label>
                    <input type="text" name='tags' id="tags" class='form-control tags' placeholder="{{ __('Tags') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="video">{{ __('Video Link') }} </label>
                    <input type="text" name='video' id="video" class='form-control' placeholder="{{ __('Enter Video Link') }}" value="{{ old('video') }}">
                  </div>

                  <div class="form-group  col-md-6">
                    <label for="exampleInputPassword1">{{ __('Meta Keywords') }}</label>
                    <input type="text" name='meta_keywords' class='form-control tags' placeholder="{{ __('Enter Meta Keywords') }}">
                  </div>

                  <div class="form-group  col-md-12">
                    <label for="exampleInputPassword1">{{ __('Meta Description') }}</label>
                    <textarea name='meta_descriptions' class='form-control' placeholder="{{ __('Enter Meta Description') }}" rows="5">{{ old('meta_description') }}</textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_specification" class="custom-control-input" id="is_specification" value="1" checked>
                        <label class="custom-control-label" for="is_specification">{{ __('Specifications') }}</label>
                    </div>
                  </div>

                  <div class="col-md-12" id="specifications-section">
                    <div class="row">
                        <div class="form-group  col-md-5">
                            <input type="text" name='specification_name[]' class='form-control' placeholder="{{ __('Specification Name') }}" value="">
                        </div>

                        <!-- /.col-lg-6 -->
                        <div class="form-group  col-md-6">
                            <input type="text" name='specification_description[]' class='form-control' placeholder="{{ __('Specification description') }}" value="">
                        </div>
                        <!-- /.col-lg-6 -->

                        <div class="form-group  col-md-1">
                            <button data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}" type="button" class="btn btn-info btn-md add-specification"><i class="fa fa-plus"></i></button>
                        </div>
                        <!-- /.col-lg-6 -->
                      </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route("backend.item.index") }}" class="btn btn-danger"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
