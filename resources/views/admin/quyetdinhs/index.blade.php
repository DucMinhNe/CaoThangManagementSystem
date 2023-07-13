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
                        <th width="30px">STT</th>
                        <th>Người Ra Quyết Định</th>
                        <th>Ngày Ra Quyết Định</th>
                        <th>Nội Dung</th>
                        <th>Hiệu Lực Bắt Đầu</th>
                        <th>Hiệu Lực Đến</th>
                        <th width="72px" class="text-center"><a href="#" id="filterToggle">Bộ Lọc</a></th>
                    </tr>
                    <tr class="filter-row">
                        <th width="30px"></th>
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
                        <th width="30px">STT</th>
                        <th>Người Ra Quyết Định</th>
                        <th>Ngày Ra Quyết Định</th>
                        <th>Nội Dung</th>
                        <th>Hiệu Lực Bắt Đầu</th>
                        <th>Hiệu Lực Đến</th>
                        <th width="72px"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="modalForm" name="modalForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ma_gv_ra_quyet_dinh">Người Ra Quyết Định</label>
                            <select name="ma_gv_ra_quyet_dinh" id="ma_gv_ra_quyet_dinh" class="form-control select2"
                                style="width: 100%;" required>
                                <option value="">-- Chọn giảng viên--</option>
                                @foreach ($giangviens as $giangvien)
                                @if ($giangvien->trang_thai == 1)
                                <option value="{{ $giangvien->ma_gv }}">{{ $giangvien->ten_giang_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn người ra quyết định.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ngay_ra_quyet_dinh">Ngày Ra Quyết Định</label>
                            <input type="date" class="form-control" id="ngay_ra_quyet_dinh" name="ngay_ra_quyet_dinh"
                                placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn ngày ra quyết định.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noi_dung">Nội Dung</label>
                            <input type="text" class="form-control" id="noi_dung" name="noi_dung" placeholder="Nội Dung"
                                value="" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập nội dung.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hieu_luc_bat_dau">Hiệu Lực Bắt Đầu</label>
                            <input type="date" class="form-control" id="hieu_luc_bat_dau" name="hieu_luc_bat_dau"
                                placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn hiệu lực bắt đầu.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hieu_luc_ket_thuc">Hiệu Lực Đến</label>
                            <input type="date" class="form-control" id="hieu_luc_ket_thuc" name="hieu_luc_ket_thuc"
                                placeholder="" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="savedata" value="create"><i
                                class="fa-regular fa-floppy-disk"></i>
                            Lưu</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i> Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ctquyetdinhModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ctquyetdinhmodelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="ctquyetdinhForm" name="ctquyetdinhForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_quyet_dinh" id="id_quyet_dinh">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ma_sv_nhan_quyet_dinh">Sinh Viên</label>
                            <select name="ma_sv_nhan_quyet_dinh" id="ma_sv_nhan_quyet_dinh" class="form-control select2"
                                style="width: 100%;" required>
                                <option value="">-- Chọn Sinh Viên --</option>
                                @foreach ($sinhviens as $sinhvien)
                                @if ($sinhvien->trang_thai == 1)
                                <option value="{{ $sinhvien->ma_sv }}">{{ $sinhvien->ten_sinh_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn sinh viên.
                            </div>
                        </div>
                        <button class="btn btn-success" type="button" id="themCTQuyetDinhBtn">
                            <i class="fa-solid fa-circle-plus"></i> Thêm
                        </button>
                        <button id="xemCTQuyetDinhDaXoa" class="btn btn-primary" type="button">Hiển thị danh sách đã
                            xóa</button>
                        <table id="example2" class="table table-bordered table-striped ctquyetdinh-table"
                            style="width:430px;">
                            <thead>
                                <tr>
                                    <th width="30px">STT</th>
                                    <th>Quyết định</th>
                                    <th width="200px">Sinh Viên</th>
                                    <th width="200px">Lớp Học</th>
                                    <th width="72px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <button type="submit" class="btn btn-primary" id="savedata" value="create"><i
                                class="fa-regular fa-floppy-disk"></i> Lưu</button> -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i> Hủy</button>
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
        orderCellsTop: true,
        initComplete: function() {
            var table = this;
            table.api().columns().every(function() {
                var column = this;
                if (column.index() !== 0 && column.index() !== 6) {
                    var select = $(
                            '<select class="form-control select2"><option value="">--Chọn--</option></select>'
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
                    $(".filter-row").toggle();
                    select.select2();
                }
            });
        },
        ajax: "{{ route('quyetdinh.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="ctQuyetDinhBtn">' + data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'ten_giang_vien',
                name: 'ten_giang_vien'
            },
            {
                data: 'ngay_ra_quyet_dinh',
                name: 'ngay_ra_quyet_dinh',
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
                data: 'noi_dung',
                name: 'noi_dung'
            },
            {
                data: 'hieu_luc_bat_dau',
                name: 'hieu_luc_bat_dau',
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
                data: 'hieu_luc_ket_thuc',
                name: 'hieu_luc_ket_thuc',
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
                text: 'Xuất Excel'
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
    var ctquyetdinhtable = $('.ctquyetdinh-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        info: false,
        autoWidth: false,
        paging: true,
        ajax: "{{ route('ctquyetdinh.getChiTietQuyetDinhByQuyetDinh', '') }}/0",
        columns: [{
                data: 'id',
                name: 'id',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="editCTQuyetDinhBtn">' +
                        data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'id_quyet_dinh',
                name: 'id_quyet_dinh'
            },
            {
                data: 'ten_sinh_vien',
                name: 'ten_sinh_vien'
            },
            {
                data: 'ten_lop_hoc',
                name: 'ten_lop_hoc'
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
    });
    $("#filterToggle").on("click", function() {
        $(".filter-row").toggle();
    });
    $('.reset-filter').on('click', function(e) {
        e.preventDefault();
        var selects = $('.filter-row select');
        selects.val('').trigger('change');
    });
    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();

        if (buttonText == 'Hiển thị danh sách đã xóa') {
            button.text('Hiển thị danh sách chính');
            table.ajax.url("{{ route('quyetdinh.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('quyetdinh.index') }}").load();
        }
    });
    $('#xemCTQuyetDinhDaXoa').click(function() {
        var button = $(this);
        var idqd = $('#ctquyetdinhForm input#id_quyet_dinh').val();
        var buttonText = button.text();
        if (buttonText == 'Hiển thị danh sách đã xóa') {
            button.text('Hiển thị danh sách chính');
            ctquyetdinhtable.ajax.url(
                    "{{ route('ctquyetdinh.getChiTietQuyetDinhByQuyetDinhDaXoa', '') }}/" + idqd)
                .load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            ctquyetdinhtable.ajax.url("{{ route('ctquyetdinh.getChiTietQuyetDinhByQuyetDinh', '') }}/" +
                    idqd)
                .load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#modalForm').removeClass('was-validated');
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#ma_gv_ra_quyet_dinh').val('').trigger('change');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });

    $('body').on('click', '.editBtn', function() {
        $('#modalForm').removeClass('was-validated');
        var id = $(this).data('id');
        $.get("{{ route('quyetdinh.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#ma_gv_ra_quyet_dinh').val(data.ma_gv_ra_quyet_dinh).trigger('change');
            $('#ngay_ra_quyet_dinh').val(data.ngay_ra_quyet_dinh);
            $('#noi_dung').val(data.noi_dung);
            $('#hieu_luc_bat_dau').val(data.hieu_luc_bat_dau);
            $('#hieu_luc_ket_thuc').val(data.hieu_luc_ket_thuc);
        })
    });
    $('body').on('click', '.ctQuyetDinhBtn', function() {
        var id = $(this).data('id');
        $('#id_quyet_dinh').val(id);
        $('#ctquyetdinhModal').modal('show');
        ctquyetdinhtable.ajax.url("{{ route('ctquyetdinh.getChiTietQuyetDinhByQuyetDinh', '') }}/" + id)
            .load();
    });
    $('#themCTQuyetDinhBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Đang gửi ...');
        $.ajax({
            data: $('#ctquyetdinhForm').serialize(),
            url: "{{ route('ctquyetdinh.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'success',
                    title: 'Thành Công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#themCTQuyetDinhBtn').html('Thêm');
                ctquyetdinhtable.draw();
            },
            error: function(data) {
                $('#themCTQuyetDinhBtn').html('Thêm');
                console.log('Error:', data);
            }
        });
    });
    $('#savedata').click(function(e) {
        e.preventDefault();
        if ($('#modalForm')[0].checkValidity()) {
            $(this).html('Đang gửi ...');
            $.ajax({
                data: $('#modalForm').serialize(),
                url: "{{ route('quyetdinh.store') }}",
                type: "POST",
                dataType: 'json',
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
                    url: "{{ route('quyetdinh.destroy', '') }}/" + id,
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
    $('body').on('click', '.deleteCTQuyetDinhBtn', function() {
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
                    url: "{{ route('ctquyetdinh.destroy', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Xóa Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        ctquyetdinhtable.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
    $('body').on('click', '.restoreCTQuyetDinhBtn', function() {
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
                    url: "{{ route('ctquyetdinh.restore', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Khôi Phục Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        ctquyetdinhtable.draw();
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
                    url: "{{ route('quyetdinh.restore', '') }}/" + id,
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