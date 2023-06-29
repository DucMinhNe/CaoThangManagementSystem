@extends('admin.modangkymons.layout')
@section('content')
<section>
    <div class="container">
        <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button>

        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm </a>
            <a class="btn btn-info" href="javascript:void(0)" id="btnMoDangKyMon"> Mở đăng ký môn theo khóa theo ngành </a>
        </ul>
        <div class="modal fade bd-example-modal-lg" id="formthemmodangkymon"tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading-them">Thêm</h4>
                </div>
                <div class="modal-body">
                    <form id="modalFormThem" name="modalForm" class="form-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div >
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="ten_lop_hoc_phan">Khóa</label>
                                            <input type="text" class="form-control" id="ten_lop_hoc_phan" name="ten_lop_hoc_phan"
                                                value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="ten_mon_hoc">Chuyên ngành</label>
                                            <input type="text" class="form-control" id="ten_mon_hoc" name="ten_mon_hoc"
                                                 value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="chon_ngay_bat_dau">Ngày bắt đầu</label>
                                            <input type="datetime-local" class="form-control" name="chon_ngay_bat_dau" id="chon_ngay_bat_dau" />
                                        </div>
                                        <div class="form-group">
                                            <label for="chon_ngay_ket_thuc">Ngày kết thúc</label>
                                            <input type="datetime-local" class="form-control" name="chon_ngay_ket_thuc" id="chon_ngay_ket_thuc" />
                                        </div>


                                    </div>
                                </div>

                                <div class="col">
                                    <div>
                                       Danh sách môn
                                    </div>
                                    <table class="table table-success table-striped" id="table-mo-dang-ky-mon">
                                        <thead>
                                            <th>ID</th>
                                            <th>Tên môn học</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Xác nhận</th>
                                        </thead>
                                        <tbody>
                                            <tr >
                                                <td>1</td>
                                                <td>Môn a</td>
                                                <td>
                                                    <input type="datetime-local" class="form-control ngay_mo_dang_ky_mon" name="ngay_mo_dang_ky_mon" />
                                                </td>
                                                <td>
                                                    <input type="datetime-local" class="form-control ngay_dong_dang_ky_mon" name="ngay_dong_dang_ky_mon" />
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="chon_mo_lop" data-id-mon-hoc="1" >
                                                </td>
                                            </tr>
                                            <tr >
                                                <td>2</td>
                                                <td>Môn b</td>
                                                <td>
                                                    <input type="datetime-local" class="form-control ngay_mo_dang_ky_mon" name="ngay_mo_dang_ky_mon" />
                                                </td>
                                                <td>
                                                    <input type="datetime-local" class="form-control ngay_dong_dang_ky_mon" name="ngay_dong_dang_ky_mon" />
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="chon_mo_lop" data-id-mon-hoc="2">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tên môn học</th>
                        <th>Khóa học</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tên môn học</th>
                        <th>Khóa học</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
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
                            <label for="khoa_hoc">Khóa học</label>
                            <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc"
                                placeholder="Khóa" value="" required>
                            <div class="form-group">
                                <label for="id_mon_hoc">Môn học</label>
                                <select name="id_mon_hoc" id="id_mon_hoc" class="form-control select2" style="width: 100%;">
                                    @foreach ($monhocs as $monhoc)
                                    <option value="{{ $monhoc->id }}">{{$monhoc->ten_mon_hoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="cs-form">
                                <label for="mo_dang_ky">Thời gian bắt đầu</label>
                                <input type="datetime-local" class="form-control" name="mo_dang_ky" id="mo_dang_ky" />
                            </div>
                            <div class="cs-form">
                                <label for="dong_dang_ky">Thời gian kết thúc</label>
                                <input type="datetime-local" class="form-control" name="dong_dang_ky" id="dong_dang_ky" />
                            </div>
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
        ajax: "{{ route('modangkymon.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'ten_mon_hoc',
                name: 'ten_mon_hoc'
            },
            {
                data: 'khoa_hoc',
                name: 'khoa_hoc'
            },
            {
                data: 'mo_dang_ky',
                name: 'mo_dang_ky'
            },
            {
                data: 'dong_dang_ky',
                name: 'dong_dang_ky'
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
    $('#chon_ngay_bat_dau').change(function(){
        var newDate=$('#chon_ngay_bat_dau').val()
        $('.ngay_mo_dang_ky_mon').val(newDate);
    })
    $('#chon_ngay_ket_thuc').change(function(){
        var newDate=$('#chon_ngay_ket_thuc').val()
        $('.ngay_dong_dang_ky_mon').val(newDate);
    })

    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();

        if (buttonText === 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('modangkymon.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('modangkymon.index') }}").load();
        }
    });
    $('#btnMoDangKyMon').click(function(){
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#formthemmodangkymon').modal('show');
    })
    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });

    $('body').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.get("{{ route('modangkymon.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            $('#khoa_hoc').val(data.khoa_hoc);
            $('#id_mon_hoc').val(data.id_mon_hoc);
            $('#mo_dang_ky').val(data.mo_dang_ky);
            $('#dong_dang_ky').val(data.dong_dang_ky);
        })
    });
    $('#savedata').click(function(e) {
        e.preventDefault();

        var JsonArray={
            'danh_sach_mon_hoc':[]
        }
        $('#table-mo-dang-ky-mon tbody tr').each(function() {
            var checkbox = $(this).find('.chon_mo_lop');

            if (checkbox.is(':checked')) {
                var idMonHoc=checkbox.attr('data-id-mon-hoc')
                var ngaybatdau=$(this).find('.ngay_mo_dang_ky_mon').val();
                var ngayketthuc=$(this).find('.ngay_dong_dang_ky_mon').val();

                var JsonObject={
                    'id_mon_hoc':idMonHoc,
                    'ngay_bat_dau':ngaybatdau,
                    'ngay_ket_thuc':ngayketthuc,
                }
                JsonArray.danh_sach_mon_hoc.push(JsonObject);
            }
        });
        console.log(JsonArray);
        // $(this).html('Sending..');
        // $.ajax({
        //     data: $('#modalForm').serialize(),
        //     url: "{{ route('modangkymon.store') }}",
        //     type: "POST",
        //     dataType: 'json',
        //     success: function(data) {
        //         $('#modalForm').trigger("reset");
        //         $('#ajaxModelexa').modal('hide');
        //         $('#savedata').html('Lưu');
        //         table.draw();
        //     },
        //     error: function(data) {
        //         console.log('Error:', data);
        //         $('#savedata').html('Lưu');
        //     }
        // });
    });

    $('body').on('click', '.deleteBtn', function() {
        var id = $(this).data("id");
        if (confirm("Bạn có muốn xóa?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ route('modangkymon.destroy', '') }}/" + id,
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
                url: "{{ route('modangkymon.restore', '') }}/" + id,
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
