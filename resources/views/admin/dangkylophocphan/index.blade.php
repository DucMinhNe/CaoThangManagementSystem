@extends('admin.layouts.layout')
@section('content')
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
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm </a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>ID lớp học phần</th>
                        <th>Tên lớp học phần</th>
                        <th>Số tiền đóng (VND)</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>ID lớp học phần</th>
                        <th>Tên lớp học phần</th>
                        <th>Số tiền đóng (VND)</th>
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
                            <label for="khoa_hoc">Khóa</label>
                            <select name="khoa_hoc" id="khoa_hoc" class="form-control select2" style="width: 100%;" disabled>
                                @foreach ($khoahocs as $khoahoc)
                                <option value="{{ $khoahoc->khoa_hoc }}">{{$khoahoc->khoa_hoc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_chuyen_nganh">Ngành</label>
                            <select name="id_chuyen_nganh" id="id_chuyen_nganh" class="form-control select2"
                                style="width: 100%;" disabled>
                                {{-- <option value="" selected>Chọn chuyên ngành</option> --}}
                                @foreach ($chuyennganhs as $chuyennganh)
                                <option value="{{ $chuyennganh->id }}">{{$chuyennganh->ten_chuyen_nganh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_mon">Môn</label>
                            <select name="id_mon_hoc" id="id_mon_hoc" class="form-control select2" style="width: 100%;" disabled>
                                {{-- <option value="" selected>Chọn môn</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_lop_hoc_phan">Lớp học phần đăng ký</label>
                            <select name="id_lop_hoc_phan" id="id_lop_hoc_phan" class="form-control select2"
                                style="width: 100%;" disabled>
                                {{-- <option value="" selected>Chọn lớp học phần</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ma_sv">Sinh viên đăng ký</label>
                            <select name="ma_sv" id="ma_sv" class="form-control select2" style="width: 100%;" disabled>
                                {{-- <option value="" selected>Chọn sinh viên</option> --}}
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
        ajax: "{{ route('dangkylophocphan.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'ma_sv',
                name: 'ma_sv'
            },
            {
                data: 'ten_sinh_vien',
                name: 'ten_sinh_vien'
            },
            {
                data: 'id_lop_hoc_phan',
                name: 'id_lop_hoc_phan'
            },
            {
                data: 'ten_lop_hoc_phan',
                name: 'ten_lop_hoc_phan'
            },
            {
                data: 'tien_dong',
                name: 'tien_dong',
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

    function callAPI($url, $data, $selectElement, ...$checkedvalue) {
        $.ajax({
            method: "GET",
            url: $url,
            data: $data,
        }).then(function(response) {
            console.log($checkedvalue);
            renderData(response, $selectElement, $checkedvalue)
        })
    }

    function renderData($data, $selectElement, ...$checkedvalue) {
        console.log($selectElement);
        $textHTML = "";
        $('#' + $selectElement).empty();
        // $('#'+$selectElement).find('option').not('[value="' + emptyValue + '"]').remove();
        if ($selectElement == "id_mon_hoc") {
            $data.mon_hoc.forEach(element => {
                if ($checkedvalue.length > 0 && $checkedvalue[0] == element.id)
                    $textHTML += '<option value="' + element.id + '" selected>' + element.ten_mon_hoc +
                    '</option>'
                else
                    $textHTML += '<option value="' + element.id + '">' + element.ten_mon_hoc +
                    '</option>'
                console.log('Dô');
            });
        }
        if ($selectElement == "id_lop_hoc_phan") {
            $data.danh_sach_lop_hoc_phan.forEach(element => {
                if ($checkedvalue.length > 0 && $checkedvalue[0] == element.lop_hoc_phan.id)
                    $textHTML += '<option value="' + element.lop_hoc_phan.id + '" selected>' + element
                    .lop_hoc.ten_lop_hoc + ' - ' + element.lop_hoc_phan.ten_lop_hoc_phan + '</option>'
                else
                    $textHTML += '<option value="' + element.lop_hoc_phan.id + '">' + element.lop_hoc
                    .ten_lop_hoc + ' - ' + element.lop_hoc_phan.ten_lop_hoc_phan + '</option>'
                console.log('Dô');
            });
        }
        if ($selectElement == "ma_sv") {
            if($data.status==1){
            $data.sinh_vien.forEach(element => {
                if ($checkedvalue.length > 0 && $checkedvalue[0] == element.ma_sv)
                    $textHTML += '<option value="' + element.ma_sv + '" selected>' + element.ma_sv +
                    ' - ' + element.ten_sinh_vien + '</option>'
                else
                    $textHTML += '<option value="' + element.ma_sv + '">' + element.ma_sv + ' - ' +
                    element.ten_sinh_vien + '</option>'
            });
            }else{
                if($('#id_mon_hoc').val()!=null){
                    if($data.status==0){
                        Swal.fire(
                        'Mở đăng ký môn?',
                        'Môn này của khóa này chưa được mở',
                        'question'
                        )
                    }
                }
            }
        }
        console.log($textHTML);

        $('#' + $selectElement).append($textHTML);
        if($checkedvalue.length == 0){
            $('#'+$selectElement).val('').trigger('change');
        }

    }
    $('#showInactiveBtn').click(function() {
        var button = $(this);
        var buttonText = button.text();

        if (buttonText == 'Hiển thị Trạng thái 0') {
            button.text('Hiển thị Trạng thái 1');
            table.ajax.url("{{ route('dangkylophocphan.getInactiveData') }}").load();
        } else {
            button.text('Hiển thị Trạng thái 0');
            table.ajax.url("{{ route('dangkylophocphan.index') }}").load();
        }
    });
    $('#khoa_hoc').change(function(){
        $('#id_chuyen_nganh').val('').trigger('change');
        $('#ma_sv').empty();
        $('#id_mon_hoc').empty();
        $('#id_lop_hoc_phan').empty();
    })
    $('#id_chuyen_nganh').change(function() {
        $data = {
            "khoa_hoc": $('#khoa_hoc').val(),
            "id_chuyen_nganh": $('#id_chuyen_nganh').val(),
        }
        $url = "{{env('SERVER_URL')}}/api/chuyennganh/laymonhoctheokhoahocvanganh";
        callAPI($url, $data, 'id_mon_hoc');


    })

    $('#id_mon_hoc').change(function() {
        $data = {
            "id_mon_hoc": $("#id_mon_hoc").val(),
        }
        $url = "{{env('SERVER_URL')}}/api/lophoc/danhsachlophocphantheomon";
        callAPI($url, $data, 'id_lop_hoc_phan');
        $data = {
            "khoa_hoc": $('#khoa_hoc').val(),
            "id_mon_hoc": $("#id_mon_hoc").val(),
        }
        $url = "{{env('SERVER_URL')}}/api/sinhvien/danhsachsinhvientheokhoahocvamonno";
        callAPI($url, $data, 'ma_sv');
    })

    $('#createNewBtn').click(function() {
        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#modalForm').trigger("reset");
        $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');

        $('#khoa_hoc').val('').trigger('change');
        $('#id_chuyen_nganh').val('').trigger('change');
        $('#khoa_hoc').prop('disabled',false);
        $('#id_chuyen_nganh').prop('disabled',false);
        $('#id_mon_hoc').prop('disabled',false);
        $('#id_lop_hoc_phan').prop('disabled',false);
        $('#ma_sv').prop('disabled',false);
        $('#id_lop_hoc_phan').empty();
        $('#ma_sv').empty();
        $('#id_mon_hoc').empty();
    });
    $('body').on('click', '.reviewBtn', function() {
        var id = $(this).data('id');
        if (confirm("Bạn có muốn duyệt?")) {
            $.ajax({
                type: "GET",
                url: "{{ route('dangkylophocphan.review', '') }}/" + id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    })
    $('body').on('click', '.editBtn', function() {

        var id = $(this).data('id');
        $('#khoa_hoc').prop('disabled',true);
        $('#id_chuyen_nganh').prop('disabled',true);
        $('#id_mon_hoc').prop('disabled',true);
        $('#id_lop_hoc_phan').prop('disabled',true);
        $('#ma_sv').prop('disabled',true);

        $.get("{{ route('dangkylophocphan.index') }}" + '/' + id + '/edit', function(data) {
            console.log(data);
            $('#khoa_hoc').val(data.khoa_hoc).trigger('change');
            $('#id_chuyen_nganh').val(data.id_chuyen_nganh).trigger('change');
            $('#id_sinh_vien').empty();
            $('#id_lop_hoc_phan').empty();
            $('#id_mon_hoc').empty();
            $data = {
                "khoa_hoc": data.khoa_hoc,
                "id_chuyen_nganh": data.id_chuyen_nganh,
            }
            $url = "{{env('SERVER_URL')}}/api/chuyennganh/laymonhoctheokhoahocvanganh";
            callAPI($url, $data, 'id_mon_hoc', data.id_mon_hoc);
            $data = {
                "khoa_hoc":  data.khoa_hoc,
                "id_chuyen_nganh":data.id_chuyen_nganh,
            }
            $url = "{{env('SERVER_URL')}}/api/sinhvien/danhsachsinhvientheokhoatheonganh";
            callAPI($url, $data, 'ma_sv', data.ma_sv);
            $data = {
                "id_mon_hoc": data.id_mon_hoc,
            }
            $url = "{{env('SERVER_URL')}}/api/lophoc/danhsachlophocphantheomon";
            callAPI($url, $data, 'id_lop_hoc_phan', data.id_lop_hoc_phan);

            // $('#id_mon_hoc').val(data.id_mon_hoc).trigger('change');
            // $('#id_lop_hoc_phan').val(data.id_lop_hoc_phan);
            // $('#ma_sv').val(data.ma_sv);
            $('#modelHeading').html("Sửa");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            $('#id').val(data.id);
            // $('#ma_sv').val(data.ma_gv);
            // $('#id_lop_hoc_phan').val(data.id_chuc_vu);
        })
    });

    $('#savedata').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#modalForm').serialize(),
            url: "{{ route('dangkylophocphan.store') }}",
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
                url: "{{ route('dangkylophocphan.destroy', '') }}/" + id,
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
                url: "{{ route('dangkylophocphan.restore', '') }}/" + id,
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
