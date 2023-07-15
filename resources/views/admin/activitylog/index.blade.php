@extends('admin.layouts.layout')
@section('content')
<section>
    <div class="container">
        {{-- <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button> --}}

        {{-- <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm </a>
        </ul> --}}
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mã</th>
                        {{-- <th>Vai trò</th> --}}
                        <th>Tên người thực hiện</th>
                        <th>Nội dung </th>
                        <th>Thời gian</th>
                        <th width="280px">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Mã</th>
                        {{-- <th>Vai trò</th> --}}
                        <th>Tên người thực hiện</th>
                        <th>Nội dung </th>
                        <th>Thời gian</th>
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
                <button type="button" class="close" id="closeBtn">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <div id="content">

                </div>
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
        ajax: "{{ route('activitylog.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data:'causer_id',
                name:'causer_id'
            },
            // {
            //     data:'causer_type',
            //     name:'causer_type',
            //     render: function(data, type, full, meta) {
            //        console.log(data);
            //     }
            // },
            {
                data: 'ten_giang_vien',
                name: 'ten_giang_vien'
            },
            {
                data: 'description',
                name:'description',
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, full, meta) {

                    const date = new Date(data);

                    const day = date.getDate().toString().padStart(2, '0');
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const year = date.getFullYear().toString();
                    const hours = date.getHours().toString().padStart(2, '0');
                    const minutes = date.getMinutes().toString().padStart(2, '0');
                    const seconds = date.getSeconds().toString().padStart(2, '0');

                    const formattedDate = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
                    return formattedDate;
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
        order: [[4, 'desc']]
    });


    $('#closeBtn').click(function(){
        $('#modalForm').trigger("reset");
        $('#ajaxModelexa').modal('hide');
    })
    function formattedDate(data){
        const date = new Date(data);

                    const day = date.getDate().toString().padStart(2, '0');
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const year = date.getFullYear().toString();
                    const hours = date.getHours().toString().padStart(2, '0');
                    const minutes = date.getMinutes().toString().padStart(2, '0');
                    const seconds = date.getSeconds().toString().padStart(2, '0');

                    const formattedDate = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
                    return formattedDate;
    }
    $('body').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.get("{{ route('activitylog.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Xem");
            $('#savedata').val("edit-Btn");
            $('#ajaxModelexa').modal('show');
            text="";
          if(data.object=="mo_dang_ky_mons"){
            temp1=data.data.old.da_dong==1?"Đã đóng":"Đang mở";
            temp2=data.data.attributes.da_dong==1?"Đã đóng":"Đang mở";
            text="<p>Tên môn học: "+data.mon_hoc.ten_mon_hoc+"</p><p>Thời gian mở: "+formattedDate(data.data.old.mo_dang_ky)+" &#8594; "+formattedDate(data.data.attributes.mo_dang_ky)+"</p><p>Thời gian đóng: "+formattedDate( data.data.old.dong_dang_ky)+" &#8594; "+formattedDate( data.data.attributes.dong_dang_ky)+"</p> <p>"+temp1+"  &#8594; "+temp2+"</p>"
          }
          if(data.object=="ct_lop_hoc_phans"){
            text='<p>Tên sinh viên: '+data.sinh_vien.ten_sinh_vien+' - Mã sinh viên: '+data.sinh_vien.ma_sv+'</p><p> Tên lớp học phần: '+data.lop_hoc_phan.ten_lop_hoc_phan+' - Mã lớp: '+data.lop_hoc_phan.id+'</p><p>Điểm chuyên cần: '+data.data.old.chuyen_can+' &#8594; '+data.data.attributes.chuyen_can+'</p><p> Điểm thi 1: '+data.data.old.thi_1+' &#8594; '+data.data.attributes.thi_1+'</p><p>Điểm thi 2: '+data.data.old.thi_2+' &#8594; '+data.data.attributes.thi_2+'</p><p>Điểm tổng kết 1: '+data.data.old.tong_ket_1+' &#8594; '+data.data.attributes.tong_ket_1+'</p><p>Điểm tổng kết 2: '+data.data.old.tong_ket_2+' &#8594; '+data.data.attributes.tong_ket_2+'</p>';
          }
          console.log(text);
          $('#content').empty();
          $('#content').append(text);
        })
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
                    url: "{{ route('activitylog.destroy', '') }}/" + id,
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

});
</script>

@endsection
