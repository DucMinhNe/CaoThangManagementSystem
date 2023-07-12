@include('admin.layouts.header')

@if(auth()->user()->id_chuc_vu == 1)
@include('admin.layouts.sidebar1')
@elseif(auth()->user()->id_chuc_vu == 2)
@include('admin.layouts.sidebar2')
@elseif(auth()->user()->id_chuc_vu == 3)
@include('admin.layouts.sidebar3')
@endif
<!-- Content Wrapper. Contains page content -->
<style>
.select2-selection__rendered {
    line-height: 29px !important;
}

.select2-container .select2-selection--single {
    height: 38px !important;
}

.select2-selection__arrow {
    height: 35px !important;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông Tin Cá Nhân</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @php
                                $hinhAnhDaiDien = auth()->user()->hinh_anh_dai_dien ? asset('giangvien_img/' .
                                auth()->user()->hinh_anh_dai_dien) : asset('dist/img/user2-160x160.jpg');
                                @endphp
                                <img src="{{ $hinhAnhDaiDien }}" class="profile-user-img img-fluid img-circle" alt="">
                            </div>
                            <h3 class="profile-username text-center">{{auth()->user()->ten_giang_vien}}</h3>

                            <p class="text-muted text-center"> {{ $chucvus ? $chucvus->ten_chuc_vu : '' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Chủ Nhiệm Lớp</b> <a class="float-right">@foreach($chunhiems as $chunhiem)
                                        <p>{{ $chunhiem->ten_lop_hoc }}</p>
                                        @endforeach
                                    </a>
                                </li>
                                <!-- <div class="form-group">
                                    <label for="id_lop_hoc_phan">Chủ Nhiệm Lớp</label>
                                    <select name="id_lop_hoc_phan" id="id_lop_hoc_phan" class="form-control select2"
                                        style="width: 100%;">
                                        @foreach ($chunhiems as $chunhiem)
                                        @if ($chunhiem->trang_thai == 1)
                                        <option value="{{ $chunhiem->id }}">{{ $chunhiem->ten_lop_hoc}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div> -->
                                <!-- <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li> -->
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#thongtincanhan"
                                        data-toggle="tab">Thông
                                        Tin Cá Nhân</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#doimatkhau" data-toggle="tab">Đổi Mật
                                        Khẩu</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#cacmongiangday" data-toggle="tab">Các
                                        Môn Giảng Dạy</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="thongtincanhan">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Mã Giảng Viên</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ma_gv}}"
                                                            placeholder="Mã Giảng Viên" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Tên Giảng
                                                        Viên</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ten_giang_vien}}"
                                                            placeholder="Tên Giảng Viên" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Email</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->email}}" placeholder="Email"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Số Điện
                                                        Thoại</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->so_dien_thoai}}"
                                                            placeholder="Số Điện Thoại" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">CMND/CCCD</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->so_cmt}}" placeholder="CMND/CCCD"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Đ/C Thường
                                                        Trú</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dia_chi_thuong_tru}}"
                                                            placeholder="Đ/C Thường Trú" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Bộ
                                                        Môn</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{ $bomons ? $bomons->ten_bo_mon : '' }}"
                                                            placeholder="Bộ Môn" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Giới
                                                        Tính</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{ auth()->user()->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}"
                                                            placeholder="Giới Tính" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Ngày
                                                        Sinh</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ngay_sinh}}"
                                                            placeholder="Ngày Sinh" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Nơi
                                                        Sinh</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->noi_sinh}}" placeholder="Nơi Sinh"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Dân
                                                        Tộc</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dan_toc}}" placeholder="Dân Tộc"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Tôn
                                                        Giáo</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ton_giao}}" placeholder="Tôn Giáo"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Đ/C Tạm
                                                        Trú</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dia_chi_tam_tru}}"
                                                            placeholder="Đ/C Tạm Trú" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Chức
                                                        Vụ</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control"
                                                            value="{{ $chucvus ? $chucvus->ten_chuc_vu : '' }}"
                                                            placeholder="Chức Vụ" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                                <div class="tab-pane" id="doimatkhau">
                                    <div class="card-body">
                                        <form class="form-horizontal" id="doimatkhauForm" name="doimatkhauForm">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="mat_khau_cu" class="col-sm-3 col-form-label">Mật
                                                            Khẩu
                                                            Cũ</label>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control password-field"
                                                                value="" id="mat_khau_cu" name="mat_khau_cu"
                                                                placeholder="Mật Khẩu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="mat_khau_moi" class="col-sm-3 col-form-label">Mật
                                                            Khẩu Mới</label>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control password-field"
                                                                value="" id="mat_khau_moi" name="mat_khau_moi"
                                                                placeholder="Mật Khẩu Mới">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="nhap_lai_mat_khau"
                                                            class="col-sm-3 col-form-label">Nhập Lại
                                                            Mật Khẩu</label>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control password-field"
                                                                value="" id="nhap_lai_mat_khau" name="nhap_lai_mat_khau"
                                                                placeholder="Nhập Lại Mật Khẩu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="show_password">
                                                                <label class="form-check-label" for="show_password">
                                                                    Hiển thị mật khẩu
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary" id="savedata"
                                                    value="create">Lưu</button>
                                            </div>
                                        </form>
                                        <!-- /.tab-pane -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="cacmongiangday">

                                    <div class="col-md-12">
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <b>Các Môn Giảng Dạy: </b>
                                            @foreach($lophocphans
                                            as $lophocphan)
                                            @if ($lophocphan->trang_thai_hoan_thanh == 0)
                                            <li class="list-group-item">
                                                <a class="float-left">
                                                    {{ $lophocphan->ten_lop_hoc_phan }}
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script type="text/javascript">
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#show_password').change(function() {
            var passwordFields = $('.password-field');
            if ($(this).is(':checked')) {
                passwordFields.attr('type', 'text');
            } else {
                passwordFields.attr('type', 'password');
            }
        });
    });
    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Đang gửi ...');
        $.ajax({
            data: $('#doimatkhauForm').serialize(),
            url: "{{ route('thongtincanhan.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $('#savedata').html('Lưu');
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function(data) {
                $('#savedata').html('Lưu');
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'error',
                    title: data.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
});
</script>
@include('admin.layouts.footer')