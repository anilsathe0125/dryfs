@extends('backend.layouts.backend')
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Gallery Images') }}</h1>
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
              <form action="{{ route('backend.item.galleries.update', $item->id) }}" method="POST" id="quickForm" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4 class="card-title">{{ __('Multiple Images Uploading Are Allowed') }}</h4>
                  </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        @include('alerts.alerts')
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @forelse ($item->galleries as $gallery)
                                <div class="col-sm-2 text-center p-2">
                                    <a href="{{ $gallery->photo ? asset($gallery->photo) : asset("backend/images/placeholder.png") }}" data-toggle="lightbox" data-title="{{ $item->name }}" data-gallery="gallery">
                                        <img src="{{ $gallery->photo ? asset($gallery->photo) : asset("backend/images/placeholder.png") }}" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                    <br>
                                    <a class="btn btn-danger btn-sm delete-record" data-toggle="modal"
                                        data-title="{{ __('Confirm Delete?') }}"
                                        data-text="{{ __('You are going to delete this image from gallery.') }} {{ __('Do you want to delete it?') }}"
                                        data-cancel_btn="{{ __('Cancel') }}"
                                        data-ok_btn="{{ __('Delete') }}"
                                        data-href="{{ route('backend.item.gallery.delete', $gallery->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <h4 class="text-info">{{ __('No Images Added') }}</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="file">{{ __('Upload Image...') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="galleries[]" class="custom-file-input upload-photo" id="file" aria-label="File browser" accept="image/*" multiple>
                              <label class="custom-file-label" for="exampleInputFile">{{ __('Upload Image...') }}</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
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
@section('script')
<script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
  </script>
@endsection
