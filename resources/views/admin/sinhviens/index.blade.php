@extends('admin.sinhviens.layout')
@section('content')
<section>
    <div class="container">
        <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button>
        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm</a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>Mã Sinh Viên</th>
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
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Mã Sinh Viên</th>
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
                        <th width="280px">Hành Động</th>
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
                                </div>
                                <div class="form-group">
                                    <label for="ten_sinh_vien">Tên Sinh Viên</label>
                                    <input type="text" class="form-control" id="ten_sinh_vien" name="ten_sinh_vien"
                                        placeholder="Tên Sinh Viên" value="" required>
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
                                    <label for="so_cmt">Số CMT</label>
                                    <input type="text" class="form-control" id="so_cmt" name="so_cmt"
                                        placeholder="Số CMT" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="gioi_tinh">Giới Tính</label>
                                    <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
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
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="khoa_hoc">Khóa Học</label>
                                    <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc"
                                        placeholder="Khóa Học" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="bac_dao_tao">Bậc Đào Tạo</label>
                                    <input type="text" class="form-control" id="bac_dao_tao" name="bac_dao_tao"
                                        placeholder="Bậc Đào Tạo" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="he_dao_tao">Hệ Đào Tạo</label>
                                    <input type="text" class="form-control" id="he_dao_tao" name="he_dao_tao"
                                        placeholder="Hệ Đào Tạo" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_lop_hoc">Lớp </label>
                                    <input type="text" class="form-control" id="id_lop_hoc" name="id_lop_hoc"
                                        placeholder="ID Lớp Học" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tinh_trang_hoc">Tình Trạng Học</label>
                                    <input type="text" class="form-control" id="tinh_trang_hoc" name="tinh_trang_hoc"
                                        placeholder="Tình Trạng Học" value="" required>
                                </div>

                            </div>
                            <div class="col-md-4">
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
                                    <img id="hinh_anh_dai_dien_preview" width="90" height="90" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="savedata" value="create">Lưu</button>
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
        ajax: "{{ route('sinhvien.index') }}",
        columnDefs: [{
            "visible": false,
            "targets": 1
        }, {
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
            "targets": 5
        }, {
            "visible": false,
            "targets": 6
        }, {
            "visible": false,
            "targets": 7
        }, {
            "visible": false,
            "targets": 8
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
                name: 'gioi_tinh'
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
                        return '<img src="{{ asset("sinhvien_img") }}/' + data +
                            '" width="50" height="50">';
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
    });

    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();
        if (buttonText === 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('sinhvien.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('sinhvien.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
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
    });
    $('body').on('click', '.editBtn', function() {
        $('#ma_sv').attr('readonly', 'readonly');
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
            $('#gioi_tinh option[value="' + data.gioi_tinh + '"]').prop('selected', true);
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
            $('#mat_khau').attr('placeholder', '******');
            $('#khoa_hoc').val(data.khoa_hoc);
            $('#bac_dao_tao').val(data.bac_dao_tao);
            $('#he_dao_tao').val(data.he_dao_tao);
            $('#id_lop_hoc').val(data.id_lop_hoc);
            $('#tinh_trang_hoc').val(data.tinh_trang_hoc);

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
        $(this).html('Sending..');
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
        if (confirm("Bạn có muốn xóa?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ route('sinhvien.destroy', '') }}/" + id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });
    $('body').on('click', '.restoreBtn', function() {
        var id = $(this).data("id");
        if (confirm("Bạn có muốn khôi phục?")) {
            $.ajax({
                type: "GET",
                url: "{{ route('sinhvien.restore', '') }}/" + id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
</script>
@endsection