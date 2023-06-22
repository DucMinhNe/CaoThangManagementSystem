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
            <a id="showInactiveBtn" class="btn btn-primary" href="javascript:void(0)">Hiển thị Trạng thái 0</a>
            <a class="btn btn-success" href="javascript:void(0)" id="createNewBtn">
                <i class="fa-solid fa-circle-plus"></i> Thêm
            </a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th width="30px">STT</th>
                        <th>Tên Lớp Học Phần</th>
                        <th>Lớp </th>
                        <th>Giảng Viên 1</th>
                        <th>Giảng Viên 2</th>
                        <th>Giảng Viên 3</th>
                        <th>Tên Môn</th>
                        <th>Mở Lớp</th>
                        <th width="72px"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="30px">STT</th>
                        <th>Tên Lớp Học Phần</th>
                        <th>Lớp </th>
                        <th>Giảng Viên 1</th>
                        <th>Giảng Viên 2</th>
                        <th>Giảng Viên 3</th>
                        <th>Tên Môn</th>
                        <th>Mở Lớp</th>
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
                            <label for="ten_lop_hoc_phan">Tên Lớp Học Phần</label>
                            <input type="text" class="form-control" id="ten_lop_hoc_phan" name="ten_lop_hoc_phan"
                                placeholder="Tên Lớp Học Phần" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="id_lop_hoc">Lớp</label>
                            <select name="id_lop_hoc" id="id_lop_hoc" class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn lớp --</option>
                                @foreach ($lophocs as $lophoc)
                                @if ($lophoc->trang_thai == 1)
                                <option value="{{ $lophoc->id}}">{{ $lophoc->ten_lop_hoc }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_gv_1">Giảng Viên 1</label>
                            <select name="ma_gv_1" id="ma_gv_1" class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn giảng viên --</option>
                                @foreach ($giangviens as $giangvien)
                                @if ($giangvien->trang_thai == 1)
                                <option value="{{ $giangvien->ma_gv }}">{{ $giangvien->ten_giang_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_gv_2">Giảng Viên 2</label>
                            <select name="ma_gv_2" id="ma_gv_2" class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn giảng viên --</option>
                                @foreach ($giangviens as $giangvien)
                                @if ($giangvien->trang_thai == 1)
                                <option value="{{ $giangvien->ma_gv }}">{{ $giangvien->ten_giang_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_gv_3">Giảng Viên 3</label>
                            <select name="ma_gv_3" id="ma_gv_3" class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn giảng viên --</option>
                                @foreach ($giangviens as $giangvien)
                                @if ($giangvien->trang_thai == 1)
                                <option value="{{ $giangvien->ma_gv }}">{{ $giangvien->ten_giang_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_ct_chuong_trinh_dao_tao">Tên Môn Học</label>
                            <select name="id_ct_chuong_trinh_dao_tao" id="id_ct_chuong_trinh_dao_tao"
                                class="form-control select2" style="width: 100%;">
                                @foreach ($ctchuongtrinhdaotaos as $ctchuongtrinhdaotao)
                                @if ($ctchuongtrinhdaotao->trang_thai == 1)
                                <option value="{{ $ctchuongtrinhdaotao->id }}">
                                    {{ $ctchuongtrinhdaotao->ten_mon_hoc_khoa_hoc }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mo_lop">Mở Lớp</label>
                            <input type="text" class="form-control" id="mo_lop" name="mo_lop" placeholder="Mở Lớp"
                                value="" required>
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
        ajax: "{{ route('lophocphan.index') }}",
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
                data: 'ten_lop_hoc_phan',
                name: 'ten_lop_hoc_phan'
            },
            {
                data: 'ten_lop_hoc',
                name: 'ten_lop_hoc'
            },
            {
                data: 'ten_gv_1',
                name: 'ten_gv_1'
            },
            {
                data: 'ten_gv_2',
                name: 'ten_gv_2'
            },
            {
                data: 'ten_gv_3',
                name: 'ten_gv_3'
            },
            {
                data: 'ten_mon_hoc_khoa_hoc',
                name: 'ten_mon_hoc_khoa_hoc'
            },
            {
                data: 'mo_lop',
                name: 'mo_lop'
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
    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();

        if (buttonText === 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('lophocphan.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('lophocphan.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
        $('#ma_gv_1').val('').trigger('change');
        $('#ma_gv_2').val('').trigger('change');
        $('#ma_gv_3').val('').trigger('change');
    });

    $('body').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.get("{{ route('lophocphan.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#ten_lop_hoc_phan').val(data.ten_lop_hoc_phan);
            $('#id_lop_hoc').val(data.id_lop_hoc).trigger('change');
            $('#ma_gv_1').val(data.ma_gv_1).trigger('change');
            $('#ma_gv_2').val(data.ma_gv_2).trigger('change');
            $('#ma_gv_3').val(data.ma_gv_3).trigger('change');
            $('#id_ct_chuong_trinh_dao_tao').val(data.id_ct_chuong_trinh_dao_tao).trigger(
                'change');
            $('#mo_lop').val(data.mo_lop);

        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('lophocphan.store') }}",
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
                    url: "{{ route('lophocphan.destroy', '') }}/" + id,
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
                    url: "{{ route('lophocphan.restore', '') }}/" + id,
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