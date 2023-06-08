@extends('admin.chuyennganhs.layout')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
  .select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 38px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
</style>

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
                <th>Tên Chuyên Ngành</th>
                <th>Mã Chữ</th>
                <th>Mã Số</th>
                <th>Khoa</th>
                <th width="280px">Hành Động</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
                <th>No</th>
                <th>Tên Chuyên Ngành</th>
                <th>Mã Chữ</th>
                <th>Mã Số</th>
                <th>Khoa</th>
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
                    <label for="ten_khoa">Tên Chuyên Ngành</label>
                    <input type="text" class="form-control" id="ten_chuyen_nganh" name="ten_chuyen_nganh" placeholder="Tên Khoa" value="" required>
                    </div>
                    <div class="form-group">
                    <label for="ten_khoa">Mã Chữ</label>
                    <input type="text" class="form-control" id="ma_chu" name="ma_chu" placeholder="Tên Khoa" value="" required>
                    </div>
                    <div class="form-group">
                    <label for="ten_khoa">Mã Số</label>
                    <input type="text" class="form-control" id="ma_so" name="ma_so" placeholder="Tên Khoa" value="" required>
                    </div>
                    <div class="form-group" >
                        <label for="id_khoa" >Khoa</label>
                        <select name="id_khoa" id="id_khoa" class="form-control select2" style="width: 100%;">
                                @foreach ($khoas as $khoa)
                                     @if ($khoa->trang_thai == 1)
                                    <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
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
            ajax: "{{ route('chuyennganh.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'ten_chuyen_nganh', name: 'ten_chuyen_nganh'},
                {data: 'ma_chu', name: 'ma_chu'},
                {data: 'ma_so', name: 'ma_so'},
                {data: 'ten_khoa', name: 'ten_khoa'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
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
         buttons: [
            {
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
        table.ajax.url("{{ route('chuyennganh.getInactiveData') }}").load();
    } else {
        button.text('Hiển thị Trạng thái 0');
        table.ajax.url("{{ route('chuyennganh.index') }}").load();
    }
});
        $('#createNewBtn').click(function () {
            $('#savedata').val("create-Btn");
            $('#id').val('');
            $('#modalForm').trigger("reset");
            $('#modelHeading').html("Thêm Chuyên Ngành");
            $('#ajaxModelexa').modal('show');
        });
    
        $('body').on('click', '.editBtn', function() {
            var id = $(this).data('id');
            $.get("{{ route('chuyennganh.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Sửa");
                $('#savedata').val("edit-Btn");
                $('#ajaxModelexa').modal('show');
                $('#id').val(data.id);
                $('#ten_chuyen_nganh').val(data.ten_chuyen_nganh);
                $('#ma_chu').val(data.ma_chu);
                $('#ma_so').val(data.ma_so);
                $('#id_khoa').val(data.id_khoa);
            })
        });

        $('#savedata').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('chuyennganh.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#modalForm').trigger("reset");
                $('#ajaxModelexa').modal('hide');
                $('#savedata').html('Lưu');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#savedata').html('Lưu');
            }
        });
        });
        
        $('body').on('click', '.deleteBtn', function () {
         var id = $(this).data("id");
         if (confirm("Bạn có muốn xóa?")) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('chuyennganh.destroy', '') }}/" + id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });
             }
        });
        $('body').on('click', '.restoreBtn', function () {
    var id = $(this).data("id");
    if (confirm("Bạn có muốn khôi phục?")) {
        $.ajax({
            type: "GET",
            url: "{{ route('chuyennganh.restore', '') }}/" + id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
    });
    });
</script>
@endsection