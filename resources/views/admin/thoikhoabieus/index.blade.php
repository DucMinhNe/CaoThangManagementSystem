@extends('admin.layouts.layout')
@section('content')
<section>
    <div class="container">
        {{-- <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button> --}}
        {{-- <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm</a>
        </ul> --}}
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tên lớp học phần</th>
                        <th>Môn học</th>
                        <th>Tên lớp học</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tên lớp học phần</th>
                        <th>Môn học</th>
                        <th>Tên lớp học</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </tfoot>
            </table>
        </div>
</section>
<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" id="closeBtn">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="modalForm" name="modalForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div >
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="ten_lop_hoc_phan">Tên lớp học phần</label>
                                        <input type="text" class="form-control" id="ten_lop_hoc_phan" name="ten_lop_hoc_phan"
                                            value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_mon_hoc">Tên môn học</label>
                                        <input type="text" class="form-control" id="ten_mon_hoc" name="ten_mon_hoc"
                                             value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_lop_hoc">Tên lớp học</label>
                                        <input type="text" class="form-control" id="ten_lop_hoc" name="ten_lop_hoc"
                                             value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_giang_vien_1">Tên Giảng Viên 1</label>
                                        <input type="text" class="form-control" id="ten_giang_vien_1" name="ten_giang_vien_1"
                                             value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_giang_vien_2">Tên Giảng Viên 2</label>
                                        <input type="text" class="form-control" id="ten_giang_vien_2" name="ten_giang_vien_2"
                                             value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_giang_vien_3">Tên Giảng Viên 3</label>
                                        <input type="text" class="form-control" id="ten_giang_vien_3" name="ten_giang_vien_3"
                                             value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="hoc_ky">Học kỳ</label>
                                        <select name="hoc_ky" id="hoc_ky" class="form-control select2" style="width: 100%;" disabled>
                                            <option value="1">Học kỳ 1</option>
                                            <option value="2">Học kỳ 2</option>
                                            <option value="3">Học kỳ 3</option>
                                            <option value="4">Học kỳ 4</option>
                                            <option value="5">Học kỳ 5</option>
                                            <option value="6">Học kỳ 6</option>
                                         </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thu_trong_tuan">Thứ</label>
                                        <select name="thu_trong_tuan" id="thu_trong_tuan" class="form-control select2" style="width: 100%;">
                                           <option value="1">Thứ 2</option>
                                           <option value="2">Thứ 3</option>
                                           <option value="3">Thứ 4</option>
                                           <option value="4">Thứ 5</option>
                                           <option value="5">Thứ 6</option>
                                           <option value="6">Thứ 7</option>
                                           <option value="7">Chủ nhật</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_tiet_bat_dau">Tiết bắt đầu</label>
                                        <select name="id_tiet_bat_dau" id="id_tiet_bat_dau" class="form-control select2" style="width: 100%;">
                                            @foreach ($thoigianbieus as $thoigianbieu)
                                            <option value="{{ $thoigianbieu->id }}">{{$thoigianbieu->stt}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_tiet_ket_thuc">Tiết kết thúc</label>
                                        <select name="id_tiet_ket_thuc" id="id_tiet_ket_thuc" class="form-control select2" style="width: 100%;">
                                            @foreach ($thoigianbieus as $thoigianbieu)
                                            <option value="{{ $thoigianbieu->id }}">{{$thoigianbieu->stt}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_phong_hoc">Phòng học</label>
                                        <select name="id_phong_hoc" id="id_phong_hoc" class="form-control select2" style="width: 100%;">
                                            @foreach ($phonghocs as $phonghoc)
                                            <option value="{{ $phonghoc->id }}">{{$phonghoc->ten_phong}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <a class="btn btn-success" id="add-row-tkb">Thêm tiết học</a>
                            </div>
                            <div class="col">
                                <div>
                                    Thời khóa biểu
                                </div>
                                <table class="table table-success table-striped" id="table-thoi-khoa-bieu">
                                    <thead>
                                        <th>Thứ</th>
                                        <th>Tiết học</th>
                                        <th>Thời gian</th>
                                        <th>Phòng học</th>
                                        <th>Học kỳ</th>
                                        <th>Xóa</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2</td>
                                            <td data-id="1">1</td>
                                            <td>2</td>
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
</body>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
$(function() {
var $thoigianbieus='{!!json_encode($thoigianbieus)!!}';
var $phonghocs='{!!json_encode($phonghocs)!!}'
var $dataOld;
var $dataNew;
var $thoigianbieus=JSON.parse ($thoigianbieus);
var $phonghocs=JSON.parse($phonghocs);
console.log($phonghocs);
var $arrayThu=["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"]
console.log($thoigianbieus);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('thoikhoabieu.index') }}",
    columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'ten_lop_hoc_phan',
            name: 'ten_lop_hoc_phan'
        },
        {
            data: 'ten_mon_hoc',
            name: 'ten_mon_hoc'
        },
        {
            data: 'ten_lop_hoc',
            name: 'ten_lop_hoc'
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
$('#id_tiet_bat_dau').change(function(){
    text="";
    for(let i=0;i<$thoigianbieus.length;i=i+1){
        if($thoigianbieus[i].id==$(this).val()){
            for(let j=i;j<$thoigianbieus.length;j=j+1){
                text=text+ '<option value="'+$thoigianbieus[j].id+'">'+$thoigianbieus[j].stt+'</option>';
            }
            break;
        }
    }
    $('#id_tiet_ket_thuc').empty();
    $('#id_tiet_ket_thuc').append(text);
})
$('#closeBtn').click(function(){
        $('#modalForm').trigger("reset");
        $('#ajaxModelexa').modal('hide');
    })
$('body').on('click', '.editBtn', function() {
    var id = $(this).data('id');

    $.get("{{ route('thoikhoabieu.index') }}" + '/' + id + '/edit', function(data) {
        console.log(data);
        $('#hoc_ky').prop('disabled',true);
        $('#modelHeading').html("Sửa");
        $('#savedata').val("edit-Btn");
        $('#ajaxModelexa').modal('show');

        $('#id').val(data.id);

        $('#ten_giang_vien_1').val(data.giang_vien_1!=null?data.giang_vien_1.ten_giang_vien:"Trống");
        $('#ten_giang_vien_2').val(data.giang_vien_2!=null?data.giang_vien_2.ten_giang_vien:"Trống");
        $('#ten_giang_vien_3').val(data.giang_vien_3!=null?data.giang_vien_3.ten_giang_vien:"Trống");
        $('#ten_lop_hoc_phan').val(data.ten_lop_hoc_phan);
        $('#ten_lop_hoc').val(data.lop_hoc!=null?data.lop_hoc.ten_lop_hoc:"Trống");
        $('#ten_mon_hoc').val(data.mon_hoc!=null?data.mon_hoc.ten_mon_hoc:"Trống");
        if(data.hoc_ky==null){
            $('#hoc_ky').prop('disabled',false);
            $('#hoc_ky').val('').trigger('change');
        }else
            $('#hoc_ky').val(data.hoc_ky).trigger('change');
        text="";
        row=0;
        $dataOld=$dataNew= data.lich_hoc;
        data.lich_hoc.forEach(element => {
            row=row+1;
            text=text+'<tr data-row-tkb="'+row+'"><td data-thu_trong_tuan="'+element.thu_trong_tuan+'">'+$arrayThu[element.thu_trong_tuan-1]+'</td><td data-id-tiet-bat-dau="'+element.tiet_bat_dau.id+'" data-id-tiet-ket-thuc="'+element.tiet_ket_thuc.id+'">'+element.tiet_bat_dau.stt+' &#8594; '+element.tiet_ket_thuc.stt+'</td><td >'+element.tiet_bat_dau.thoi_gian_bat_dau+' &#8594; '+element.tiet_ket_thuc.thoi_gian_ket_thuc+'</td><td data-phong="'+element.phong_hoc.id+'">'+element.phong_hoc.ten_phong+'</td><td data-hoc-ky="'+element.hoc_ky+'">'+element.hoc_ky+'</td><td><a class="btn btn-warning remove-row" data-row-tkb="'+row+'">Bỏ</a></td></tr>';
        });
        $('#table-thoi-khoa-bieu tbody').empty();
        $('#table-thoi-khoa-bieu tbody').append(text);
        // $('#ma_gv').val(data.ma_gv);
        // $('#id_chuc_vu').val(data.id_chuc_vu);
    })
});

$('#savedata').click(function(e) {
    e.preventDefault();

    // if(JSON.stringify($dataOld)!==JSON.stringify($dataNew)){
        $(this).html('Sending..');
        console.log("Dô");
        $dataSend={
            'id_lop_hoc_phan':$('#id').val(),
            'lich_hoc':$dataNew,
        };
        $.ajax({
            data: $dataSend,
            url: "{{ route('thoikhoabieu.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $('#modalForm').trigger("reset");
                //$('#ajaxModelexa').modal('hide');
                $('#savedata').html('Lưu');
                table.draw();
            },
            error: function(data) {
                console.log('Error:', data);
                $('#savedata').html('Lưu');
            }
        });
    // }

});
$('body').on('click','.remove-row',function(){
    var row=$(this).data('row-tkb');
    $dataNew.splice(row-1,1);
    $('#table-thoi-khoa-bieu tr[data-row-tkb="'+row+'"]').remove();
})
$('#add-row-tkb').click(function(){
    var id_tiet_bat_dau=$('#id_tiet_bat_dau').val();
    var id_tiet_ket_thuc=$('#id_tiet_ket_thuc').val();
    var id_phong_hoc=$('#id_phong_hoc').val();
    var thu_trong_tuan=$('#thu_trong_tuan').val();
    var hoc_ky=$('#hoc_ky').val();
    var tiet_bat_dau;
    var tiet_ket_thuc;
    var phong_hoc;
    var flag=true;

    $thoigianbieus.forEach(element => {
        if(element.id==id_tiet_bat_dau){
            tiet_bat_dau=element;
        }
        if(element.id==id_tiet_ket_thuc){
            tiet_ket_thuc=element;
        }
    });
    $phonghocs.forEach(element => {
        if(element.id==id_phong_hoc)
            phong_hoc=element;
    });
    row=$('#table-thoi-khoa-bieu tbody tr').length+1;
    $dataNew.forEach(element => {
        if(element.thu_trong_tuan==thu_trong_tuan&&element.hoc_ky==hoc_ky){
            var start = element.tiet_bat_dau.stt;
            var end = element.tiet_ket_thuc.stt;
            var arrayLich1 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
            var start = tiet_bat_dau.stt;
            var end = tiet_ket_thuc.stt;
            var arrayLich2 = Array.from({ length: end - start + 1 }, (_, index) => index + start);
            if(arrayLich1.some(element => arrayLich2.includes(element)))
            {
                flag=false;
            }
        }
    });
    if(flag==true){
        jsonOject={
            'id_tiet_bat_dau':id_tiet_bat_dau,
            'id_tiet_ket_thuc':id_tiet_ket_thuc,
            'id_phong_hoc':id_phong_hoc,
            'thu_trong_tuan':thu_trong_tuan,
            'hoc_ky':hoc_ky,
        }
        $.ajax({
            method:"GET",
            url:'{{route('thoikhoabieu.kiemtratrungphongtrungtiet')}}',
            data:jsonOject
        }).done(function(response){
            if(response.status==1){
                text='<tr data-row-tkb="'+row+'"><td data-thu_trong_tuan="'+thu_trong_tuan+'">'+$arrayThu[thu_trong_tuan-1]+'</td><td data-id-tiet-bat-dau="'+tiet_bat_dau.id+'" data-id-tiet-ket-thuc="'+tiet_ket_thuc.id+'">'+tiet_bat_dau.stt+' -> '+tiet_ket_thuc.stt+'</td><td >'+tiet_bat_dau.thoi_gian_bat_dau+' -> '+tiet_ket_thuc.thoi_gian_ket_thuc+'</td><td data-phong="'+phong_hoc.id+'">'+phong_hoc.ten_phong+'</td><td data-hoc-ky="'+hoc_ky+'">'+hoc_ky+'</td><td><a class="btn btn-warning remove-row" data-row-tkb="'+row+'">Bỏ</a></td></tr>';
                jsonOject={
                    'thu_trong_tuan':thu_trong_tuan,
                    'tiet_bat_dau':tiet_bat_dau,
                    'tiet_ket_thuc':tiet_ket_thuc,
                    'hoc_ky':hoc_ky,
                    'phong_hoc':phong_hoc
                }
                $dataNew.push(jsonOject);
                console.log($dataNew);
                $('#table-thoi-khoa-bieu tbody').append(text);
            }else{
                Swal.fire({
                icon: 'error',
                title: 'Lỗi...',
                text: 'Trùng lịch!',
                // footer: '<a href="">Why do I have this issue?</a>'
                })
            }
        })

    }else{
        Swal.fire({
        icon: 'error',
        title: 'Lỗi...',
        text: 'Trùng lịch!',
        // footer: '<a href="">Why do I have this issue?</a>'
        })
    }


})
// $('body').on('click', '.deleteBtn', function() {
//     var id = $(this).data("id");
//     if (confirm("Bạn có muốn xóa?")) {
//         $.ajax({
//             type: "DELETE",
//             url: "{{ route('danhsachchucvugiangvien.destroy', '') }}/" + id,
//             success: function(data) {
//                 table.draw();
//             },
//             error: function(data) {
//                 console.log('Error:', data);
//             }
//         });
//     }
// });
// $('body').on('click', '.restoreBtn', function() {
//     var id = $(this).data("id");
//     if (confirm("Bạn có muốn khôi phục?")) {
//         $.ajax({
//             type: "GET",
//             url: "{{ route('danhsachchucvugiangvien.restore', '') }}/" + id,
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
