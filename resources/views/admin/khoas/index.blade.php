@extends('admin.khoas.layout')
@section('content_khoa')
<section>
<div class="container">
<button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button>

<ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
    <a class="btn btn-info" href="javascript:void(0)" id="createNewKhoa"> Thêm Khoa</a>
</ul>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tên Khoa</th>
                <th width="280px">Hành Động</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
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
                <form id="khoaForm" name="khoaForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ten_khoa" class="col-sm-2 control-label d-inline">Tên Khoa</label>
                        <div class="col-sm-12 ">
                            <input type="text" class="form-control" id="ten_khoa" name="ten_khoa" placeholder="Tên Khoa" value="" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="savedata" value="create">Lưu
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

<script type="text/javascript">
    $(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('khoa.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'ten_khoa', name: 'ten_khoa'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#showInactiveBtn').click(function() {
    var button = $(this);
    var buttonText = button.text();

    if (buttonText === 'Hiển thị Trạng thái 0') {
        button.text('Hiển thị Trạng thái 1');
        table.ajax.url("{{ route('khoa.getInactiveData') }}").load();
    } else {
        button.text('Hiển thị Trạng thái 0');
        table.ajax.url("{{ route('khoa.index') }}").load();
    }
});


        $('#createNewKhoa').click(function () {
            $('#savedata').val("create-khoa");
            $('#id').val('');
            $('#khoaForm').trigger("reset");
            $('#modelHeading').html("Thêm Khoa");
            $('#ajaxModelexa').modal('show');
        });
        
        $('body').on('click', '.editKhoa', function () {
        var id = $(this).data('id');
        $.get("{{ route('khoa.index') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Sửa Khoa");
            $('#savedata').val("edit-khoa");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#ten_khoa').val(data.ten_khoa);
        })
    });
        
        $('#savedata').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
        
            $.ajax({
            data: $('#khoaForm').serialize(),
            url: "{{ route('khoa.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
        
                $('#khoaForm').trigger("reset");
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
        
        $('body').on('click', '.deleteKhoa', function () {
         var id = $(this).data("id");
         if (confirm("Bạn có muốn xóa?")) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('khoa.destroy', '') }}/" + id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });
             }
        });
        $('body').on('click', '.restoreKhoa', function () {
    var id = $(this).data("id");
    if (confirm("Bạn có muốn khôi phục?")) {
        $.ajax({
            type: "GET",
            url: "{{ route('khoa.restore', '') }}/" + id,
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