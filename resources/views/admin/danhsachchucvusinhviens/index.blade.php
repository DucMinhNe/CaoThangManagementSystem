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
                        <th>Tên Sinh Viên</th>
                        <th>Chức Vụ</th>
                        <th>Lớp Học</th>
                        <th width="72px" class="text-center"><a href="#" id="filterToggle">Bộ Lọc</a></th>
                    </tr>
                    <tr class="filter-row">
                        <th width="30px"></th>
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
                        <th>Tên Sinh Viên</th>
                        <th>Chức Vụ</th>
                        <th>Lớp Học</th>
                        <th width="72px"></th>
                    </tr>
                </tfoot>
            </table>
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
                            <label for="id_lop_hoc">Lớp học</label>
                            <select name="id_lop_hoc" id="id_lop_hoc" class="form-control select2" style="width: 100%;">
                                <option value="0">-- Chọn lớp học --</option>
                                @foreach ($lophocs as $lophoc)
                                <option value="{{$lophoc->id}}">{{ $lophoc->ten_lop_hoc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_sv">Tên Sinh Viên</label>
                            <select name="ma_sv" id="ma_sv" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Chọn sinh viên --</option>
                                @foreach ($sinhviens as $sinhvien)
                                @if ($sinhvien->trang_thai == 1)
                                <option value="{{ $sinhvien->ma_sv }}">{{ $sinhvien->ma_sv }} -
                                    {{ $sinhvien->ten_sinh_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn sinh viên.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_chuc_vu">Chức Vụ</label>
                            <select name="id_chuc_vu" id="id_chuc_vu" class="form-control select2" style="width: 100%;"
                                required>
                                <option value="">-- Chọn chức vụ --</option>
                                @foreach ($chucvus as $chucvu)
                                @if ($chucvu->trang_thai == 1)
                                <option value="{{ $chucvu->id }}">{{ $chucvu->ten_chuc_vu }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn chức vụ.
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
                if (column.index() !== 0 && column.index() !== 4) {
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
        ajax: "{{ route('danhsachchucvusinhvien.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
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
                data: 'ten_chuc_vu',
                name: 'ten_chuc_vu'
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
            table.ajax.url("{{ route('danhsachchucvusinhvien.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('danhsachchucvusinhvien.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#modalForm').removeClass('was-validated');
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#ma_sv').val('').trigger('change');
        $('#id_chuc_vu').val('').trigger('change');
        $('#id_lop_hoc').val('0').trigger('change');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });
    var edit = 0;
    $('body').on('click', '.editBtn', function() {
        $('#modalForm').removeClass('was-validated');
        var id = $(this).data('id');
        $.get("{{ route('danhsachchucvusinhvien.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            edit = 1;
            $('#id_lop_hoc').val(data.id_lop_hoc).trigger('change');
            $('#id').val(data.id);
            $('#id_chuc_vu').val(data.id_chuc_vu).trigger('change');
            $('#ma_sv').val(data.ma_sv).trigger('change');
        })
        edit = 0;
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        if ($('#modalForm')[0].checkValidity()) {
            $(this).html('Đang gửi ...');
            $.ajax({
                data: $('#modalForm').serialize(),
                url: "{{ route('danhsachchucvusinhvien.store') }}",
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
                    url: "{{ route('danhsachchucvusinhvien.destroy', '') }}/" + id,
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
                    url: "{{ route('danhsachchucvusinhvien.restore', '') }}/" + id,
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
    $("#id_lop_hoc").change(function() {
        var selectedLopHocId = $(this).val();
        if (selectedLopHocId != 0 && edit == 0) {
            $.ajax({
                url: "{{ route('lay-sinhvien-theo-lophoc', '') }}/" + selectedLopHocId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $("#ma_sv").empty();
                    $("#ma_sv").append(
                        '<option value="">-- Chọn học sinh --</option>');
                    $.each(response, function(key, value) {
                        $("#ma_sv").append('<option value="' + value.ma_sv + '">' +
                            value.ma_sv + ' - ' + value.ten_sinh_vien +
                            '</option>');
                    });
                }
            });
        } else {
            $("#ma_sv").empty();
            var sinhviens = <?php echo json_encode($sinhviens); ?>;
            $("#ma_sv").append('<option value="">-- Chọn học sinh --</option>');
            $.each(sinhviens, function(index, sinhvien) {
                var option = '<option value="' + sinhvien.ma_sv + '">' + sinhvien.ma_sv +
                    ' - ' +
                    sinhvien
                    .ten_sinh_vien +
                    '</option>';
                $("#ma_sv").append(option);
            });
            edit = 0;
        }
    });
});
</script>
@endsection