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
        <div class="form-group row">
            <label for="id_khoa_filter" class="col-sm-2 col-form-label">Khoa</label>
            <div class="col-sm-3">
                <select name="id_khoa_filter" id="id_khoa_filter" class="form-control select2" style="width: 100%;">
                    <option value="0">-- Chọn khoa --</option>
                    @foreach ($khoas as $khoa)
                    @if ($khoa->trang_thai == 1)
                    <option value="{{ $khoa->id}}">{{ $khoa->ten_khoa }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="id_chuyen_nganh_filter" class="col-sm-2 col-form-label">Chuyên ngành</label>
            <div class="col-sm-3">
                <select name="id_chuyen_nganh_filter" id="id_chuyen_nganh_filter" class="form-control select2"
                    style="width: 100%;">
                    <option value="0">-- Chọn chuyên ngành --</option>
                    @foreach ($chuyennganhs as $chuyennganh)
                    @if ($chuyennganh->trang_thai == 1)
                    <option value="{{ $chuyennganh->id}}">{{ $chuyennganh->ten_chuyen_nganh }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mt-0">
            <label for="id_lop_hoc_filter" class="col-sm-2 col-form-label">Lớp Học</label>
            <div class="col-sm-3">
                <select name="id_lop_hoc_filter" id="id_lop_hoc_filter" class="form-control select2"
                    style="width: 100%;">
                    <option value="0">-- Chọn lớp --</option>
                    @foreach ($lophocs as $lophoc)
                    @if ($lophoc->trang_thai == 1)
                    <option value="{{ $lophoc->id}}">{{ $lophoc->ten_lop_hoc }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button id="xemBtn" class="btn btn-info" type="button">Xem</button>
                <button id="datLaiBtn" class="btn btn-info" type="button">Đặt lại</button>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sinh Viên</th>
                        <th>Điểm Trung Bình HK1</th>
                        <th>Điểm Trung Bình HK2</th>
                        <th>Điểm Trung Bình HK3</th>
                        <th>Điểm Trung Bình HK4</th>
                        <th>Điểm Trung Bình HK5</th>
                        <th>Điểm Trung Bình HK6</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sinh Viên</th>
                        <th>Điểm Trung Bình HK1</th>
                        <th>Điểm Trung Bình HK2</th>
                        <th>Điểm Trung Bình HK3</th>
                        <th>Điểm Trung Bình HK4</th>
                        <th>Điểm Trung Bình HK5</th>
                        <th>Điểm Trung Bình HK6</th>
                    </tr>
                </tfoot>
            </table>
        </div>
</section>
<div class="modal fade" id="ctCacLopHocPhanModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ctCacLopHocPhanModalHeading"></h4>
            </div>
                    <div class="form-group row ml-2">
                        <label for="id_hoc_ky_filter" class="col-sm-1 col-form-label">Học Kỳ</label>
                        <div class="col-sm-3">
                            <select name="id_hoc_ky_filter" id="id_hoc_ky_filter" class="form-control select2"
                                style="width: 100%;">
                                <option value="0">-- Chọn học kỳ --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">Tốt Nghiệp</option>
                                <option value="8">Chứng Chỉ</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="ma_sv" id="ma_sv">
            <div class="modal-body">
                    <table id="example2" class="table table-bordered table-striped ctCacLopHocPhan-table">
                        <thead>
                            <tr>
                                <th>Tên Lớp Học Phần</th>
                                <th>Học Kỳ</th>
                                <th>Chuyên Cần</th>
                                <th>TBKT</th>
                                <th>Thi 1</th>
                                <th>Thi 2</th>
                                <th>Tổng Kết 1</th>
                                <th>Tổng Kết 2</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i>
                    Hủy</button>
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
        orderCellsTop: true,
        ajax: "{{ route('xettotnghiep.index') }}",
        columns: [{
                data: 'ma_sv',
                name: 'ma_sv',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="editBtn">' + data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'ten_sinh_vien',
                name: 'ten_sinh_vien'
            },
            {
                data: 'trung_binh_hk1',
                name: 'trung_binh_hk1'
            },
            {
                data: 'trung_binh_hk2',
                name: 'trung_binh_hk2'
            },
            {
                data: 'trung_binh_hk3',
                name: 'trung_binh_hk3'
            },
            {
                data: 'trung_binh_hk4',
                name: 'trung_binh_hk4'
            },
            {
                data: 'trung_binh_hk5',
                name: 'trung_binh_hk5'
            },
            {
                data: 'trung_binh_hk6',
                name: 'trung_binh_hk6'
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
                text: 'Số dòng trên trang'
            }
        ],
    });
    var ctCacLopHocPhanTable = $('.ctCacLopHocPhan-table').DataTable({
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        searching: false,
        info: false,
        paging: true,
        autoWidth: false,
        ajax: "{{ route('xettotnghiep.index')}}" + '/getCacLopHocPhanByMaSv/0/0',
        columns: [
            {
                data: 'ten_lop_hoc_phan',
                name: 'ten_lop_hoc_phan'
            },
            {
                data: 'hoc_ky',
                name: 'hoc_ky'
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
    });
    $("#id_hoc_ky_filter").change(function() {
        var selectedHocKyId = $("#id_hoc_ky_filter").val();
        var masinhvien = $("#ma_sv").val();
        if (selectedHocKyId != 0) {
            ctCacLopHocPhanTable.ajax.url(
                "{{ route('xettotnghiep.index')}}" + '/getCacLopHocPhanByMaSv/'+masinhvien+'/'+selectedHocKyId)
            .load();
        } else {
            ctCacLopHocPhanTable.ajax.url(
                "{{ route('xettotnghiep.index')}}" + '/getCacLopHocPhanByMaSv/'+masinhvien+'/0')
            .load();
        }
    });
    $('body').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $('#ctCacLopHocPhanModal').modal('show');
        $('#ma_sv').val(id);
        $('#ctCacLopHocPhanModalHeading').html(id);
        ctCacLopHocPhanTable.ajax.url(
                "{{ route('xettotnghiep.index')}}" + '/getCacLopHocPhanByMaSv/'+id+'/0')
            .load();
    });
    $('#xemBtn').click(function() {
        var selectedKhoaId = $("#id_khoa_filter").val();
        var selectedChuyenNganhId = $("#id_chuyen_nganh_filter").val();
        var selectedLopHocId = $("#id_lop_hoc_filter").val();

        if (selectedLopHocId != 0) {
            // Nếu đã chọn lớp học, load danh sách sinh viên theo lớp học
            table.ajax.url("{{ route('xettotnghiep.getSinhVienByIdLop', '') }}/" + selectedLopHocId)
                .load();
        } else if (selectedChuyenNganhId != 0) {
            // Nếu đã chọn chuyên ngành, load danh sách sinh viên theo chuyên ngành
            table.ajax.url("{{ route('xettotnghiep.getSinhVienByIdChuyenNganh', '') }}/" +
                selectedChuyenNganhId).load();
        } else if (selectedKhoaId != 0) {
            // Nếu đã chọn khoa, load danh sách sinh viên theo khoa
            table.ajax.url("{{ route('xettotnghiep.getSinhVienByIdKhoa', '') }}/" + selectedKhoaId)
                .load();
        } else {
            // Nếu không chọn gì cả, load lại toàn bộ danh sách sinh viên
            table.ajax.url("{{ route('xettotnghiep.index') }}").load();
        }
    });
    $('#datLaiBtn').click(function() {
        $("#id_khoa_filter").empty();
        var khoas = <?php echo json_encode($khoas); ?>;
        $("#id_khoa_filter").append('<option value="0">-- Chọn khoa --</option>');
        $.each(khoas, function(index, khoa) {
            var option = '<option value="' + khoa.id + '">' + khoa
                .ten_khoa +
                '</option>';
            $("#id_khoa_filter").append(option);
        });

        $("#id_chuyen_nganh_filter").empty();
        var chuyennganhs = <?php echo json_encode($chuyennganhs); ?>;
        $("#id_chuyen_nganh_filter").append('<option value="0">-- Chọn chuyên ngành --</option>');
        $.each(chuyennganhs, function(index, chuyennganh) {
            var option = '<option value="' + chuyennganh.id + '">' + chuyennganh
                .ten_chuyen_nganh +
                '</option>';
            $("#id_chuyen_nganh_filter").append(option);
        });
        $("#id_lop_hoc_filter").empty();
        var lophocs = <?php echo json_encode($lophocs); ?>;
        $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
        $.each(lophocs, function(index, lophoc) {
            var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                '</option>';
            $("#id_lop_hoc_filter").append(option);
        });
    });
    $("#id_khoa_filter").change(function() {
        var selectedKhoaId = $(this).val();
        if (selectedKhoaId != 0) {
            $.ajax({
                url: "{{ route('sinhvien.getChuyenNganhByKhoa', '') }}/" + selectedKhoaId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown chuyên ngành
                    $("#id_chuyen_nganh_filter").empty();
                    $("#id_chuyen_nganh_filter").append(
                        '<option value="0">-- Chọn chuyên ngành --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_chuyen_nganh_filter").append('<option value="' +
                            value.id + '">' + value.ten_chuyen_nganh +
                            '</option>');
                    });
                }
            });
            $.ajax({
                url: "{{ route('sinhvien.getLopByKhoa', '') }}/" + selectedKhoaId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown lớp học
                    $("#id_lop_hoc_filter").empty();
                    $("#id_lop_hoc_filter").append(
                        '<option value="0">-- Chọn lớp --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_lop_hoc_filter").append('<option value="' +
                            value.id + '">' + value.ten_lop_hoc +
                            '</option>');
                    });
                }
            });
        } else {
            $("#id_chuyen_nganh_filter").empty();
            var chuyennganhs = <?php echo json_encode($chuyennganhs); ?>;
            $("#id_chuyen_nganh_filter").append('<option value="0">-- Chọn chuyên ngành --</option>');
            $.each(chuyennganhs, function(index, chuyennganh) {
                var option = '<option value="' + chuyennganh.id + '">' + chuyennganh
                    .ten_chuyen_nganh +
                    '</option>';
                $("#id_chuyen_nganh_filter").append(option);
            });
            $("#id_lop_hoc_filter").empty();
            var lophocs = <?php echo json_encode($lophocs); ?>;
            $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
            $.each(lophocs, function(index, lophoc) {
                var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                    '</option>';
                $("#id_lop_hoc_filter").append(option);
            });
        }
    });

    // Lấy danh sách lớp học khi chọn chuyên ngành
    $("#id_chuyen_nganh_filter").change(function() {
        var selectedChuyenNganhId = $(this).val();

        if (selectedChuyenNganhId != 0) {
            $.ajax({
                url: "{{ route('sinhvien.getLopByChuyenNganh', '') }}/" + selectedChuyenNganhId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa các option hiện tại trong dropdown lớp học
                    $("#id_lop_hoc_filter").empty();
                    $("#id_lop_hoc_filter").append(
                        '<option value="0">-- Chọn lớp --</option>');
                    // Thêm các option mới từ response
                    $.each(response, function(key, value) {
                        $("#id_lop_hoc_filter").append('<option value="' + value
                            .id + '">' + value.ten_lop_hoc + '</option>');
                    });
                }
            });
        } else {
            $("#id_lop_hoc_filter").empty();
            var lophocs = <?php echo json_encode($lophocs); ?>;
            $("#id_lop_hoc_filter").append('<option value="0">-- Chọn lớp --</option>');
            $.each(lophocs, function(index, lophoc) {
                var option = '<option value="' + lophoc.id + '">' + lophoc.ten_lop_hoc +
                    '</option>';
                $("#id_lop_hoc_filter").append(option);
            });
        }
    });
});
</script>
@endsection