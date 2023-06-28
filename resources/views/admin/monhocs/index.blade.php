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
                        <th>Tên Môn Học</th>
                        <th>Bộ Môn</th>
                        <th>Loại Môn Học</th>
                        <th width="72px"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th width="30px">STT</th>
                        <th>Tên Môn Học</th>
                        <th>Bộ Môn</th>
                        <th>Loại Môn Học</th>
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
                            <label for="ten_mon_hoc">Tên Môn Học</label>
                            <input type="text" class="form-control" id="ten_mon_hoc" name="ten_mon_hoc"
                                placeholder="Tên Môn Học" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="id_bo_mon">Bộ Môn</label>
                            <select name="id_bo_mon" id="id_bo_mon" class="form-control select2" style="width: 100%;">
                                @foreach ($bomons as $bomon)
                                @if ($bomon->trang_thai == 1)
                                <option value="{{ $bomon->id }}">{{ $bomon->ten_bo_mon }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_loai_mon_hoc">Loại Môn Học</label>
                            <select name="id_loai_mon_hoc" id="id_loai_mon_hoc" class="form-control select2"
                                style="width: 100%;">
                                @foreach ($loaimonhocs as $loaimonhoc)
                                @if ($loaimonhoc->trang_thai == 1)
                                <option value="{{ $loaimonhoc->id }}">{{ $loaimonhoc->ten_loai_mon_hoc }}</option>
                                @endif
                                @endforeach
                            </select>
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
        ajax: "{{ route('monhoc.index') }}",
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
                data: 'ten_mon_hoc',
                name: 'ten_mon_hoc'
            },
            {
                data: 'ten_bo_mon',
                name: 'ten_bo_mon'
            },
            {
                data: 'ten_loai_mon_hoc',
                name: 'ten_loai_mon_hoc'
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

        if (buttonText === 'Hiển thị danh sách đã xóa') {
            button.text('Hiển thị danh sách chính');
            table.ajax.url("{{ route('monhoc.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('monhoc.index') }}").load();
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
        $.get("{{ route('monhoc.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#ten_mon_hoc').val(data.ten_mon_hoc);
            $('#id_bo_mon').val(data.id_bo_mon).trigger('change');
            $('#id_loai_mon_hoc').val(data.id_loai_mon_hoc).trigger('change');
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Đang gửi ...');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('monhoc.store') }}",
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
                    url: "{{ route('monhoc.destroy', '') }}/" + id,
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
                    url: "{{ route('monhoc.restore', '') }}/" + id,
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