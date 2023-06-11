@extends('admin.thongtincanhans.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
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

                            <p class="text-muted text-center">{{auth()->user()->id_chuc_vu}}</p>

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul> -->

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
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Thông
                                        Tin Cá Nhân</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Đỗi Mật
                                        Khẩu</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Mã Giảng
                                                        Viên</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ma_gv}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-3 col-form-label">Tên Giảng
                                                        Viên</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ten_giang_vien}}"
                                                            placeholder="Name" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2"
                                                        class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->email}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-3 col-form-label">Số Điện
                                                        Thoại</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->so_dien_thoai}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills"
                                                        class="col-sm-3 col-form-label">CMND/CCCD</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->so_cmt}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Đ/C Thường
                                                        Trú</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dia_chi_thuong_tru}}"
                                                            placeholder="Name" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Bộ
                                                        Môn</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->id_bo_mon}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Giới
                                                        Tính</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->gioi_tinh}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-3 col-form-label">Ngày
                                                        Sinh</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ngay_sinh}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-3 col-form-label">Nơi
                                                        Sinh</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->noi_sinh}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-3 col-form-label">Dân
                                                        Tộc</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dan_toc}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Tôn
                                                        Giáo</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->ton_giao}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Đ/C Tạm
                                                        Trú</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->dia_chi_tam_tru}}"
                                                            placeholder="Name" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-3 col-form-label">Chức
                                                        Vụ</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->id_chuc_vu}}" placeholder="Name"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                                <div class="tab-pane" id="timeline">
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-3 col-form-label">Mật Khẩu
                                                            Cũ</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" value=""
                                                                placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-3 col-form-label">Mật
                                                            Khẩu Mới</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" value=""
                                                                placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-3 col-form-label">Nhập Lại
                                                            Mật Khẩu</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" value=""
                                                                placeholder="Name">
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
@endsection