@extends('admin.monhocs.layout')
<!-- <style>
.select2-selection__rendered {
    line-height: 31px !important;
}

.select2-container .select2-selection--single {
    height: 35px !important;
}

.select2-selection__arrow {
    height: 34px !important;
}
</style> -->

@section('content')
<section>
    <div class="container">
        <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button>

        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm Chuyên Ngành</a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tên Môn Học</th>
                        <th>Bô Môn</th>
                        <th>Loại Môn Học</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tên Môn Học</th>
                        <th>Bô Môn</th>
                        <th>Loại Môn Học</th>
                        <th width="280px">Hành Động</th>
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
                                placeholder="Tên Khoa" value="" required>
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
        ajax: "{{ route('monhoc.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
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

        if (buttonText === 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('monhoc.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('monhoc.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm Chuyên Ngành");
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
            $('#id_bo_mon').val(data.id_bo_mon);
            $('#id_loai_mon_hoc').val(data.id_loai_mon_hoc);
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('monhoc.store') }}",
            type: "POST",
            dataType: 'json',
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
                url: "{{ route('monhoc.destroy', '') }}/" + id,
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
                url: "{{ route('monhoc.restore', '') }}/" + id,
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