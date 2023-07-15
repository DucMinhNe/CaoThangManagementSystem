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
                <button id="saoChepChuongTrinhDaoTaoBtn" class="btn btn-primary" type="button">Sao Chép CTĐT</button>
            </li>
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
                        <th width="110px">Khóa Học</th>
                        <th>Chuyên Ngành</th>
                        <th width="72px" class="text-center"><a href="#" id="filterToggle">Bộ Lọc</a></th>
                    </tr>
                    <tr class="filter-row">
                        <th width="30px"></th>
                        <th width="110px"></th>
                        <th></th>
                        <th width="72px" class="text-center">
                            <div class="mb-2">
                                <a href="#" class="pb-2 reset-filter">↺</a>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                    <tr>
                        <th width="30px">STT</th>
                        <th width="110px">Khóa Học</th>
                        <th>Chuyên Ngành</th>
                        <th width="72px"></th>
                    </tr>
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
                            <label for="khoa_hoc">Khóa Học</label>
                            <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc" placeholder="Khóa Học"
                                value="" required pattern="^\d{4}$">
                            <div class="invalid-feedback">
                                Vui lòng nhập năm có 4 ký tự
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_chuyen_nganh">Chuyên Ngành</label>
                            <select name="id_chuyen_nganh" id="id_chuyen_nganh" class="form-control select2"
                                style="width: 100%;" required>
                                <option value="">-- Chọn chuyên ngành --</option>
                                @foreach ($chuyennganhs as $chuyennganh)
                                @if ($chuyennganh->trang_thai == 1)
                                <option value="{{ $chuyennganh->id }}">{{ $chuyennganh->ten_chuyen_nganh }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn chuyên ngành
                            </div>
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
<div class="modal fade" id="saoChepModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="modalForm" name="modalForm" class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_chuong_trinh_dao_tao_1">Chương Trình Đạo Tạo Gốc</label>
                            <select name="id_chuong_trinh_dao_tao_1" id="id_chuong_trinh_dao_tao_1"
                                class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn --</option>
                                @foreach ($chuongtrinhdaotaos as $chuongtrinhdaotao)
                                @if ($chuongtrinhdaotao->trang_thai == 1)
                                <option value="{{ $chuongtrinhdaotao->id }}">
                                    {{ $chuongtrinhdaotao->khoa_hoc_chuyen_nganh }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_chuong_trinh_dao_tao_2">Chương Trình Đạo Tạo Sao Chép</label>
                            <select name="id_chuong_trinh_dao_tao_2" id="id_chuong_trinh_dao_tao_2"
                                class="form-control select2" style="width: 100%;">
                                <option value="">-- Chọn --</option>
                                @foreach ($chuongtrinhdaotaos as $chuongtrinhdaotao)
                                @if ($chuongtrinhdaotao->trang_thai == 1)
                                <option value="{{ $chuongtrinhdaotao->id }}">
                                    {{ $chuongtrinhdaotao->khoa_hoc_chuyen_nganh }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="saoChepChiTiet"><i
                                class="fa-solid fa-copy"></i> Sao
                            chép</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i> Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ctChuongTrinhDaoTaoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ctChuongTrinhDaoTaoModalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="ctChuongTrinhDaoTaoForm" name="ctChuongTrinhDaoTaoForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_chuong_trinh_dao_tao" id="id_chuong_trinh_dao_tao">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="hoc_ky">Học Kỳ</label>
                                <select name="hoc_ky" id="hoc_ky" class="form-control select2" style="width: 100%;">
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
                            <div class="form-group col-md-5">
                                <label for="so_tin_chi">Số Tín Chỉ</label>
                                <input type="text" class="form-control" id="so_tin_chi" name="so_tin_chi"
                                    placeholder="Số Tín Chỉ" value="" required pattern="[0-9]+">
                            </div>

                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="id_mon_hoc">Môn Học</label>
                                <select name="id_mon_hoc" id="id_mon_hoc" class="form-control select2"
                                    style="width: 100%;" required>
                                    <option value="">-- Chọn môn học --</option>
                                    @foreach ($monhocs as $monhoc)
                                    @if ($monhoc->trang_thai == 1)
                                    <option value="{{ $monhoc->id }}">{{ $monhoc->ten_mon_hoc }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="so_tiet">Số Tiết</label>
                                <input type="text" class="form-control" id="so_tiet" name="so_tiet"
                                    placeholder="Số Tiết" value="" required pattern="[0-9]+">
                                <div class="row d-flex justify-content-end mt-2">
                                    <button class="btn btn-success" type="button" id="saveCTChuongTrinhDaoTaoBtn">Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-start">
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
                        <button id="xemCTChuongTrinhDaoTaoDaXoa" class="btn btn-primary" type="button" value='1'>Hiển
                            thị
                            danh sách
                            đã
                            xóa</button>
                    </div>
                    <table id="example2" class="table table-bordered table-striped ctchuongtrinhdaotao-table">
                        <thead>
                            <tr>
                                <th style="width:25px">STT</th>
                                <th>Chương Trinh Đào Tạo</th>
                                <th>Học Kỳ</th>
                                <th>Môn Học</th>
                                <th>Số Tín Chỉ</th>
                                <th>Số Tiết</th>
                                <th style="width:28px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <!-- <button type="submit" class="btn btn-primary" id="savedata" value="create"><i
                                class="fa-regular fa-floppy-disk"></i> Lưu</button> -->
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
        initComplete: function() {
            var table = this;
            table.api().columns().every(function() {
                var column = this;
                if (column.index() !== 0 && column.index() !== 3) {

                    var select = $(
                            '<select class="form-control select2"><option value="">--Chọn--</option></select>'
                        ).appendTo($(table.api().table().container()).find(
                            '.filter-row th:eq(' + column.index() + ')'))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>');
                    });
                    $(".filter-row").toggle();
                    select.select2();
                }
            });
        },
        ajax: "{{ route('chuongtrinhdaotao.index') }}",
        columns: [{
                data: 'id',
                name: 'id',
                render: function(data, type, full, meta) {
                    var btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' +
                        data + '" data-original-title="Edit" class="ctChuongTrinhDaoTaoBtn">' +
                        data +
                        '</a>';
                    return btn;
                }
            },
            {
                data: 'khoa_hoc',
                name: 'khoa_hoc'
            },
            {
                data: 'ten_chuyen_nganh',
                name: 'ten_chuyen_nganh'
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
                text: 'Số dòng trên trang'
            }
        ],
    });
    var ctchuongtrinhdaotaotable = $('.ctchuongtrinhdaotao-table').DataTable({
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        searching: false,
        info: false,
        paging: true,
        autoWidth: false,
        ajax: "{{route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' + '1/0/1',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'khoa_hoc_chuyen_nganh',
                name: 'khoa_hoc_chuyen_nganh'
            },
            {
                data: 'hoc_ky',
                name: 'hoc_ky'
            },
            {
                data: 'ten_mon_hoc',
                name: 'ten_mon_hoc'
            },
            {
                data: 'so_tin_chi',
                name: 'so_tin_chi'
            },
            {
                data: 'so_tiet',
                name: 'so_tiet'
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
    });
    $('body').on('click', '.ctChuongTrinhDaoTaoBtn', function() {
        var id = $(this).data('id');
        $('#id_chuong_trinh_dao_tao').val(id);
        $('#ctChuongTrinhDaoTaoModal').modal('show');
        ctchuongtrinhdaotaotable.ajax.url(
                "{{ route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' + id +
                '/0/1')
            .load();
    });
    $('#saveCTChuongTrinhDaoTaoBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Đang gửi ...');
        $.ajax({
            data: $('#ctChuongTrinhDaoTaoForm').serialize(),
            url: "{{ route('ctchuongtrinhdaotao.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'success',
                    title: 'Thành Công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#saveCTChuongTrinhDaoTaoBtn').html('Thêm');
                ctchuongtrinhdaotaotable.draw();
            },
            error: function(data) {
                $('#saveCTChuongTrinhDaoTaoBtn').html('Thêm');
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'error',
                    title: 'Chưa nhập đủ thông tin',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        $("#ctChuongTrinhDaoTaoForm #id").val('');
        $('#ctChuongTrinhDaoTaoForm #hoc_ky').val('').trigger('change');
        $('#ctChuongTrinhDaoTaoForm #id_mon_hoc').val('').trigger('change');
        $('#ctChuongTrinhDaoTaoForm #so_tin_chi').val('');
        $('#ctChuongTrinhDaoTaoForm #so_tiet').val('');
    });
    $("#id_hoc_ky_filter").change(function() {
        var selectedHocKyId = $("#ctChuongTrinhDaoTaoForm #id_hoc_ky_filter").val();
        var idChuongTrinhDaoTao = $("#ctChuongTrinhDaoTaoForm #id_chuong_trinh_dao_tao").val();
        var idTrangThai = $("#xemCTChuongTrinhDaoTaoDaXoa").val();
        if (selectedHocKyId != 0) {
            ctchuongtrinhdaotaotable.ajax.url(
                    "{{ route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' +
                    idChuongTrinhDaoTao + '/' + selectedHocKyId + '/' + idTrangThai)
                .load();
        } else {
            ctchuongtrinhdaotaotable.ajax.url(
                    "{{ route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' +
                    idChuongTrinhDaoTao +
                    '/0/' + idTrangThai)
                .load();
        }
    });
    $('body').on('click', '.editCTChuongTrinhDaoTaoBtn', function() {
        var id = $(this).data('id');
        $.get("{{ route('ctchuongtrinhdaotao.index') }}" + '/' + id + '/edit', function(data) {
            $('#saveCTChuongTrinhDaoTaoBtn').val('1');
            $('#saveCTChuongTrinhDaoTaoBtn').text('Lưu');
            $("#ctChuongTrinhDaoTaoForm #id").val(data.id);
            $('#ctChuongTrinhDaoTaoForm #id_chuong_trinh_dao_tao').val(data
                .id_chuong_trinh_dao_tao);
            $('#ctChuongTrinhDaoTaoForm #hoc_ky').val(data.hoc_ky).trigger('change');
            $('#ctChuongTrinhDaoTaoForm #id_mon_hoc').val(data.id_mon_hoc).trigger('change');
            $('#ctChuongTrinhDaoTaoForm #so_tin_chi').val(data.so_tin_chi);
            $('#ctChuongTrinhDaoTaoForm #so_tiet').val(data.so_tiet);
        })
    });
    $('#xemCTChuongTrinhDaoTaoDaXoa').click(function() {
        var button = $(this);
        var buttonVal = button.val();
        var selectedHocKyId = $("#ctChuongTrinhDaoTaoForm #id_hoc_ky_filter").val();
        var idChuongTrinhDaoTao = $("#ctChuongTrinhDaoTaoForm #id_chuong_trinh_dao_tao").val();
        var buttonText = button.text();
        if (buttonVal == '1') {
            $("#xemCTChuongTrinhDaoTaoDaXoa").val('0');
            button.text('Hiển thị danh sách chính');
            ctchuongtrinhdaotaotable.ajax.url(
                    "{{ route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' +
                    idChuongTrinhDaoTao + '/' + selectedHocKyId + '/0')
                .load();
        } else {
            $("#xemCTChuongTrinhDaoTaoDaXoa").val('1');
            button.text('Hiển thị danh sách đã xóa');
            ctchuongtrinhdaotaotable.ajax.url(
                    "{{ route('ctchuongtrinhdaotao.index') }}" + '/getChiTietChuongTrinhDaoByCTDT/' +
                    idChuongTrinhDaoTao + '/' + selectedHocKyId + '/1')
                .load();
        }
    });
    $('body').on('click', '.deleteCTChuongTrinhDaoTaoBtn', function() {
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
                    url: "{{ route('ctchuongtrinhdaotao.destroy', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Xóa Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        ctchuongtrinhdaotaotable.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
    $('body').on('click', '.restoreCTChuongTrinhDaoTaoBtn', function() {
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
                    url: "{{ route('ctchuongtrinhdaotao.restore', '') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Khôi Phục Thành Công',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        ctchuongtrinhdaotaotable.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    });
    $("#filterToggle").on("click", function() {
        $(".filter-row").toggle();
    });
    $('#filterToggle').trigger('click');
    $('.reset-filter').on('click', function(e) {
        e.preventDefault();
        var selects = $('.filter-row select');
        selects.val('').trigger('change');
    });
    $('#saoChepChuongTrinhDaoTaoBtn').click(function() {
        $.ajax({
            url: "{{ route('getChuongTrinhDaoTao') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $("#id_chuong_trinh_dao_tao_1").empty();
                $("#id_chuong_trinh_dao_tao_1").append(
                    '<option value="0">-- Chọn --</option>');
                $.each(response, function(key, value) {
                    $("#id_chuong_trinh_dao_tao_1").append('<option value="' +
                        value.id + '">' + value.khoa_hoc + '.' + value
                        .ten_chuyen_nganh + '</option>');
                });
                $("#id_chuong_trinh_dao_tao_2").empty();
                $("#id_chuong_trinh_dao_tao_2").append(
                    '<option value="0">-- Chọn --</option>');
                $.each(response, function(key, value) {
                    $("#id_chuong_trinh_dao_tao_2").append('<option value="' +
                        value.id + '">' + value.khoa_hoc + '.' + value
                        .ten_chuyen_nganh + '</option>');
                });
            }
        });
        $('#saoChepModal').modal('show');
    });
    $('#saoChepChiTiet').click(function(e) {
        e.preventDefault(); // Ngăn chặn sự kiện mặc định của form

        // Lấy giá trị của các select
        var idChuongTrinhDaoTao1 = $('#id_chuong_trinh_dao_tao_1').val();
        var idChuongTrinhDaoTao2 = $('#id_chuong_trinh_dao_tao_2').val();

        // Gọi AJAX để gửi yêu cầu sao chép
        $.ajax({
            url: "{{ route('chuongtrinhdaotao.index') }}" + '/saochep/' + idChuongTrinhDaoTao1 +
                '/' +
                idChuongTrinhDaoTao2,
            type: 'GET',
            success: function(response) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true,
                    icon: 'success',
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#modalForm').trigger("reset");
                $('#saoChepModal').modal('hide');
                console.log(response.success);
            },
            error: function(xhr, status, error) {
                // Xử lý kết quả lỗi
                console.log(xhr.responseText);
            }
        });
    });
    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();

        if (buttonText == 'Hiển thị danh sách đã xóa') {
            button.text('Hiển thị danh sách chính');
            table.ajax.url("{{ route('chuongtrinhdaotao.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị danh sách đã xóa');
            table.ajax.url("{{ route('chuongtrinhdaotao.index') }}").load();
        }
    });
    $('#createNewBtn').click(function() {
        $('#modalForm').removeClass('was-validated');
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#id_chuyen_nganh').val('').trigger('change');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });

    $('body').on('click', '.editBtn', function() {
        $('#modalForm').removeClass('was-validated');
        var id = $(this).data('id');
        $.get("{{ route('chuongtrinhdaotao.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#khoa_hoc').val(data.khoa_hoc);
            $('#id_chuyen_nganh').val(data.id_chuyen_nganh).trigger('change');
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        if ($('#modalForm')[0].checkValidity()) {
            $(this).html('Đang gửi ...');
            $.ajax({
                data: $('#modalForm').serialize(),
                url: "{{ route('chuongtrinhdaotao.store') }}",
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
        } else {
            $('#modalForm').addClass('was-validated');
        }
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
                    url: "{{ route('chuongtrinhdaotao.destroy', '') }}/" + id,
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
                    url: "{{ route('chuongtrinhdaotao.restore', '') }}/" + id,
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