@extends('admin.layouts.layout')
@section('content')
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
<style>
th,
td {
    white-space: nowrap;
    width: auto;
}
</style>
<section>
    <div class="container">
        <div class="form-group row mb-0">
            <label for="id_khoa_filter" class="col-sm-2 col-form-label">Khoa</label>
            <div class="col-sm-3">
                <select name="id_khoa_filter" id="id_khoa_filter" class="form-control select2" style="width: 100%;">
                    <option value="0">-- Chọn khoa --</option>
                    @foreach ($khoas as $khoa)
                    @if ($khoa->trang_thai == 1)
                    <option value="{{ $khoa->id}}">{{ $khoa->ten_khoa }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <ul class="nav nav-pills nav-pills-bg-soft ml-auto mb-3">
                <li class="nav-item mr-1">
                    <button id="themSinhVienExcelBtn" class="btn btn-primary" type="button">Thêm Bằng File
                        Excel</button>
                </li>
                <li class="nav-item mr-1">
                    <button id="showInactiveBtn" class="btn btn-primary" type="button" value=''>Hiển thị danh sách đã
                        xóa</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-success" type="button" id="createNewBtn">
                        <i class="fa-solid fa-circle-plus"></i> Thêm
                    </button>
                </li>
            </ul>
        </div>
        <div class="form-group row mt-0">

            <label for="id_chuyen_nganh_filter" class="col-sm-2 col-form-label">Chuyên ngành</label>
            <div class="col-sm-3">
                <select name="id_chuyen_nganh_filter" id="id_chuyen_nganh_filter" class="form-control select2"
                    style="width: 100%;">
                    <option value="0">-- Chọn chuyên ngành --</option>
                    @foreach ($chuyennganhs as $chuyennganh)
                    @if ($chuyennganh->trang_thai == 1)
                    <option value="{{ $chuyennganh->id}}">{{ $chuyennganh->ten_chuyen_nganh }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mt-0">
            <label for="id_lop_hoc_filter" class="col-sm-2 col-form-label">Lớp Học</label>
            <div class="col-sm-3">
                <select name="id_lop_hoc_filter" id="id_lop_hoc_filter" class="form-control select2"
                    style="width: 100%;">
                    <option value="0">-- Chọn lớp --</option>
                    @foreach ($lophocs as $lophoc)
                    @if ($lophoc->trang_thai == 1)
                    <option value="{{ $lophoc->id}}">{{ $lophoc->ten_lop_hoc }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button id="xemBtn" class="btn btn-info" type="button">Xem</button>
                <button id="datLaiBtn" class="btn btn-info" type="button">Đặt lại</button>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th width="80px">Mã Sinh Viên</th>
                        <th>Tên Sinh Viên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Số CMT</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Nơi Sinh</th>
                        <th>Dân Tộc</th>
                        <th>Tôn Giáo</th>
                        <th>Địa Chỉ Thường Trú</th>
                        <th>Địa Chỉ Tạm Trú</th>
                        <th>Hình Ảnh Đại Diện</th>
                        <th>Tài Khoản</th>
                        <th>Mật Khẩu</th>
                        <th>Khóa Học</th>
                        <th>Bậc Đào Tạo</th>
                        <th>Hệ Đào Tạo</th>
                        <th>Lớp Học</th>
                        <th>Tình Trạng Học</th>
                        <th width="72px" class="text-center"><a href="#" id="filterToggle">Bộ Lọc</a></th>
                    </tr>
                    <tr class="filter-row">
                        <th width="80px"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th width="72px" class="text-center">
                            <div class="mb-2">
                                <a href="#" class="pb-2 reset-filter">↺</a>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="80px">Mã Sinh Viên</th>
                        <th>Tên Sinh Viên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Số CMT</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Nơi Sinh</th>
                        <th>Dân Tộc</th>
                        <th>Tôn Giáo</th>
                        <th>Địa Chỉ Thường Trú</th>
                        <th>Địa Chỉ Tạm Trú</th>
                        <th>Hình Ảnh Đại Diện</th>
                        <th>Tài Khoản</th>
                        <th>Mật Khẩu</th>
                        <th>Khóa Học</th>
                        <th>Bậc Đào Tạo</th>
                        <th>Hệ Đào Tạo</th>
                        <th>Lớp Học</th>
                        <th>Tình Trạng Học</th>
                        <th width="72px"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
</section>
<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="modalForm" name="modalForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ma_sv">Mã Sinh Viên</label>
                                    <input type="text" class="form-control" id="ma_sv" name="ma_sv"
                                        placeholder="Mã Sinh Viên" value="" required pattern="[0-9]{10}">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mã sinh viên phải là số và có 10 chữ số.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                        value="" readonly required>
                                    <div class="invalid-feedback">
                                        Email phải khớp với mã sinh viên.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="so_cmt">Số CMT</label>
                                    <input type="text" class="form-control" id="so_cmt" name="so_cmt"
                                        placeholder="Số CMT" value="" required pattern="\d{9}|\d{12}">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số chứng minh thư 9 số(CMND) hoặc 12 số (CCCD).
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ten_sinh_vien">Tên Sinh Viên</label>
                                    <input type="text" class="form-control" id="ten_sinh_vien" name="ten_sinh_vien"
                                        placeholder="Tên Sinh Viên" value="" required pattern="^[\p{L}\s]+$">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sinh viên hợp lệ.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="so_dien_thoai">Số Điện Thoại</label>
                                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                        placeholder="Số Điện Thoại" value="" required pattern="^(0|\+84)?([3-9]\d{8})$">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại hợp lệ.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gioi_tinh">Giới Tính</label>
                                    <select class="form-control select2" id="gioi_tinh" name="gioi_tinh" required>
                                        <option value="">-- Chọn Giới Tính --</option>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn giới tính.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ngay_sinh">Ngày Sinh</label>
                                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                        placeholder="Ngày Sinh" value="" required>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn ngày sinh.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dan_toc">Dân Tộc</label>
                                    <input type="text" class="form-control" id="dan_toc" name="dan_toc"
                                        placeholder="Dân Tộc" value="Kinh" required pattern="^[\p{L}\s]+$">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập dân tộc.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dia_chi_thuong_tru">Địa Chỉ Thường Trú</label>
                                    <input type="text" class="form-control" id="dia_chi_thuong_tru"
                                        name="dia_chi_thuong_tru" placeholder="Địa Chỉ Thường Trú" value="" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ thường trú.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="noi_sinh">Nơi Sinh</label>
                                    <input type="text" class="form-control" id="noi_sinh" name="noi_sinh"
                                        placeholder="Nơi Sinh" value="" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập nơi sinh.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ton_giao">Tôn Giáo</label>
                                    <input type="text" class="form-control" id="ton_giao" name="ton_giao"
                                        placeholder="Tôn Giáo" value="Không" required pattern="^[\p{L}\s]+$">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tôn giáo.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dia_chi_tam_tru">Địa Chỉ Tạm Trú</label>
                                    <input type="text" class="form-control" id="dia_chi_tam_tru" name="dia_chi_tam_tru"
                                        placeholder="Địa Chỉ Tạm Trú" value="" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ tạm trú.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tai_khoan">Tài Khoản</label>
                                    <input type="text" class="form-control" id="tai_khoan" name="tai_khoan"
                                        placeholder="Tài Khoản" value="" readonly required>
                                    <div class="invalid-feedback">
                                        Tài khoản phải trùng với mã sinh viên.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="khoa_hoc">Khóa Học</label>
                                    <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc"
                                        placeholder="Khóa Học" value="" required pattern="^\d{4}$">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập năm hợp lệ.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="he_dao_tao">Hệ Đào Tạo</label>
                                    <select class="form-control select2" id="he_dao_tao" name="he_dao_tao" required>
                                        <option value="">-- Chọn Hệ Đào Tạo--</option>
                                        <option value="Chính quy">Chính quy</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn hệ đào tạo.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mat_khau">Mật Khẩu</label>
                                    <input type="text" class="form-control" id="mat_khau" name="mat_khau"
                                        placeholder="Mật Khẩu" value="" required>
                                    <div class="invalid-feedback">
                                        Mật khẩu phải khớp với số chứng minh thư.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bac_dao_tao">Bậc Đào Tạo</label>
                                    <select class="form-control select2" id="bac_dao_tao" name="bac_dao_tao" required>
                                        <option value="">-- Chọn Bậc Đào Tạo--</option>
                                        <option value="Cao đẳng ngành">Cao đẳng ngành</option>
                                        <option value="Cao đẳng nghề">Cao đẳng nghề</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn bậc đào tạo.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_lop_hoc">Lớp</label>
                                    <select name="id_lop_hoc" id="id_lop_hoc" class="form-control select2"
                                        style="width: 100%;" required>
                                        <option value="">-- Chọn lớp --</option>
                                        @foreach ($lophocs as $lophoc)
                                        @if ($lophoc->trang_thai == 1)
                                        <option value="{{ $lophoc->id}}">{{ $lophoc->ten_lop_hoc }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn lớp.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tinh_trang_hoc">Tình Trạng Học</label>
                                    <select class="form-control select2" id="tinh_trang_hoc" name="tinh_trang_hoc"
                                        required>
                                        <option value="">-- Chọn tình trạng học --</option>
                                        <option value="Đang học">Đang học</option>
                                        <option value="Bảo lưu">Bảo lưu</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn tình trạng học.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hinh_anh_dai_dien">Hình Ảnh Đại Diện</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="hinh_anh_dai_dien"
                                            name="hinh_anh_dai_dien" accept=".jpg, .jpeg, .png">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                    <!-- <input type="file" class="form-control" id="hinh_anh_dai_dien"
                                        name="hinh_anh_dai_dien"> -->
                                    <input type="hidden" id="hinh_anh_dai_dien_hidden" name="hinh_anh_dai_dien_hidden"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group">
                                    <img id="hinh_anh_dai_dien_preview" width="100" height="100" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="savedata" value="create"><i
                                class="fa-regular fa-floppy-disk"></i> Lưu</button>
                        <button type="button" class="btn btn-primary" id="taoBangTenBtn"><i
                                class="fa-regular fa-rectangle-list"></i> Tạo Bảng Tên</button>
                        <button type="button" class="btn btn-primary" id="taoTheSinhVienBtn"><i
                                class="fa-regular fa-rectangle-list"></i> Tạo Thẻ Sinh Viên</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i> Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="themSinhVienExcelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Thêm Sinh Viên Bằng File Excel</h4>
            </div>
            <div class="modal-body">
                <form id="sinhVienExcelForm" name="sinhVienExcelForm" class="form-horizontal"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_lop_hoc_excel">Lớp Học</label>
                            <select name="id_lop_hoc_excel" id="id_lop_hoc_excel" class="form-control select2"
                                style="width: 100%;">
                                <option value="">-- Chọn lớp --</option>
                                @foreach ($lophocs as $lophoc)
                                @if ($lophoc->trang_thai == 1)
                                <option value="{{ $lophoc->id}}">{{ $lophoc->ten_lop_hoc }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="fileExcel">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                        <!-- <input type="file" name="fileExcel" class="form-control"> -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="themSinhVienExcelSubmit">Xác Nhận</button>
                        <a id="taiMauExcelBtn" class="btn btn-info" href="{{ asset('file/mau_excel.xlsx') }}">Tải Mẫu
                            Excel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script type="text/javascript">
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        orderCellsTop: true,
        initComplete: function() {
            var table = this;
            table.api().columns().every(function() {
                var column = this;
                if (column.index() !== 20) {
                    var select = $(
                            '<select class="form-control select2"><option value="">--</option></select>'
                        ).appendTo($(table.api().table().container()).find(
                            '.filter-row th:eq(' + column.index() + ')'))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>');
                    });
                    // $(".filter-row").toggle();
                    select.select2();
                    // select.select2({
                    //     width: 'auto',
                    //     dropdownAutoWidth: true
                    // });
                }
            });
            table.api().columns([2, 3, 4, 5, 7, 8, 9, 10, 11, 13, 14, 16, 17]).visible(
                false);
        },
        ajax: "{{ route('sinhvien.index') }}",
        columnDefs: [{
            "targets": 12,
            "className": 'dt-body-center'
        }],
        columns: [{
                data: 'ma_sv',
                name: 'ma_sv',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="editBtn">' + data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'ten_sinh_vien',
                name: 'ten_sinh_vien'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'so_dien_thoai',
                name: 'so_dien_thoai'
            },
            {
                data: 'so_cmt',
                name: 'so_cmt'
            },
            {
                data: 'gioi_tinh',
                name: 'gioi_tinh',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return 'Nam';
                    } else {
                        return 'Nữ';
                    }
                }
            },
            {
                data: 'ngay_sinh',
                name: 'ngay_sinh',
                render: function(data, type, full, meta) {
                    if (type === 'display' && data !== null) {
                        var date = new Date(data);
                        var formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' +
                            date.getFullYear();
                        return formattedDate;
                    }
                    return data;
                }
            },
            {
                data: 'noi_sinh',
                name: 'noi_sinh'
            },
            {
                data: 'dan_toc',
                name: 'dan_toc',

            },
            {
                data: 'ton_giao',
                name: 'ton_giao'

            },
            {
                data: 'dia_chi_thuong_tru',
                name: 'dia_chi_thuong_tru'
            },
            {
                data: 'dia_chi_tam_tru',
                name: 'dia_chi_tam_tru'
            },
            {
                data: 'hinh_anh_dai_dien',
                name: 'hinh_anh_dai_dien',
                render: function(data, type, full, meta) {
                    if (data) {
                        return '<img src="{{ asset("sinhvien_img") }}/' + data +
                            '" width="100" height="100">';
                    } else {
                        return '';
                    }
                }
            },
            {
                data: 'tai_khoan',
                name: 'tai_khoan',
            },
            {
                data: 'mat_khau',
                name: 'mat_khau',
                render: function(data, type, full, meta) {
                    return '******';
                }
            },
            {
                data: 'khoa_hoc',
                name: 'khoa_hoc'
            },
            {
                data: 'bac_dao_tao',
                name: 'bac_dao_tao'
            },
            {
                data: 'he_dao_tao',
                name: 'he_dao_tao'
            },
            {
                data: 'ten_lop_hoc',
                name: 'ten_lop_hoc'
            },
            {
                data: 'tinh_trang_hoc',
                name: 'tinh_trang_hoc'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        language: {
            "sEmptyTable": "Không có dữ liệu",
            "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
            "sInfoFiltered": "(được lọc từ _MAX_ tổng số bản ghi)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Hiển thị _MENU_ bản ghi",
            "sLoadingRecords": "Đang tải...",
            "sProcessing": "Đang xử lý...",
            "sSearch": "Tìm kiếm:",
            "sZeroRecords": "Không tìm thấy kết quả nào phù hợp",
            "oPaginate": {
                "sFirst": "Đầu",
                "sLast": "Cuối",
                "sNext": "Tiếp",
                "sPrevious": "Trước"
            },
            "oAria": {
                "sSortAscending": ": Sắp xếp tăng dần",
                "sSortDescending": ": Sắp xếp giảm dần"
            }
        },
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                text: 'Sao chép'
            },
            {
                extend: 'excel',
                text: 'Xuất Excel',
                sheetName: 'Sinh Viên',
                title: 'Sinh Viên',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'Xuất PDF'
            },
            {
                extend: 'print',
                text: 'In'
            },
            {
                extend: 'colvis',
                text: 'Hiển thị cột'
            },
            {
                extend: 'pageLength',
                text: 'Số bản ghi trên trang'
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'Tất cả']
        ]
    });
    $("#filterToggle").on("click", function() {
        $(".filter-row").toggle();
        $(".table-cell").css("width", "");
        table.columns.adjust().draw();
    });
    $(".filter-row").toggle();
    $('.reset-filter').on('click', function(e) {
        e.preventDefault();
        var selects = $('.filter-row select');
        selects.val('').trigger('change');
    });
    $('#themSinhVienExcelBtn').click(function() {
        // Hiển thị modal
        $('#themSinhVienExcelModal').modal('show');
    });
    $('#themSinhVienExcelSubmit').click(function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định khi click nút submit

        // Lấy dữ liệu từ form
        var formData = new FormData($('#sinhVienExcelForm')[0]);

        // Gửi Ajax request
        $.ajax({
            url: '{{ route("sinhvien.import") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Xử lý phản hồi thành công
                Swal.fire({
                    title: 'Thêm thành công',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(); // Tải lại trang
                    }
                })
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                // alert('Đã xảy ra lỗi: ' + xhr.responseText);
                Swal.fire({
                    title: 'Không đúng định dạng vui lòng nhập lại',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {

                    }
                })
            }
        });
    });
    $('#ma_sv').on('input', function() {
        var ma_sv = $(this).val();
        var email = ma_sv + '@caothang.edu.vn';
        $('#tai_khoan').val(ma_sv);
        $('#email').val(email);
    });
    $('#so_cmt').on('input', function() {
        var so_cmt = $(this).val();
        $('#mat_khau').val(so_cmt);
    });
    $('#taoBangTenBtn').click(function() {
        var tenSinhVien = $('#ten_sinh_vien').val();
        var maSinhVien = $('#ma_sv').val();
        var lop = $('#id_lop_hoc option:selected').text();
        $.ajax({
            url: "{{ route('sinhvien.index') }}" + '/taobangten/' + tenSinhVien +
                '/' +
                lop,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var downloadLink = response;
                var link = document.createElement('a');
                link.href = downloadLink;
                link.download = maSinhVien + '.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Không đủ thông tin để tạo thẻ',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {}
                })
            }
        });
    });
    $('#taoTheSinhVienBtn').click(function() {
        var maSinhVien = $('#ma_sv').val();
        $.ajax({
            url: "{{ route('sinhvien.index') }}" + '/taothesinhvien/' + maSinhVien,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var downloadLink = response;
                var link = document.createElement('a');
                link.href = downloadLink;
                link.download = maSinhVien + '.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Không đủ thông tin để tạo thẻ',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {

                    }
                })
            }
        });
    });
    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonVal = button.val();
        if (buttonVal == '') {
            $("#showInactiveBtn").val('1');
            button.text('Hiển thị danh sách chính');
            table.ajax.url("{{ route('sinhvien.getInactiveData') }}").load();
        } else {
            $("#showInactiveBtn").val('');
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('sinhvien.index') }}").load();
        }
    });
    $('#datLaiBtn').click(function() {
        $("#id_khoa_filter").empty();
        var khoas = <?php echo json_encode($khoas); ?>;
        $("#id_khoa_filter").append('<option value="0">-- Chọn khoa --</option>');
        $.each(khoas, function(index, khoa) {
            var option = '<option value="' + khoa.id + '">' + khoa
                .ten_khoa +
                '</option>';
            $("#id_khoa_filter").append(option);
        });

        $("#id_chuyen_nganh_filter").empty();
        var chuyennganhs = <?php echo json_encode($chuyennganhs); ?>;
        $("#id_chuyen_nganh_filter").append('<option value="0">-- Chọn chuyên ngành --</option>');
        $.each(chuyennganhs, function(index, chuyennganh) {
            var option = '<option value="' + chuyennganh.id + '">' + chuyennganh
                .ten_chuyen_nganh +
                '</option>';
            $("#id_chuyen_nganh_filter").append(option);
        });
        $("#id_lop_hoc_filter").empty();
        var lophocs = <?php echo json_encode($lophocs); ?>;
        $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
        $.each(lophocs, function(index, lophoc) {
            var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                '</option>';
            $("#id_lop_hoc_filter").append(option);
        });
    });
    $('#xemBtn').click(function() {
        var selectedKhoaId = $("#id_khoa_filter").val();
        var selectedChuyenNganhId = $("#id_chuyen_nganh_filter").val();
        var selectedLopHocId = $("#id_lop_hoc_filter").val();

        if (selectedLopHocId != 0) {
            // Nếu đã chọn lớp học, load danh sách sinh viên theo lớp học
            table.ajax.url("{{ route('sinhvien.getSinhVienByIdLop', '') }}/" + selectedLopHocId).load();
        } else if (selectedChuyenNganhId != 0) {
            // Nếu đã chọn chuyên ngành, load danh sách sinh viên theo chuyên ngành
            table.ajax.url("{{ route('sinhvien.getSinhVienByIdChuyenNganh', '') }}/" +
                selectedChuyenNganhId).load();
        } else if (selectedKhoaId != 0) {
            // Nếu đã chọn khoa, load danh sách sinh viên theo khoa
            table.ajax.url("{{ route('sinhvien.getSinhVienByIdKhoa', '') }}/" + selectedKhoaId).load();
        } else {
            // Nếu không chọn gì cả, load lại toàn bộ danh sách sinh viên
            table.ajax.url("{{ route('sinhvien.index') }}").load();
        }
    });
    $("#id_khoa_filter").change(function() {
        var selectedKhoaId = $(this).val();
        if (selectedKhoaId != 0) {
            $.ajax({
                url: "{{ route('sinhvien.getChuyenNganhByKhoa', '') }}/" + selectedKhoaId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown chuyên ngành
                    $("#id_chuyen_nganh_filter").empty();
                    $("#id_chuyen_nganh_filter").append(
                        '<option value="0">-- Chọn chuyên ngành --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_chuyen_nganh_filter").append('<option value="' +
                            value.id + '">' + value.ten_chuyen_nganh +
                            '</option>');
                    });
                }
            });
            $.ajax({
                url: "{{ route('sinhvien.getLopByKhoa', '') }}/" + selectedKhoaId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown lớp học
                    $("#id_lop_hoc_filter").empty();
                    $("#id_lop_hoc_filter").append(
                        '<option value="0">-- Chọn lớp --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_lop_hoc_filter").append('<option value="' +
                            value.id + '">' + value.ten_lop_hoc +
                            '</option>');
                    });
                }
            });
        } else {
            $("#id_chuyen_nganh_filter").empty();
            var chuyennganhs = <?php echo json_encode($chuyennganhs); ?>;
            $("#id_chuyen_nganh_filter").append('<option value="0">-- Chọn chuyên ngành --</option>');
            $.each(chuyennganhs, function(index, chuyennganh) {
                var option = '<option value="' + chuyennganh.id + '">' + chuyennganh
                    .ten_chuyen_nganh +
                    '</option>';
                $("#id_chuyen_nganh_filter").append(option);
            });
            $("#id_lop_hoc_filter").empty();
            var lophocs = <?php echo json_encode($lophocs); ?>;
            $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
            $.each(lophocs, function(index, lophoc) {
                var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                    '</option>';
                $("#id_lop_hoc_filter").append(option);
            });
        }
    });

    // Lấy danh sách lớp học khi chọn chuyên ngành
    $("#id_chuyen_nganh_filter").change(function() {
        var selectedChuyenNganhId = $(this).val();

        if (selectedChuyenNganhId != 0) {
            $.ajax({
                url: "{{ route('sinhvien.getLopByChuyenNganh', '') }}/" + selectedChuyenNganhId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown lớp học
                    $("#id_lop_hoc_filter").empty();
                    $("#id_lop_hoc_filter").append(
                        '<option value="0">-- Chọn lớp --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_lop_hoc_filter").append('<option value="' + value
                            .id + '">' + value.ten_lop_hoc + '</option>');
                    });
                }
            });
        } else {
            $("#id_lop_hoc_filter").empty();
            var lophocs = <?php echo json_encode($lophocs); ?>;
            $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
            $.each(lophocs, function(index, lophoc) {
                var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                    '</option>';
                $("#id_lop_hoc_filter").append(option);
            });
        }
    });
    $('#createNewBtn').click(function() {
        $('#modalForm').removeClass('was-validated');
        $('#savedata').val("create-Btn");
        $('#ma_sv').removeAttr('readonly');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm ");
        $('#ajaxModelexa').modal('show');
        // Đặt giá trị của input ẩn về null
        $('#hinh_anh_dai_dien_hidden').val('');
        // Đặt giá trị của thẻ <img> về đường dẫn mặc định
        $('#hinh_anh_dai_dien_preview').attr('src', '{{ asset("img/warning.jpg") }}');
        $('#hinh_anh_dai_dien_preview').attr('alt', 'Warning');
        $('#gioi_tinh').val('').trigger('change');
        $('#bac_dao_tao').val('').trigger('change');
        $('#he_dao_tao').val('').trigger('change');
        $('#id_lop_hoc').val('').trigger('change');
        $('#tinh_trang_hoc').val('').trigger('change');
        $("#taoBangTenBtn").hide();
        $("#taoTheSinhVienBtn").hide();
    });
    $('body').on('click', '.editBtn', function() {
        $('#modalForm').removeClass('was-validated');
        $('#ma_sv').attr('readonly', 'readonly');
        $("#taoBangTenBtn").show();
        $("#taoTheSinhVienBtn").show();
        var id = $(this).data('id');
        $.get("{{ route('sinhvien.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#ma_sv').val(data.ma_sv);
            $('#ten_sinh_vien').val(data.ten_sinh_vien);
            $('#email').val(data.email);
            $('#so_dien_thoai').val(data.so_dien_thoai);
            $('#so_cmt').val(data.so_cmt);
            $('#gioi_tinh').val(data.gioi_tinh).trigger('change');
            $('#ngay_sinh').val(data.ngay_sinh);
            $('#noi_sinh').val(data.noi_sinh);
            $('#dan_toc').val(data.dan_toc);
            $('#ton_giao').val(data.ton_giao);
            $('#dia_chi_thuong_tru').val(data.dia_chi_thuong_tru);
            $('#dia_chi_tam_tru').val(data.dia_chi_tam_tru);
            if (data.hinh_anh_dai_dien) {
                var imageSrc = '{{ asset("sinhvien_img") }}/' + data.hinh_anh_dai_dien;
                $('#hinh_anh_dai_dien_preview').attr('src', imageSrc);
                $('#hinh_anh_dai_dien_preview').attr('alt', 'Hình ảnh');
                $('#hinh_anh_dai_dien_hidden').val(data.hinh_anh_dai_dien);
            } else {
                $('#hinh_anh_dai_dien_preview').attr('src', '{{ asset("img/warning.jpg") }}');
                $('#hinh_anh_dai_dien_preview').attr('alt', 'Warning');
                $('#hinh_anh_dai_dien_hidden').val('');
            }
            $('#tai_khoan').val(data.tai_khoan);
            // $('#mat_khau').val(data.mat_khau);
            $('#mat_khau').attr('placeholder', '*********');
            $('#khoa_hoc').val(data.khoa_hoc);
            $('#bac_dao_tao').val(data.bac_dao_tao).trigger('change');
            $('#he_dao_tao').val(data.he_dao_tao).trigger('change');
            $('#id_lop_hoc').val(data.id_lop_hoc).trigger('change');
            $('#tinh_trang_hoc').val(data.tinh_trang_hoc).trigger('change');

        })
    });
    $('#hinh_anh_dai_dien').change(function(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#hinh_anh_dai_dien_preview').attr('src', e.target.result);
                $('#hinh_anh_dai_dien_hidden').val($('#ma_sv').val());
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
    $('#savedata').click(function(e) {
        e.preventDefault();
        if ($('#modalForm')[0].checkValidity()) {
            $(this).html('Đang gửi ...');
            var formData = new FormData($('#modalForm')[0]);
            $.ajax({
                data: formData,
                url: "{{ route('sinhvien.store') }}",
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#modalForm').trigger("reset");
                    $('#ajaxModelexa').modal('hide');
                    $('#savedata').html('Lưu');
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                        icon: 'success',
                        title: 'Thành Công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    table.draw();
                },
                error: function(data) {
                    table.draw();
                    console.log('Error:', data);
                    $('#savedata').html('Lưu');
                }
            });
        } else {
            $('#modalForm').addClass('was-validated');
        }
    });

    $('body').on('click', '.deleteBtn', function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Bạn Có Muốn Xóa',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác Nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('sinhvien.destroy', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Xóa Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
    $('body').on('click', '.restoreBtn', function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Bạn Có Muốn Khôi Phục',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác Nhận'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('sinhvien.restore', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Khôi Phục Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
});
</script>
@endsection