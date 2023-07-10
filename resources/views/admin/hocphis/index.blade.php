@extends('admin.layouts.layout')
@section('content')
<section>
    <div class="container">
        <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button>

        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm </a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Chuyên ngành</th>
                        <th>Khóa học</th>
                        <th>Học kỳ</th>
                        <th>Số tiền</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Mở đóng học phí</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Chuyên ngành</th>
                        <th>Khóa học</th>
                        <th>Học kỳ</th>
                        <th>Số tiền</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Mở đóng học phí</th>
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
                            <label for="hoc_ky">Học kỳ</label>
                            <input type="text" class="form-control" id="hoc_ky" name="hoc_ky" placeholder="Học kỳ"
                                value="" required>
                        </div>

                        <div class="form-group">
                            <label for="khoa_hoc">Khóa học</label>
                            <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc" placeholder="Khóa học"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="id_chuyen_nganh">Chuyên Ngành</label>
                            <select name="id_chuyen_nganh" id="id_chuyen_nganh" class="form-control select2"
                                style="width: 100%;">
                                @foreach ($chuyennganhs as $chuyennganh)
                                <option value="{{ $chuyennganh->id }}">{{$chuyennganh->ten_chuyen_nganh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="so_tien">Số tiền</label>
                            <input type="text" class="form-control" id="so_tien" name="so_tien" placeholder="Số tiền"
                                value="" required>
                        </div>
                        <div class="cs-form">
                            <label for="ngay_bat_dau">Thời gian bắt đầu</label>
                            <input type="datetime-local" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau"
                                required />
                        </div>
                        <div class="cs-form">
                            <label for="ngay_ket_thuc">Thời gian kết thúc</label>
                            <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="mo_dong_hoc_phi">Mở đóng học phí</label>
                            <select name="mo_dong_hoc_phi" id="mo_dong_hoc_phi" class="form-control select2"
                                style="width: 100%;">
                                <option value="1" selected>Mở</option>
                                <option value="0">Đóng</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
        ajax: "{{ route('hocphi.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'ten_chuyen_nganh',
                name: 'ten_chuyen_nganh'
            },
            {
                data: 'khoa_hoc',
                name: 'khoa_hoc',
            },
            {
                data: 'hoc_ky',
                name: 'hoc_ky'
            },
            {
                data: 'so_tien',
                name: 'so_tien'
            },
            {
                data: 'ngay_bat_dau',
                name: 'ngay_bat_dau'
            },
            {
                data: 'ngay_ket_thuc',
                name: 'ngay_ket_thuc'
            },
            {
                data: 'mo_dong_hoc_phi',
                name: 'mo_dong_hoc_phi',
                render: function(data, type, full, meta) {
                    if (data == 1) {
                        return '<span class="badge bg-success">Đang mở</span>';
                    } else {
                        return '<span class="badge bg-danger">Đã đóng</span>';
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

        if (buttonText == 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('hocphi.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('hocphi.index') }}").load();
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
        $.get("{{ route('hocphi.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#id_chuyen_nganh').val(data.id_chuyen_nganh).trigger('change');
            $('#khoa_hoc').val(data.khoa_hoc);
            $('#so_tien').val(data.so_tien);
            $('#ngay_bat_dau').val(data.ngay_bat_dau);
            $('#ngay_ket_thuc').val(data.ngay_ket_thuc);
            $('#hoc_ky').val(data.hoc_ky);
            $('#mo_dong_hoc_phi').val(data.mo_dong_hoc_phi).trigger('change');
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('hocphi.store') }}",
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
                url: "{{ route('hocphi.destroy', '') }}/" + id,
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
                url: "{{ route('hocphi.restore', '') }}/" + id,
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