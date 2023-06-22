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
                        <th>Tên Sinh Viên</th>
                        <th>Chuyên Cần</th>
                        <th>TBKT</th>
                        <th>Thi 1</th>
                        <th>Thi 2</th>
                        <th>Tổng Kết 1</th>
                        <th>Tổng Kết 2</th>
                        <th width="72px"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="30px">STT</th>
                        <th>Tên Lớp Học Phần</th>
                        <th>Tên Sinh Viên</th>
                        <th>Chuyên Cần</th>
                        <th>TBKT</th>
                        <th>Thi 1</th>
                        <th>Thi 2</th>
                        <th>Tổng Kết 1</th>
                        <th>Tổng Kết 2</th>
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
                            <label for="id_lop_hoc_phan">Lớp Học Phần</label>
                            <select name="id_lop_hoc_phan" id="id_lop_hoc_phan" class="form-control select2"
                                style="width: 100%;">
                                @foreach ($lophocphans as $lophocphan)
                                @if ($lophocphan->trang_thai == 1)
                                <option value="{{ $lophocphan->id }}">{{ $lophocphan->ten_lop_hoc_phan }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_sv">Sinh Viên</label>
                            <select name="ma_sv" id="ma_sv" class="form-control select2" style="width: 100%;">
                                @foreach ($sinhviens as $sinhvien)
                                @if ($sinhvien->trang_thai == 1)
                                <option value="{{ $sinhvien->ma_sv }}">{{ $sinhvien->ten_sinh_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="chuyen_can">Chuyên Cần</label>
                            <input type="text" class="form-control" id="chuyen_can" name="chuyen_can"
                                placeholder="Chuyên Cần" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="tbkt">TBKT</label>
                            <input type="text" class="form-control" id="tbkt" name="tbkt" placeholder="TBKT" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="thi_1">Thi 1</label>
                            <input type="text" class="form-control" id="thi_1" name="thi_1" placeholder="Thi 1" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="thi_2">Thi 2</label>
                            <input type="text" class="form-control" id="thi_2" name="thi_2" placeholder="Thi 2" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label for="tong_ket_1">Tổng Kết 1</label>
                            <input type="text" class="form-control" id="tong_ket_1" name="tong_ket_1"
                                placeholder="Tổng Kết 1" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="tong_ket_2">Tổng Kết 2</label>
                            <input type="text" class="form-control" id="tong_ket_2" name="tong_ket_2"
                                placeholder="Tổng Kết 2" value="" required>
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
        ajax: "{{ route('ctlophocphan.index') }}",
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
                data: 'ten_sinh_vien',
                name: 'ten_sinh_vien'
            },
            {
                data: 'chuyen_can',
                name: 'chuyen_can'
            },
            {
                data: 'tbkt',
                name: 'tbkt'
            },
            {
                data: 'thi_1',
                name: 'thi_1'
            },
            {
                data: 'thi_2',
                name: 'thi_2'
            },
            {
                data: 'tong_ket_1',
                name: 'tong_ket_1'
            },
            {
                data: 'tong_ket_2',
                name: 'tong_ket_2'
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
            table.ajax.url("{{ route('ctlophocphan.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('ctlophocphan.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });

    $('body').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.get("{{ route('ctlophocphan.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#id_lop_hoc_phan').val(data.id_lop_hoc_phan).trigger('change');
            $('#ma_sv').val(data.ma_sv);
            $('#chuyen_can').val(data.chuyen_can);
            $('#tbkt').val(data.tbkt);
            $('#thi_1').val(data.thi_1);
            $('#thi_2').val(data.thi_2);
            $('#tong_ket_1').val(data.tong_ket_1);
            $('#tong_ket_2').val(data.tong_ket_2);
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('ctlophocphan.store') }}",
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
                    url: "{{ route('ctlophocphan.destroy', '') }}/" + id,
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
                    url: "{{ route('ctlophocphan.restore', '') }}/" + id,
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