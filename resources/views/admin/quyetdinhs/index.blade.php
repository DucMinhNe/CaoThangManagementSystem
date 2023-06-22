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
                        <th>Người Ra Quyết Định</th>
                        <th>Ngày Ra Quyết Định</th>
                        <th>Nội Dung</th>
                        <th>Hiệu Lực Bắt Đầu</th>
                        <th>Hiệu Lực Đến</th>
                        <th width="72px"></th>
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
                                style="width: 100%;">
                                @foreach ($giangviens as $giangvien)
                                @if ($giangvien->trang_thai == 1)
                                <option value="{{ $giangvien->ma_gv }}">{{ $giangvien->ten_giang_vien }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ngay_ra_quyet_dinh">Ngày Ra Quyết Định</label>
                            <input type="date" class="form-control" id="ngay_ra_quyet_dinh" name="ngay_ra_quyet_dinh"
                                placeholder="" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="noi_dung">Nội Dung</label>
                            <input type="text" class="form-control" id="noi_dung" name="noi_dung" placeholder="Nội Dung"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="hieu_luc_bat_dau">Hiệu Lực Bắt Đầu</label>
                            <input type="date" class="form-control" id="hieu_luc_bat_dau" name="hieu_luc_bat_dau"
                                placeholder="" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="hieu_luc_ket_thuc">Hiệu Lực Đến</label>
                            <input type="date" class="form-control" id="hieu_luc_ket_thuc" name="hieu_luc_ket_thuc"
                                placeholder="" value="" required>
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
        ajax: "{{ route('quyetdinh.index') }}",
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
                data: 'ten_giang_vien',
                name: 'ten_giang_vien'
            },
            {
                data: 'ngay_ra_quyet_dinh',
                name: 'ngay_ra_quyet_dinh'
            },
            {
                data: 'noi_dung',
                name: 'noi_dung'
            },
            {
                data: 'hieu_luc_bat_dau',
                name: 'hieu_luc_bat_dau'
            },
            {
                data: 'hieu_luc_ket_thuc',
                name: 'hieu_luc_ket_thuc'
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
            table.ajax.url("{{ route('quyetdinh.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('quyetdinh.index') }}").load();
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
    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
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