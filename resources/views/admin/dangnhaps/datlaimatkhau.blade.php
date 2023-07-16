<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt Lại Mật Khẩu</title>
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
            <div class="card-body">
                @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <label class="d-flex justify-content-center">Đặt lại mật khẩu</label>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
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
                    <label for="password">Mật khẩu mới</label>
                    <div class="input-group mb-3">

                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật Khẩu"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <div class="input-group mb-3">

                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="Mật Khẩu" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fa-solid fa-right-to-bracket mr-1"></i>Đặt lại mật khẩu</button>
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

<!-- <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Mật khẩu mới</label>
        <input id="password" type="password" name="password" required>
        @error('password')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Nhập lại mật khẩu</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Đặt lại mật khẩu</button>
    </div>
</form> -->