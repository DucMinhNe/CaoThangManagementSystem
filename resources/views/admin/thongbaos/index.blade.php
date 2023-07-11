@extends('admin.thongbaos.layout')
@section('content')
    <section>
        <div class="container">

            <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
                <a id="showInactiveBtn" class="btn btn-primary" href="#" style="margin-right: 10px">Hiển thị danh sách đã xóa</a>
                <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thêm</a>
            </ul>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên giảng viên</th>
                            <th>Tên lớp học</th>
                            <th>Tên lớp học phần</th>
                            <th>Tiêu đề</th>
                            <th width="280px">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên giảng viên</th>
                            <th>Tên lớp học</th>
                            <th>Tên lớp học phần</th>
                            <th>Tiêu đề</th>
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
                </div>
                <div class="modal-body">
                    <form id="modalForm" name="modalForm" class="form-horizontal" enctype="multipart/form-data"
                        action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <input type="hidden" name="id" id="id">
                                        <div id="postForm">
                                            <div style="display:flex">
                                                <div class="form-group">
                                                    <label for="loai_lop_hoc">Loại lớp học</label>
                                                    <select name="loai_lop_hoc" id="loai_lop_hoc"
                                                        class="form-control select2" style="width: 100%;">
                                                        <option value="1">Lớp học </option>
                                                        <option value="2">Lớp học phần </option>
                                                    </select>
                                                </div>
                                                <div class="form-group" style="padding-left:10px;">
                                                    <label for="danh_sach_lop">Danh sách lớp học </label>
                                                    <select name="danh_sach_lop" id="danh_sach_lop"
                                                        class="form-control select2" style="width: 100%;" >



                                                    </select>
                                                </div>

                                                <div class="dropdown" style="padding-top:32px;padding-left:10px;">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton_2" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Danh sách sinh viên
                                                    </button>

                                                    <ul class="dropdown-menu" id="checkboxList"
                                                        aria-labelledby="dropdownMenuButton_2">
                                                        <li>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" id="checkbox-all"
                                                                    class="form-check-input checkbox-item" checked> Tất cả
                                                                sinh viên
                                                            </label>
                                                        </li>
                                                        <div id="danh_sach_sinh_vien">

                                                        </div>



                                                    </ul>
                                                </div>
                                            </div>



                                            <br>

                                            <div class="row-1">
                                                <div class="input-group">
                                                    <span class="input-group-text">Tiêu đề</span>
                                                    <input id="tieu_de_post" type="text" name="tieu_de"
                                                        class="form-control">
                                                </div>
                                                <br>
                                                <div class="mb-3">
                                                    @include('admin.thongbaos.post')
                                                </div>

                                            </div>




                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="savedata" value="create">Lưu</button>
                            <a class="btn btn-primary" style="color:white">Huỷ</a>
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

            $danh_sach_lop_hoc = JSON.parse('{!! json_encode($lop_hoc) !!}');
            $danh_sach_lop_hoc_phan = JSON.parse('{!! json_encode($lop_hoc_phan) !!}');
            $danh_sach_sinh_vien_thuoc_lop = null;
            // console.log($danh_sach_lop_hoc);
            // console.log($danh_sach_lop_hoc_phan);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('thongbao.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'ten_giang_vien',
                        name: 'ten_giang_vien'
                    },
                    {
                        data: 'ten_lop_hoc',
                        name: 'ten_lop_hoc'
                    },
                    {
                        data: 'ten_lop_hoc_phan',
                        name: 'ten_lop_hoc_phan'
                    },
                    {
                        data: 'tieu_de',
                        name: 'tieu_de'
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
            $('#loai_lop_hoc').change(function() {
                $loai_lop_hoc = $('#loai_lop_hoc').val();
                $text = "";
                firstSelect=0;
                if ($loai_lop_hoc == 1) {
                    $danh_sach_lop_hoc.forEach(lop_hoc => {
                        $text += "<option value='" + lop_hoc.id + "''>" + lop_hoc.ten_lop_hoc +
                            "</option>";
                        if(firstSelect==0){
                            firstSelect=lop_hoc.id;
                        }
                    });

                } else {
                    $danh_sach_lop_hoc_phan.forEach(lop_hoc_phan => {
                        $text += "<option value='" + lop_hoc_phan.id + "'>" + lop_hoc_phan
                            .ten_lop_hoc_phan +
                            "</option>";
                            if(firstSelect==0){
                            firstSelect=lop_hoc_phan.id;
                        }
                    });
                }
                $('#danh_sach_lop').empty();
                $('#danh_sach_lop').append($text);
                $('#danh_sach_lop').val(firstSelect).trigger('change');
                console.log("Xong");
            })

            $('#danh_sach_lop').change(function() {
                console.log($(this).val());
                if($(this).val()!=null){
                    $.ajax({
                    type: "GET",
                    url: "{{ env('SERVER_URL') }}/admin/thongbao/danhsachsinhvienlophoc",
                    data: {
                        'loai_lop_hoc': $('#loai_lop_hoc').val(),
                        'id_lop_hoc': $('#danh_sach_lop').val()
                    },
                    dataType: 'Json',
                }).done(function($response) {
                    console.log($response);
                    var text = "";
                    $danh_sach_sinh_vien_lop_hoc = $response;
                    $danh_sach_sinh_vien_lop_hoc.forEach(sinh_vien => {
                        text = text +
                            ' <li> <label class = "dropdown-item"> <input checked type = "checkbox" class = "form-check-input checked-sv checkbox-item" data-ma-sv = "' +
                            sinh_vien.ma_sv + '" >  ' + sinh_vien.ten_sinh_vien + '-' +
                            sinh_vien.ma_sv + ' </label> </li> ';

                    });


                    $('#danh_sach_sinh_vien').empty();
                    $('#danh_sach_sinh_vien').append(text);
                    if ($danh_sach_sinh_vien_thuoc_lop != null) {
                        $(".checked-sv").each(function() {

                            $mssv = $(this).attr('data-ma-sv');
                            for (let i = 0; i < $danh_sach_sinh_vien_thuoc_lop
                                .length; i++) {
                                if ($mssv == $danh_sach_sinh_vien_thuoc_lop[i].ma_sv) {
                                    $(this).prop('checked', true);
                                    break;
                                }else{
                                    $(this).prop('checked', false);
                                }

                            }

                        })
                        $danh_sach_sinh_vien_thuoc_lop = null;
                    }


                })
                }

            })

            // $http({
            //     method: "GET",
            //     url: "{{ env('SERVER_URL') }}/thongbao/danhsachsinhvienlophoc",
            //     params: {
            //         'loai_lop_hoc': $('#loai_lop_hoc').val();
            //     }
            // })




            $('#showInactiveBtn').click(function() {
                var button = $(this);
                var buttonText = button.text();

                if (buttonText == 'Hiển thị danh sách đã xóa') {
                    button.text('Hiển thị danh sách chính');
                    table.ajax.url("{{ route('thongbao.getInactiveData') }}").load();
                } else {
                    button.text('Hiển thị danh sách đã xóa');
                    table.ajax.url("{{ route('thongbao.index') }}").load();
                }
            });
            $('#createNewBtn').click(function() {
                $('#loai_lop_hoc').prop('disabled',false);
                $('#danh_sach_lop').prop('disabled',false);

                $('#savedata').val("create-Btn");
                $('#id').val('');
                $('#loai_lop_hoc').val(1).trigger('change');

                $('#modalForm').trigger("reset");
                $('#modelHeading').html("Thêm");
                $('#ajaxModelexa').modal('show');
                $('.note-editable').html("");
            });


            $('body').on('click', '.editBtn', function() {

                var id = $(this).data('id');
                $('#id').val(id);
                $('#modelHeading').html("Sửa")
                $.get("{{ route('thongbao.index') }}" + '/' + id + '/edit', function(data) {

                    $('#loai_lop_hoc').val(data.loai_lop_hoc).trigger('change');

                    $danh_sach_sinh_vien_thuoc_lop = data.danh_sach_sinh_vien;
                    $('#danh_sach_lop').val(data.loai_lop_hoc == 1 ? data.thong_bao.id_lop_hoc :
                        data.thong_bao.id_lop_hoc_phan).trigger('change');
                        console.log($danh_sach_sinh_vien_thuoc_lop);
                    $('#tieu_de_post').val(data.thong_bao.tieu_de);
                    // $('.note-placeholder').attr(data.thong_bao.noi_dung);

                    $('.note-editable').html(data.thong_bao.noi_dung);
                    $('#loai_lop_hoc').prop('disabled',true);
                    $('#danh_sach_lop').prop('disabled',true);
                    //console.log(data.thong_bao.noi_dung);
                    $('#ajaxModelexa').modal('show');


                })

            });

            $('#savedata').click(function(e) {
                e.preventDefault();
                var json_obj = {
                    'id': $('#id').val(),
                    'id_lop_hoc': $('#danh_sach_lop').val(),
                    'loai_lop_hoc': $('#loai_lop_hoc').val(),
                    'tieu_de': $("#tieu_de_post").val(),
                    'noi_dung': $("#summernote_post").val(),

                    'danh_sach_sinh_vien': [

                    ]

                }
                // if (json_obj.noi_dung != "") {
                //     json_obj.noi_dung += " ";
                // }
                console.log(json_obj.noi_dung);
                // if(JSON.stringify($dataOld)!==JSON.stringify($dataNew)){
                $(".checked-sv").each(function() {
                    $mssv = $(this).attr('data-ma-sv');
                    var sv_obj = {
                        'ma_sinh_vien': $mssv,
                        'trang_thai': '',

                    };
                    if ($(this).is(':checked')) {
                        sv_obj.trang_thai = 1;


                    } else {
                        sv_obj.trang_thai = 0;
                    }
                    json_obj.danh_sach_sinh_vien.push(sv_obj);
                })
                if (json_obj.danh_sach_sinh_vien.length == 0) {
                    Swal.fire('Hãy chọn sinh viên để gửi thông báo');
                } else {
                    if (json_obj.tieu_de == "")
                        Swal.fire('Không để trống tiêu đề');
                    else
                    if (json_obj.noi_dung == "")
                        Swal.fire('Không để trống nội dung');
                }


                if (json_obj.danh_sach_sinh_vien.length > 0 && json_obj.noi_dung != '' && json_obj
                    .tieu_de != '') {
                    $.ajax({
                        data: json_obj,
                        url: "{{ route('xu-ly-dang-thong-bao') }}",
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
                    $(this).html('Sending..');
                }

                console.log("Dô");


                // }

            });
            $('body').on('click', '.deleteBtn', function() {
                var id = $(this).data("id");
                console.log(id);
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

                            url: "{{ route('thongbao.destroy', '') }}/" + id,
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
                            url: "{{ route('thongbao.restore', '') }}/" + id,
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
    <script>
        var checkboxList = document.getElementById('checkboxList');
        var checkboxes = checkboxList.getElementsByClassName('checkbox-item');
        var selectAllCheckbox = checkboxes[0];
        var lastCheckboxisChecked = checkboxes[checkboxes.length - 1];
        var totalCheckbox = checkboxes.length;

        // Mặc định, chọn tất cả các checkbox
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
        checkboxList.addEventListener('change', function(event) {

            var clickedCheckbox = event.target;

            if (clickedCheckbox === selectAllCheckbox) {
                var isChecked = clickedCheckbox.checked;
                for (var i = 1; i < checkboxes.length; i++) {
                    checkboxes[i].checked = isChecked;
                }
            } else {
                var isAllChecked = true;
                for (var i = 1; i < checkboxes.length; i++) {
                    if (!checkboxes[i].checked) {
                        isAllChecked = false;
                        break;
                    }
                }
                selectAllCheckbox.checked = isAllChecked;
            }
            // // Kiểm tra xem có ít nhất một checkbox được chọn hay không
            // var isAtLeastOneChecked = false;
            // for (var i = 1; i < checkboxes.length; i++) {
            //   if (checkboxes[i].checked) {
            //     isAtLeastOneChecked = true;
            //     lastCheckboxisChecked = checkboxes[i];
            //     break;
            //   }
            // }
            //  // Kiểm tra xem có ít nhất một checkbox được chọn hay không
            // if (!isAtLeastOneChecked ) {
            //   lastCheckboxisChecked.checked = true;
            // }
            // let checkAllCheckBox = false ;
            // for(var i = 0; i<checkboxes.length;i++)
            // {
            //   if(checkboxes[i].checked)
            //   {
            //     checkAllCheckBox = true;
            //   }
            // }
            // if(selectAllCheckbox.checked==false && checkAllCheckBox==false  )
            // {
            //   checkboxes[1].checked = true;

            // }




        });
    </script>
@endsection
