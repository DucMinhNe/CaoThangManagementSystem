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
<section>
    <div class="container">
        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4">
            <li class="nav-item mr-1">
                <button id="showInactiveBtn" class="btn btn-primary" type="button">Hiển thị danh sách đã xóa</button>
            </li>
            <li class="nav-item">
                <button class="btn btn-success" type="button" id="createNewBtn">
                    <i class="fa-solid fa-circle-plus"></i> Thêm
                </button>
            </li>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th width="50px">Mã Giảng Viên</th>
                        <th>Tên Giảng Viên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>CMND/CCCD</th>
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
                        <th>Bộ Môn</th>
                        <th>Chức Vụ</th>
                        <th width="100px">Tình Trạng Làm Việc</th>
                        <th width="72px"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="50px">Mã Giảng Viên</th>
                        <th>Tên Giảng Viên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>CMND/CCCD</th>
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
                        <th>Bộ Môn</th>
                        <th>Chức Vụ</th>
                        <th width="100px">Tình Trạng Làm Việc</th>
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
                                    <label for="ma_gv">Mã Giảng Viên</label>
                                    <input type="text" class="form-control" id="ma_gv" name="ma_gv"
                                        placeholder="Mã Giảng Viên" value="" required pattern="[0-9]{10}">
                                </div>
                                <div class="form-group">
                                    <label for="ten_giang_vien">Tên Giảng Viên</label>
                                    <input type="text" class="form-control" id="ten_giang_vien" name="ten_giang_vien"
                                        placeholder="Tên Giảng Viên" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="so_dien_thoai">Số Điện Thoại</label>
                                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                        placeholder="Số Điện Thoại" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="so_cmt">CMND/CCCD</label>
                                    <input type="text" class="form-control" id="so_cmt" name="so_cmt"
                                        placeholder="Số CMT" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="gioi_tinh">Giới Tính</label>
                                    <select class="form-control select2" id="gioi_tinh" name="gioi_tinh" required>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ngay_sinh">Ngày Sinh</label>
                                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                        placeholder="Ngày Sinh" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="noi_sinh">Nơi Sinh</label>
                                    <input type="text" class="form-control" id="noi_sinh" name="noi_sinh"
                                        placeholder="Nơi Sinh" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dan_toc">Dân Tộc</label>
                                    <input type="text" class="form-control" id="dan_toc" name="dan_toc"
                                        placeholder="Dân Tộc" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="ton_giao">Tôn Giáo</label>
                                    <input type="text" class="form-control" id="ton_giao" name="ton_giao"
                                        placeholder="Tôn Giáo" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dia_chi_thuong_tru">Địa Chỉ Thường Trú</label>
                                    <input type="text" class="form-control" id="dia_chi_thuong_tru"
                                        name="dia_chi_thuong_tru" placeholder="Địa Chỉ Thường Trú" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="dia_chi_tam_tru">Địa Chỉ Tạm Trú</label>
                                    <input type="text" class="form-control" id="dia_chi_tam_tru" name="dia_chi_tam_tru"
                                        placeholder="Địa Chỉ Tạm Trú" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tai_khoan">Tài Khoản</label>
                                    <input type="text" class="form-control" id="tai_khoan" name="tai_khoan"
                                        placeholder="Tài Khoản" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="mat_khau">Mật Khẩu</label>
                                    <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                                        placeholder="Mật Khẩu" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="tinh_trang_lam_viec">Tình Trạng Làm Việc</label>
                                    <select class="form-control select2" id="tinh_trang_lam_viec"
                                        name="tinh_trang_lam_viec" style="width: 100%;">
                                        <option selected="selected" value="1">Đang Làm Việc</option>
                                        <option value="0">Ngưng Làm Việc</option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_bo_mon">Bộ Môn</label>
                                    <select name="id_bo_mon" id="id_bo_mon" class="form-control select2"
                                        style="width: 100%;">
                                        <option value="">-- Chọn Bộ Môn --</option>
                                        @foreach ($bomons as $bomon)
                                        @if ($bomon->trang_thai == 1)
                                        <option value="{{ $bomon->id }}">{{ $bomon->ten_bo_mon }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_chuc_vu">Chức Vụ</label>
                                    <select name="id_chuc_vu" id="id_chuc_vu" class="form-control select2"
                                        style="width: 100%;">
                                        @foreach ($chucvus as $chucvu)
                                        @if ($chucvu->trang_thai == 1)
                                        <option value="{{ $chucvu->id }}">{{ $chucvu->ten_chuc_vu }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hinh_anh_dai_dien">Hình Ảnh Đại Diện</label>
                                    <input type="file" class="form-control" id="hinh_anh_dai_dien"
                                        name="hinh_anh_dai_dien">
                                    <input type="hidden" id="hinh_anh_dai_dien_hidden" name="hinh_anh_dai_dien_hidden"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="hinh_anh_dai_dien_preview" width="260" height="240" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="savedata" value="create"><i
                                class="fa-regular fa-floppy-disk"></i> Lưu</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i> Hủy</button>
                    </div>
                </form>
                <!-- <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
                    <a class="btn btn-info" href="javascript:void(0)" id="clearImg"> Xóa Hình</a>
                </ul> -->
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
        ajax: "{{ route('giangvien.index') }}",
        columnDefs: [{
            "visible": false,
            "targets": 2
        }, {
            "visible": false,
            "targets": 3
        }, {
            "visible": false,
            "targets": 4
        }, {
            "visible": false,
            "targets": 7
        }, {
            "visible": false,
            "targets": 8
        }, {
            "visible": false,
            "targets": 9
        }, {
            "visible": false,
            "targets": 10
        }, {
            "visible": false,
            "targets": 11
        }, {
            "targets": 12,
            className: 'dt-body-center'
        }, {
            "visible": false,
            "targets": 13
        }, {
            "visible": false,
            "targets": 14
        }],
        columns: [{
                data: 'ma_gv',
                name: 'ma_gv',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="editBtn">' + data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'ten_giang_vien',
                name: 'ten_giang_vien'
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
                name: 'ngay_sinh'
            },
            {
                data: 'noi_sinh',
                name: 'noi_sinh'
            },
            {
                data: 'dan_toc',
                name: 'dan_toc'
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
                        return '<img src="{{ asset("giangvien_img") }}/' + data +
                            '" width="80" height="80">';
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
                    return '****';
                }
            },
            {
                data: 'ten_bo_mon',
                name: 'ten_bo_mon'
            },
            {
                data: 'ten_chuc_vu',
                name: 'ten_chuc_vu'
            },
            {
                data: 'tinh_trang_lam_viec',
                name: 'tinh_trang_lam_viec',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return 'Đang làm việc';
                    } else {
                        return 'Ngừng làm việc';
                    }
                }
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
                sheetName: 'Giảng Viên',
                title: 'Giảng Viên',
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
    });

    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();
        if (buttonText === 'Hiển thị danh sách đã xóa') {
            button.text('Hiển thị danh sách chính');
            table.ajax.url("{{ route('giangvien.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('giangvien.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#ma_gv').removeAttr('readonly');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm ");
        $('#ajaxModelexa').modal('show');
        // Đặt giá trị của input ẩn về null
        $('#hinh_anh_dai_dien_hidden').val('');
        // Đặt giá trị của thẻ <img> về đường dẫn mặc định
        $('#hinh_anh_dai_dien_preview').attr('src', '{{ asset("img/warning.jpg") }}');
        $('#hinh_anh_dai_dien_preview').attr('alt', 'Warning');
    });
    $('body').on('click', '.editBtn', function() {
        $('#ma_gv').attr('readonly', 'readonly');
        var id = $(this).data('id');
        $.get("{{ route('giangvien.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#ma_gv').val(data.ma_gv);
            $('#ten_giang_vien').val(data.ten_giang_vien);
            $('#email').val(data.email);
            $('#so_dien_thoai').val(data.so_dien_thoai);
            $('#so_cmt').val(data.so_cmt);
            $('#gioi_tinh').val(data.gioi_tinh).trigger('change');
            // $('#gioi_tinh option[value="' + data.gioi_tinh + '"]').prop('selected', true);
            $('#ngay_sinh').val(data.ngay_sinh);
            $('#noi_sinh').val(data.noi_sinh);
            $('#dan_toc').val(data.dan_toc);
            $('#ton_giao').val(data.ton_giao);
            $('#dia_chi_thuong_tru').val(data.dia_chi_thuong_tru);
            $('#dia_chi_tam_tru').val(data.dia_chi_tam_tru);
            if (data.hinh_anh_dai_dien) {
                var imageSrc = '{{ asset("giangvien_img") }}/' + data.hinh_anh_dai_dien;
                $('#hinh_anh_dai_dien_preview').attr('src', imageSrc);
                $('#hinh_anh_dai_dien_preview').attr('alt', 'Hình ảnh');
                $('#hinh_anh_dai_dien_hidden').val(data.hinh_anh_dai_dien);
            } else {
                $('#hinh_anh_dai_dien_preview').attr('src', '{{ asset("img/warning.jpg") }}');
                $('#hinh_anh_dai_dien_preview').attr('alt', 'Warning');
                $('#hinh_anh_dai_dien_hidden').val('');
            }
            $('#tai_khoan').val(data.tai_khoan);
            //$('#mat_khau').val(data.mat_khau);
            $('#mat_khau').attr('placeholder', '******');
            $('#id_bo_mon').val(data.id_bo_mon).trigger('change');
            $('#id_chuc_vu').val(data.id_chuc_vu).trigger('change');
            $('#tinh_trang_lam_viec').val(data.tinh_trang_lam_viec).trigger('change');

        })
    });
    $('#hinh_anh_dai_dien').change(function(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#hinh_anh_dai_dien_preview').attr('src', e.target.result);
                $('#hinh_anh_dai_dien_hidden').val($('#ma_gv').val());
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        var formData = new FormData($('#modalForm')[0]);
        $.ajax({
            data: formData,
            url: "{{ route('giangvien.store') }}",
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
                console.log('Error:', data);
                $('#savedata').html('Lưu');
            }
        });
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
                    url: "{{ route('giangvien.destroy', '') }}/" + id,
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
                    url: "{{ route('giangvien.restore', '') }}/" + id,
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