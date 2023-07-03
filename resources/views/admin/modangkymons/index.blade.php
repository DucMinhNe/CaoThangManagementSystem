@extends('admin.modangkymons.layout')
@section('content')
<section>
    <div class="container">
        {{-- <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button> --}}

        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            {{-- <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm </a> --}}
            <a class="btn btn-info" href="javascript:void(0)" id="btnMoDangKyMon"> Mở đăng ký môn theo khóa theo ngành </a>
        </ul>
        <div class="modal fade bd-example-modal-lg" id="formthemmodangkymon"tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading-them">Mở đăng ký môn theo khóa theo ngành</h4>
                </div>
                <div class="modal-body">
                    <form id="modalFormThem" name="modalForm" class="form-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div >
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="khoa_hoc">Khóa</label>

                                            <select name="khoa_hoc" id="khoa_hoc" class="form-control select2" style="width: 100%;">
                                                @foreach ($khoahocs as $khoahoc)
                                                <option value="{{ $khoahoc->khoa_hoc }}">{{$khoahoc->khoa_hoc}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="chuyen_nganh">Chuyên ngành</label>
                                            <select name="chuyen_nganh" id="chuyen_nganh" class="form-control select2" style="width: 100%;">
                                                @foreach ($chuyennganhs as $chuyennganh)
                                                <option value="{{ $chuyennganh->id }}">{{$chuyennganh->ten_chuyen_nganh}}</option>
                                                @endforeach
                                            </select>
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

                                <div class="col-md-9" style="height:600px; overflow:scroll">
                                    <div>
                                       Danh sách môn
                                    </div>
                                    <table class="table table-success table-striped" id="table-mo-dang-ky-mon" >
                                        <thead>
                                            <th>ID</th>
                                            <th>Tên môn học</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Xác nhận</th>
                                        </thead>
                                        <tbody>
                                            {{-- <tr >
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
                                            </tr> --}}
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
                        <th>Trạng thái mở</th>
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
                        <th>Trạng thái mở</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </tfoot>
            </table>
        </div>
</section>
{{-- <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
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
</div> --}}

</body>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script type="text/javascript">
$(function() {
    $('#chuyen_nganh').val('').trigger('change');
    var $monhocbandau=null;
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
                data: 'da_dong',
                name: 'da_dong',
                render: function(data, type, full, meta) {
                    if (data==0) {
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
    $('#khoa_hoc').change(function(){
        var chuyennganh=$('#chuyen_nganh').val();
        // $('#table-mo-dang-ky-mon tbody').empty();
        if(chuyennganh!=""){
            $('#chuyen_nganh').val(chuyennganh).trigger('change');
        }
    })
    $('#chon_ngay_bat_dau').change(function(){
        var newDate=$('#chon_ngay_bat_dau').val()
        $('.ngay_mo_dang_ky_mon').val(newDate);
    })
    $('#chon_ngay_ket_thuc').change(function(){
        var newDate=$('#chon_ngay_ket_thuc').val()
        $('.ngay_dong_dang_ky_mon').val(newDate);
    })
    $('#chuyen_nganh').change(function(){
        var chuyennganh=$(this).val();
        $('#table-mo-dang-ky-mon tbody').empty();
        if(chuyennganh!=''){
            $.ajax({
                type:"GET",
                url:'{{route('modangkymon.danhsachmonhocmodangky')}}',
                data:{
                    'khoa_hoc':$('#khoa_hoc').val(),
                    'id_chuyen_nganh':chuyennganh
                }
            }).done(function(data){
                //console.log(data);
                var text="";
                $monhocbandau=data;
                var i=1;
                data.forEach(mon_hoc => {
                    if(mon_hoc.da_dong==0){
                        var mo_dang_ky
                        text=text+'<tr><td>'+i+'</td><td>'+mon_hoc.mon_hoc.ten_mon_hoc+'</td><td><input type="datetime-local" class="form-control ngay_mo_dang_ky_mon" name="ngay_mo_dang_ky_mon" value="'+mon_hoc.mo_dang_ky+'"/></td> <td><input type="datetime-local" class="form-control ngay_dong_dang_ky_mon" name="ngay_dong_dang_ky_mon" value="'+mon_hoc.dong_dang_ky+'"/></td><td><input type="checkbox" checked class="chon_mo_lop" data-id-mon-hoc="'+mon_hoc.mon_hoc.id+'" ></td></tr>';
                    }else{
                        text=text+'<tr><td>'+i+'</td><td>'+mon_hoc.mon_hoc.ten_mon_hoc+'</td><td><input type="datetime-local" class="form-control ngay_mo_dang_ky_mon" name="ngay_mo_dang_ky_mon" value="'+mon_hoc.mo_dang_ky+'"/></td> <td><input type="datetime-local" class="form-control ngay_dong_dang_ky_mon" name="ngay_dong_dang_ky_mon" value="'+mon_hoc.dong_dang_ky+'"/></td><td><input type="checkbox" class="chon_mo_lop" data-id-mon-hoc="'+mon_hoc.mon_hoc.id+'" ></td></tr>';
                    }
                    i=i+1;

                });
                $('#table-mo-dang-ky-mon tbody').append(text);
            });
        }
    })
    // $('#showInactiveBtn').click(function() {
    //     var button = $(this);
    //     var buttonText = button.text();

    //     if (buttonText === 'Hiển thị Trạng thái 0') {
    //         button.text('Hiển thị Trạng thái 1');
    //         table.ajax.url("{{ route('modangkymon.getInactiveData') }}").load();
    //     } else {
    //         button.text('Hiển thị Trạng thái 0');
    //         table.ajax.url("{{ route('modangkymon.index') }}").load();
    //     }
    // });
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
        var khoa_hoc=$(this).data('khoa-hoc');
        // $('#table-mo-dang-ky-mon tbody').empty();
        $('#chuyen_nganh').val("").trigger('change');
        var chuyen_nganh=$(this).data('id-chuyen-nganh');
        $('#khoa_hoc').val(khoa_hoc).trigger('change');
        $('#chuyen_nganh').val(chuyen_nganh).trigger('change');

        // $('#modalForm').trigger("reset");
        $('#formthemmodangkymon').modal('show');
    });
    $(document).on('change','.chon_mo_lop',function(){
        var row = $(this).closest('tr');
        var ngaymodangky = row.find('.ngay_mo_dang_ky_mon').val();
        var ngaydongdangky = row.find('.ngay_dong_dang_ky_mon').val();
        if(ngaydongdangky==""||ngaymodangky==""){
            $(this).prop('checked', false);
        }

    });
    $('#savedata').click(function(e) {
        e.preventDefault();

        var JsonArray={
            'khoa_hoc':$('#khoa_hoc').val(),
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
                    'da_dong':0,
                }
                JsonArray.danh_sach_mon_hoc.push(JsonObject);
            }

        });
        for (let i = 0; i < $monhocbandau.length; i++) {
            var kiemtra=true;
            for (let j = 0; j < JsonArray.danh_sach_mon_hoc.length; j++) {
                if(JsonArray.danh_sach_mon_hoc[j].id_mon_hoc==$monhocbandau[i].mon_hoc.id){
                    kiemtra=false;
                    break;
                }
                //kiemtra=true;
            }
            if(kiemtra==true&&$monhocbandau[i].mo_dang_ky!=null&&$monhocbandau[i].dong_dang_ky!=null){

                var JsonObject={
                    'id_mon_hoc':$monhocbandau[i].mon_hoc.id,
                    'ngay_bat_dau':$monhocbandau[i].mo_dang_ky,
                    'ngay_ket_thuc':$monhocbandau[i].dong_dang_ky,
                    'da_dong':1,
                }
                JsonArray.danh_sach_mon_hoc.push(JsonObject);
            }
        }
        Swal.fire({
            title: 'Bạn có muốn lưu thay đổi?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Lưu',
            denyButtonText: `Không`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url:"{{route('modangkymon.modangky')}}",
                type:"POST",
                data:JsonArray,
                dataType:'json',
            }).done(function(response){
                if(response.status==1){
                    Swal.fire('Lưu thành công!', '', 'success')
                }
                table.draw();
            })
        } else if (result.isDenied) {
            Swal.fire('Đã hủy lưu', '', 'info')
        }
        })

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

    $('body').on('click', '.closeBtn', function() {
        var id = $(this).data("id");
        if (confirm("Bạn có muốn đóng?")) {
            $.ajax({
                type: "POST",
                url: "{{ route('modangkymon.close', '') }}/" + id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });
    // $('body').on('click', '.restoreBtn', function() {
    //     var id = $(this).data("id");
    //     if (confirm("Bạn có muốn khôi phục?")) {
    //         $.ajax({
    //             type: "GET",
    //             url: "{{ route('modangkymon.restore', '') }}/" + id,
    //             success: function(data) {
    //                 table.draw();
    //             },
    //             error: function(data) {
    //                 console.log('Error:', data);
    //             }
    //         });
    //     }
    // });
});
</script>

@endsection
