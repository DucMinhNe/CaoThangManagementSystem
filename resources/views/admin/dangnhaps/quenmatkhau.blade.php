<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên Mật Khẩu</title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/caothang.png') }}" style="width: 64px" />
    <link rel="stylesheet" href="{{ asset('dist/css/fontgoogle.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

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
            <label class="d-flex justify-content-center">Hãy điền email của bạn</label>
            <div class="card-body">
                @if(session('status') === 'success')
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fa-solid fa-right-to-bracket mr-1"></i>Gửi đường link đặt lại mật
                                khẩu</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>

</html>

<!-- <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">Gửi đường link đặt lại mật khẩu</button>
    </div>
</form> -->