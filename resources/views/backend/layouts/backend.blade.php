
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $setting->title }}</title>
  <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/css/plugins/fontawesome/css/all.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset("backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css") }} ">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-iconpicker.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/tagify/tagify.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset($setting->loader) }}" alt="Loading..." height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Visit Webiste -->
      <li class="nav-item dropdown">
        <a href="{{ route("frontend.index") }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-globe mr-2"></i> {{ __('View Website') }}</a>
      </li>
        <!-- Full-Screen Button -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        @include('backend.notification.index')
      </li>
      <li class="nav-item dropdown mr-4">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{ Auth::guard('admin')->user()->photo ? asset(Auth::guard('admin')->user()->photo) : asset('backend/images/placeholder.png') }}" width="50" class="avatar-img img-circle" alt="User Image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route("backend.profile") }}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Update Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('backend.password') }}" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('backend.logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('backend.dashboard') }}" class="brand-link text-center">
      <img src="{{ $setting->logo ? asset($setting->logo) : asset('backend/images/placeholder.png') }}" alt="Logo" class="brand-image text-center elevation-3" style="opacity: .8;width:87%">
      <br>
      {{-- <span class="brand-text font-weight-light">{{ $setting->title }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::guard('admin')->user()->photo ? asset(Auth::guard('admin')->user()->photo) : asset('backend/images/placeholder.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route("backend.profile") }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>
      @if (Auth::guard('admin')->user()->id == 1)
        @include('backend._inc.super')
      @else
        @include('backend._inc.normal')
      @endif
    </div>
    <!-- /.sidebar -->
  </aside>

    @yield('content')


  <footer class="main-footer">
    <strong>Copyright &copy; 2022-{{ date('Y') }} Anil Sathe.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/js/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
//   $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.bundle.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('backend/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset("backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset("backend/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
<script src="{{ asset('backend/plugins/tagify/tagify.js') }}"></script>
<!-- Icon Picker -->
<script src="{{ asset('backend/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<!-- Page specific script -->
<script src="{{ asset('backend/js/custom.js') }}"></script>
@yield('script')

</body>
</html>
