@extends('admin.chuyennganhs.layout')
@section('content_chuyennganh')
<section>
    <div class="container">
        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewPost"> Add New Post</a>
        </ul>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tên Chuyên Ngành</th>
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
                <form id="postForm" name="postForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ten_chuyen_nganh" class="col-sm-2 control-label d-inline">Tên Chuyên Ngành</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ten_chuyen_nganh" name="ten_chuyen_nganh" placeholder="" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ma_chu" class="col-sm-2 control-label d-inline">Mã Chữ</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ma_chu" name="ma_chu" placeholder="" value="" required>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="id_khoa" class="col-sm-2 control-label d-inline">Khoa:</label>
                        <div class="col-sm-12">
                        <select name="id_khoa" id="id_khoa" class="form-control select2" style="width: 100%; height: 38px">
                            @foreach ($khoas as $khoa)
                            <option value="{{ $khoa->id }}">{{ $khoa->ten_khoa }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ma_so" class="col-sm-2 control-label d-inline">Mã Số</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ma_so" name="ma_so" placeholder="" value="" required>
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
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                // {
                //     data: 'id_khoa',
                //     name: 'id_khoa'
                // },
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('chuyennganh.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'ten_chuyen_nganh',
                    name: 'ten_chuyen_nganh'
                },
                {
                    data: 'ten_khoa', // Thay đổi tên cột thành 'ten_khoa'
                    name: 'ten_khoa'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewPost').click(function() {
            $('#savedata').val("create-post");
            $('#id').val('');
            $('#postForm').trigger("reset");
            $('#modelHeading').html("Thêm Khoa");
            $('#ajaxModelexa').modal('show');
        });

        $('body').on('click', '.editPost', function() {
            var id = $(this).data('id');
            $.get("{{ route('chuyennganh.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Sửa Khoa");
                $('#savedata').val("edit-user");
                $('#ajaxModelexa').modal('show');
                $('#id').val(data.id);
                $('#ten_chuyen_nganh').val(data.ten_chuyen_nganh);
                $('#id_khoa').val(data.id_khoa);
            })
        });

        $('#savedata').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('chuyennganh.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#postForm').trigger("reset");
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
     
        $('body').on('click', '.deletePost', function() {

            var id = $(this).data("id");
            confirm("Are You sure want to delete this Post!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('chuyennganh.store') }}" + '/' + id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }

            });
        });

    });
</script>
@endsection