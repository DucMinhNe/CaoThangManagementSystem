    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Cao Thắng</title>
        <link rel="icon" type="image/png" href="{{ asset('dist/img/caothang.png') }}" />
        <!-- Google Font: Source Sans Pro -->
        <!-- <link rel="stylesheet"
            href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}"> -->
        <link rel="stylesheet" href="{{ asset('dist/css/fontgoogle.css') }}">
            <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet"
            href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Datatables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('dist/img/logo_caothang.jpg') }}" alt="LogoCaoThang"
                    height="200" width="120">
            </div>
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a href="/admin/dangxuat" class="nav-link">
                            <i class="nav-icon fas fa-right-from-bracket"></i>
                        </a>
                    </li>
                    <!-- Messages Dropdown Menu -->

                    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
                </ul>
            </nav>
            <!-- /.navbar -->