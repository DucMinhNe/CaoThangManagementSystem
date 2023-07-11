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
});
</script>
@endsection