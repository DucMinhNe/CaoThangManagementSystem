@extends('admin.giangviens.layout')
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
    <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm Giảng Viên</a>
</ul>
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tên Giảng Viên</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>CCCD/CMND</th>
                <th>Ngày Sinh</th>
                <th>Nơi Sinh</th>
                <th>Giới Tính</th>
                <th>Dân Tộc</th>
                <th>Tôn Giáo</th>
                <th>Địa Chỉ Thường Trú</th>
                <th>Địa Chỉ Tạm Trú</th>
                <th>Quốc Gia</th>
                <th>Bộ Môn</th>
                <th>Hinh Dai Dien</th>
                <th>Chức Vụ</th>
                <th>Trạng Thái Làm Việc</th>
                <th width="280px">Hành Động</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
        <th>No</th>
                <th>Tên Giảng Viên</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>CCCD/CMND</th>
                <th>Ngày Sinh</th>
                <th>Nơi Sinh</th>
                <th>Giới Tính</th>
                <th>Dân Tộc</th>
                <th>Tôn Giáo</th>
                <th>Địa Chỉ Thường Trú</th>
                <th>Địa Chỉ Tạm Trú</th>
                <th>Quốc Gia</th>
                <th>Bộ Môn</th>
                <th>Hinh Dai Dien</th>
                <th>Chức Vụ</th>
                <th>Trạng Thái Làm Việc</th>
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
                <div class="card-body">
                <div class="form-group">
                    <label for="ma_gv">Mã Giảng Viên</label>
                    <input type="text" class="form-control" id="ma_gv" name="ma_gv" placeholder="Tên Khoa" value="" required>
            </div>
            <div class="form-group">
                <label for="ten_giang_vien">Tên Giảng Viên</label>
                <input type="text" class="form-control" id="ten_giang_vien" name="ten_giang_vien" placeholder="Tên Giảng Viên" value="" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" required>
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số Điện Thoại</label>
                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="Số Điện Thoại" value="" required>
            </div>
            <div class="form-group">
                <label for="so_cmt">CCCD/CMND</label>
                <input type="text" class="form-control" id="so_cmt" name="so_cmt" placeholder="CCCD/CMND" value="" required>
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" placeholder="Ngày Sinh" value="" required>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi Sinh</label>
                <input type="text" class="form-control" id="noi_sinh" name="noi_sinh" placeholder="Nơi Sinh" value="" required>
            </div>
            <div class="form-group">
                <label for="gioi_tinh">Giới Tính</label>
                <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dan_toc">Dân Tộc</label>
                <input type="text" class="form-control" id="dan_toc" name="dan_toc" placeholder="Dân Tộc" value="" required>
            </div>
            <div class="form-group">
                <label for="ton_giao">Tôn Giáo</label>
                <input type="text" class="form-control" id="ton_giao" name="ton_giao" placeholder="Tôn Giáo" value="" required>
            </div>
            <div class="form-group">
                <label for="dia_chi_thuong_tru">Địa Chỉ Thường Trú</label>
                <input type="text" class="form-control" id="dia_chi_thuong_tru" name="dia_chi_thuong_tru" placeholder="Địa Chỉ Thường Trú" value="" required>
            </div>
            <div class="form-group">
                <label for="dia_chi_tam_tru">Địa Chỉ Tạm Trú</label>
                <input type="text" class="form-control" id="dia_chi_tam_tru" name="dia_chi_tam_tru" placeholder="Địa Chỉ Tạm Trú" value="" required>
            </div>
            <div class="form-group">
                <label for="quoc_gia">Quốc Gia</label>
                <input type="text" class="form-control" id="quoc_gia" name="quoc_gia" placeholder="Quốc Gia" value="" required>
            </div>
            <div class="form-group">
                <label for="id_bo_mon">Bộ Môn</label>
                <select name="id_bo_mon" id="id_bo_mon" class="form-control select2" style="width: 100%;" required>
                    @foreach ($bomons as $bomon)
                        @if ($bomon->trang_thai == 1)
                            <option value="{{ $bomon->id }}">{{ $bomon->ten_bo_mon }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="hinh_anh_dai_dien">Hình Đại Diện</label>
                <input type="text" class="form-control" id="hinh_anh_dai_dien" name="hinh_anh_dai_dien">
            </div>
            <div class="form-group">
                <label for="id_chuc_vu">Chức Vụ</label>
                <select name="id_chuc_vu" id="id_chuc_vu" class="form-control select2" style="width: 100%;" required>
                    @foreach ($chucvus as $chucvu)
                        @if ($chucvu->trang_thai == 1)
                            <option value="{{ $chucvu->id }}">{{ $chucvu->ten_chuc_vu}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="trang_thai_lam_viec">Trạng Thái Làm Việc</label>
                <input type="text" class="form-control" id="trang_thai_lam_viec" name="trang_thai_lam_viec" placeholder="Trạng Thái Làm Việc" value="" required>
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
            ajax: "{{ route('giangvien.index') }}",
            columns: [
                // render: function(data) {
                // if (data === 0) {
                //  return 'Nam';
                //  } else if (data === 1) {
                // return 'Nữ';
                // } 
                // }
                {data: 'ma_gv', name: 'ma_gv'},
                {data: 'ten_giang_vien', name: 'ten_giang_vien'},
                {data: 'email', name: 'email'},
                {data: 'so_dien_thoai', name: 'so_dien_thoai'},
                {data: 'so_cmt', name: 'so_cmt'},
                {data: 'ngay_sinh', name: 'ngay_sinh'},
                {data: 'noi_sinh', name: 'noi_sinh'},
                {data: 'gioi_tinh', name: 'gioi_tinh'},
                {data: 'dan_toc', name: 'dan_toc'},
                {data: 'ton_giao', name: 'ton_giao'},
                {data: 'dia_chi_thuong_tru', name: 'dia_chi_thuong_tru'},
                {data: 'dia_chi_tam_tru', name: 'dia_chi_tam_tru'},
                {data: 'quoc_gia', name: 'quoc_gia'},
                {data: 'ten_bo_mon', name: 'ten_bo_mon'},
                {data: 'hinh_anh_dai_dien', name: 'hinh_anh_dai_dien'},
                {data: 'ten_chuc_vu', name: 'ten_chuc_vu'},
                {data: 'trang_thai_lam_viec', name: 'trang_thai_lam_viec'},
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
        table.ajax.url("{{ route('giangvien.getInactiveData') }}").load();
    } else {
        button.text('Hiển thị Trạng thái 0');
        table.ajax.url("{{ route('giangvien.index') }}").load();
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
            $.get("{{ route('giangvien.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Sửa");
                $('#savedata').val("edit-Btn");
                $('#ajaxModelexa').modal('show');
                $('#ma_gv').val(data.ma_gv);
                $('#ten_giang_vien').val(data.ten_giang_vien);
                $('#email').val(data.email);
                $('#so_dien_thoai').val(data.so_dien_thoai);
                $('#so_cmt').val(data.so_cmt);
                $('#ngay_sinh').val(data.ngay_sinh);
                $('#noi_sinh').val(data.noi_sinh);
                $('#gioi_tinh').val(data.gioi_tinh);
                $('#dan_toc').val(data.dan_toc);
                $('#ton_giao').val(data.ton_giao);
                $('#dia_chi_thuong_tru').val(data.dia_chi_thuong_tru);
                $('#dia_chi_tam_tru').val(data.dia_chi_tam_tru);
                $('#quoc_gia').val(data.quoc_gia);
                $('#id_bo_mon').val(data.id_bo_mon);
                $('#hinh_anh_dai_dien').val(data.hinh_anh_dai_dien);
                $('#id_chuc_vu').val(data.id_chuc_vu);
                $('#trang_thai_lam_viec').val(data.trang_thai_lam_viec);
            })
        });

        $('#savedata').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('giangvien.store') }}",
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
            url: "{{ route('giangvien.destroy', '') }}/" + id,
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
            url: "{{ route('giangvien.restore', '') }}/" + id,
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