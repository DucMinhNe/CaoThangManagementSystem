<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/caothang.png') }}" style="width: 64px" />

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}"> -->
    <link rel="stylesheet" href="{{ asset('dist/css/fontgoogle.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<!-- style="background-image: url('{{ asset('dist/img/caothang.png') }}');" -->

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Cao Thắng</b></a>
            </div>
            <div style="text-align: center;margin:1rem">
                <img src="{{ asset('dist/img/caothang.png') }}" alt=""
                    style="display: block; margin: auto; width: 120px; height: 120px">
            </div>

            <div class="card-body">
                <!-- <p class="login-box-msg"> <a href="/" class="h1"><b>Đăng Nhập</b></a></p> -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ url('admin/dangnhap') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="tai_khoan" placeholder="Tài Khoản" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="mat_khau" id="mat_khau"
                            placeholder="Mật Khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="showpass" onclick="myFunction()">
                                <label for="showpass">
                                    Hiện Mật Khẩu
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fa-solid fa-right-to-bracket"></i> Đăng Nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a data-toggle="modal" data-target="#modal-lg" href="">Quên Mật Khẩu ?</a>
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                        Quên Mật Khẩu ?
                    </button> -->
                </p>
                <!-- <p class="mb-0">
        <a href="" class="text-center">Register a new membership</a>
      </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center">Hãy liên hệ các siêu quản trị viên để nhận được sử trợ giúp</h3>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column ">
                            <div class="card bg-light d-flex flex-fill border border-danger">
                                <div class="card-header text-muted border-bottom-0">
                                    Siêu Quản Trị Viên
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7 d-flex flex-column">
                                            <h2 class="lead"><b>Lê Đức Minh</b></h2>
                                            <div class="mt-auto">
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class=""><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> SĐT : 0905913419
                                                    </li>
                                                    <li class=""><span class="fa-li"><i
                                                                class="fas fa-lg fa-envelope"></i></span> Email :
                                                        ducminh@gmail.com</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="tel:0905913419" class="btn btn-sm bg-teal">
                                            <i class="fas fa-phone-volume"></i>
                                            Gọi ngay
                                        </a>
                                        <a href="mailto:ducminhldm@gmail.com" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-envelope"></i>
                                            Email
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script>
    function myFunction() {
        var x = document.getElementById("mat_khau");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
</body>

</html>