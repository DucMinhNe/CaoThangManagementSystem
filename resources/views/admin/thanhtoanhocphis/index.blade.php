@extends('admin.thanhtoanhocphis.layout')
@section('content')

<section>
    <div class="container">
        {{-- <button id="showInactiveBtn" class="btn btn-primary">Hiển thị Trạng thái 0</button> --}}

        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewBtn"> Thông tin đóng học phí </a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Khóa học</th>
                        <th>Chuyên ngành</th>
                        <th>Học kỳ</th>
                        <th>Số tiền</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Tên lớp học</th>
                        {{-- <th width="280px">Hành Động</th> --}}
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Khóa học</th>
                        <th>Chuyên ngành</th>
                        <th>Học kỳ</th>
                        <th>Số tiền</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Tên lớp học</th>
                        {{-- <th width="280px">Hành Động</th> --}}
                    </tr>
                </tfoot>
            </table>
        </div>
</section>
<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="modalForm" name="modalForm" class="form-horizontal">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" style="font-size: 0.8em">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id_hoc_phi">Học kỳ</label>
                                        <select name="id_hoc_phi" id="id_hoc_phi" class="form-control select2" style="width: 100%;">

                                            @foreach ($hocphis as $hocphi)
                                            <option  data-hoc-ky="{{$hocphi->hoc_ky}}" data-khoa-hoc="{{$hocphi->khoa_hoc}}">{{$hocphi->khoa_hoc}}.Học kì {{$hocphi->hoc_ky}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="id_lop_hoc">Lớp học</label>
                                        <select name="id_lop_hoc" id="id_lop_hoc" class="form-control select2 select2-hidden-accessible" style="width: 100%;" disabled>
                                            @foreach ($lophocs as $lophoc)
                                            <option value="{{ $lophoc->id }}">{{$lophoc->ten_lop_hoc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="chon_theo_lop_hoc_hien_tai">
                                        <label class="form-check-label" for="chon_theo_lop_hoc_hien_tai">
                                          Chọn theo lớp học hiện tại
                                        </label>
                                      </div>
                                    <div class="form-group">
                                        <label for="ma_sv">Sinh Viên</label>
                                        <select name="ma_sv" id="ma_sv" class="form-control select2 select2-hidden-accessible" style="width: 100%;">

                                        </select>
                                    </div>

                                    <div class="cs-form">
                                        <label for="id_hinh_thuc_thanh_toan">Hình thức thanh toán</label>
                                        <select name="id_hinh_thuc_thanh_toan" id="id_hinh_thuc_thanh_toan" class="form-control select2" style="width: 100%;">
                                            @foreach ($hinhthucthanhtoans as $hinhthucthanhtoan)
                                            <option value="{{ $hinhthucthanhtoan->id }}">{{$hinhthucthanhtoan->ten_hinh_thuc_thanh_toan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="paypal_payments">
                                         <div class="form-group">
                                            <label for="Paypal_paymentID">Mã GD thanh toán cần truy vấn:</label>
                                            <input type="text" class="form-control" id="Paypal_paymentID" name="Paypal_paymentID"
                                            placeholder="Mã" value="" required>
                                        </div>
                                        <div>
                                            <a class="btn btn-success" id="btn-paypal_querydr">Truy vấn thông tin giao dịch</a>
                                        </div>
                                    </div>
                                    <div class="vnpay_payments" hidden="true">
                                        <div class="form-group">
                                            <label for="vnp_TxnReQuerydr">Mã GD thanh toán cần truy vấn (vnp_TxnRef):</label>
                                            <input type="text" class="form-control" id="vnp_TxnReQuerydr" name="vnp_TxnReQuerydr"
                                            placeholder="Mã" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Thời gian khởi tạo GD thanh toán (vnp_TransactionDate):</label>
                                            <input class="form-control" data-val="true" name="transactionDate" type="text" id="transactionDate" placeholder="yyyyMMddHHmmss" value="" />
                                        </div>
                                        <div>
                                            <a class="btn btn-success" id="btn-querydr">Truy vấn thông tin giao dịch</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="savedata" value="create">Lưu</button>
                                </div>
                            </div>
                            <div class="col-md-6" style="width: auto; height: 100%; overflow: auto;">
                                Danh sách sinh viên
                                <table class="table table-bordered" id="danh_sach_sinh_vien" style="font-size: 0.8em">
                                    <thead>
                                      <tr>
                                        <th scope="col">Đóng học phí</th>
                                        <th scope="col">Mã sinh viên</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Hủy đóng</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                Thông tin giao dịch
                                <div class="paypal_payments" >
                                    <div class="form-group">
                                        <label for="payment_id"> Payment ID </label>
                                        <input type="text" class="form-control" id="payment_id" name="payment_id"
                                        placeholder="Payment ID" value=""  readonly>
                                    </div>
                                    <div  class="form-group">
                                        <label for="payer_email_address"> Payer Email Address </label>
                                        <input type="text" class="form-control" id="payer_email_address" name="payer_email_address"
                                        placeholder="Email" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="payer_id"> Payer ID </label>
                                        <input type="text" class="form-control" id="payer_id" name="payer_id"
                                        placeholder="Payer ID" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="gross_amount"> Gross Amount </label>
                                        <input type="text" class="form-control" id="gross_amount" name="gross_amount"
                                        placeholder="Gross Amount" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="paypal_fee"> Paypal fee </label>
                                        <input type="text" class="form-control" id="paypal_fee" name="paypal_fee"
                                        placeholder="Paypal fee" value="" readonly >
                                    </div>
                                    <div class="form-group">
                                        <label for="net_amount"> Net Amount </label>
                                        <input type="text" class="form-control" id="net_amount" name="net_amount"
                                        placeholder="Paypal fee" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="currency_code"> Currency Code </label>
                                        <input type="text" class="form-control" id="currency_code" name="currency_code"
                                        placeholder="Paypal fee" value="" readonly>
                                    </div>
                                </div>
                                <div class="vnpay_payments" hidden>
                                    <div class="form-group">
                                        <label for="vnp_Amount"> vnp_Amount </label>
                                        <input type="text" class="form-control" id="vnp_Amount" name="vnp_Amount"
                                        placeholder="vnp_Amount" value=""  readonly>
                                    </div>
                                    <div  class="form-group">
                                        <label for="vnp_BankCode"> vnp_BankCode </label>
                                        <input type="text" class="form-control" id="vnp_BankCode" name="vnp_BankCode"
                                        placeholder="vnp_BankCode" value=""  readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="vnp_BankTranNo"> vnp_BankTranNo </label>
                                        <input type="text" class="form-control" id="vnp_BankTranNo" name="vnp_BankTranNo"
                                        placeholder="vnp_BankTranNo" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_CardType"> vnp_CardType </label>
                                        <input type="text" class="form-control" id="vnp_CardType" name="vnp_CardType"
                                        placeholder="vnp_CardType" value="" readonly>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="vnp_OrderInfo"> vnp_OrderInfo </label>
                                        <input type="text" class="form-control" id="vnp_OrderInfo" name="vnp_OrderInfo"
                                        placeholder="vnp_OrderInfo" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_PayDate">vnp_PayDate </label>
                                        <input type="text" class="form-control" id="vnp_PayDate" name="vnp_PayDate"
                                        placeholder="vnp_PayDate" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_ResponseCode"> vnp_ResponseCode </label>
                                        <input type="text" class="form-control" id="vnp_ResponseCode" name="vnp_ResponseCode"
                                        placeholder="vnp_ResponseCode" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_TmnCodee"> vnp_TmnCode </label>
                                        <input type="text" class="form-control" id="vnp_TmnCode" name="vnp_TmnCode"
                                        placeholder="vnp_TmnCode" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_TransactionNo"> vnp_TransactionNo </label>
                                        <input type="text" class="form-control" id="vnp_TransactionNo" name="vnp_TransactionNo"
                                        placeholder="vnp_TransactionNo" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_TransactionStatus"> vnp_TransactionStatus </label>
                                        <input type="text" class="form-control" id="vnp_TransactionStatus" name="vnp_TransactionStatus"
                                        placeholder="vnp_TransactionStatus" value="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vnp_TxnRef"> vnp_TxnRef </label>
                                        <input type="text" class="form-control" id="vnp_TxnRef" name="vnp_TxnRef"
                                        placeholder="vnp_TxnRef" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(function() {
    var $option=0;
    $jsonData='{!!json_encode($hocphis)!!}';
    $hocphis=JSON.parse($jsonData);
    $('#id_lop_hoc').val('').trigger('change');
    $sinhviens=null;
    $selectMasv=null;
    $selectLopHoc=null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('thanhtoanhocphi.index') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'khoa_hoc',
                name:'khoa_hoc',
            },
            {
                data: 'ten_chuyen_nganh',
                name: 'ten_chuyen_nganh'
            },
            {
                data: 'hoc_ky',
                name: 'hoc_ky'
            },
            {
                data: 'so_tien',
                name: 'so_tien'
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
                data: 'ten_lop_hoc',
                name: 'ten_lop_hoc'
            },
            // {
            //     data: 'action',
            //     name: 'action',
            //     orderable: false,
            //     searchable: false
            // },
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

    // $('#showInactiveBtn').click(function() {
    //     var button = $(this);
    //     var buttonText = button.text();

    //     if (buttonText === 'Hiển thị Trạng thái 0') {
    //         button.text('Hiển thị Trạng thái 1');
    //         table.ajax.url("{{ route('thanhtoanhocphi.getInactiveData') }}").load();
    //     } else {
    //         button.text('Hiển thị Trạng thái 0');
    //         table.ajax.url("{{ route('thanhtoanhocphi.index') }}").load();
    //     }
    // });
    $('#chon_theo_lop_hoc_hien_tai').click(function(){
        $('#id_hoc_phi').val($('#id_hoc_phi').val()).trigger('change');
        if($(this).is(':checked')){
            $('#id_chuyen_nganh').prop('disabled',false);
            $('#id_lop_hoc').prop('disabled', false);

        }else{

            $('#id_lop_hoc').prop('disabled', true);
            $('#id_chuyen_nganh').prop('disabled',true);
        }
    })

    $('#id_hoc_phi').change(function(){

        var khoa_hoc=$(this).children("option:selected").attr('data-khoa-hoc');
        var hoc_ky=$(this).children("option:selected").attr('data-hoc-ky');

        if($('#chon_theo_lop_hoc_hien_tai').is(':checked')){
            $('#id_lop_hoc').val($('#id_lop_hoc').val()).trigger('change');
            $('#danh_sach_sinh_vien tbody').empty();
            $('#ma_sv').empty();

        }
        else{
            $.ajax({
                type:"GET",
                url:"{{env('SERVER_URL')}}/api/hocphi/danhsachsinhviendonghocphihocky/"+hoc_ky+"/"+khoa_hoc,

            }).done(function(data){
                console.log(data);
            text="";
            textOption="";
            $sinhviens=data;
            data.forEach(element => {
                textOption=textOption+'<option value="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+' - '+element.sinh_vien.ten_sinh_vien+'</option>';
                if(element.da_dong_hoc_phi==0){
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-warning text-dark">Chưa đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td></td></tr>';
                }
                else{
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-success">Đã đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td><a type="button" class="btn btn-danger huy-dong-hoc-phi" data-ma-sv="'+element.sinh_vien.ma_sv+'" style="font-size:0.8em">Hủy đóng</a></td></tr>';
                }

            });
            console.log("Xong id_lop_hoc");
            $('#ma_sv').empty();
            $('#ma_sv').append(textOption);
            if($selectMasv!=null){
                $('#ma_sv').val($selectMasv).trigger('change');
                $selectMasv=null;
            }
            $('#danh_sach_sinh_vien tbody').empty();
            $('#danh_sach_sinh_vien tbody').append(text);
            })
        }


    });

    $('#id_lop_hoc').change(function(){
        $.ajax({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/sinhvien/sinhvientheolophoc/"+$(this).val()+"/"+$('#id_hoc_phi option:selected').attr('data-hoc-ky')+"/"+$('#id_hoc_phi option:selected').attr('data-khoa-hoc'),
        }).done(function(data){
            console.log(data);
            text="";
            textOption="";
            $sinhviens=data;
            data.forEach(element => {
                textOption=textOption+'<option value="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+' - '+element.sinh_vien.ten_sinh_vien+'</option>';
                if(element.da_dong_hoc_phi==0){
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-warning text-dark">Chưa đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td></td></tr>';
                }
                else{
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-success">Đã đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td><a type="button" class="btn btn-danger huy-dong-hoc-phi" data-ma-sv="'+element.sinh_vien.ma_sv+'" style="font-size:0.8em">Hủy đóng</a></td></tr>';
                }

            });
            console.log("Xong id_lop_hoc");
            $('#ma_sv').append(textOption);
            if($selectMasv!=null){
                $('#ma_sv').val($selectMasv).trigger('change');
                $selectMasv=null;
            }
            $('#danh_sach_sinh_vien tbody').empty();
            $('#danh_sach_sinh_vien tbody').append(text);
        });
    })
    $(document).on('click','.xem_thong_tin_thanh_toan',function(){
        $('#ma_sv').val($(this).attr('data-ma-sv')).trigger('change');
    })
    $(document).on('click','.huy-dong-hoc-phi',function(){
        var ma_sv=$(this).attr('data-ma-sv');
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
        title: 'Chắc muốn hủy đóng học phí của sinh viên này?',
        text: "Bạn có thể khôi phục lại được!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa!',
        cancelButtonText: 'Hủy thao tác!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            var id_hoc_phi=$('#id_hoc_phi').val();
            var dataJson={
                'id_hoc_phi':id_hoc_phi,
                'ma_sv':ma_sv,
            };
            $.ajax({
                url:'{{route('thanhtoanhocphi.huydonghocphi')}}',
                method:"POST",
                data:dataJson,
                dataType: 'json',
            }).done(response=>{
                reloadLopHoc();
                swalWithBootstrapButtons.fire(
                'Hủy học phí!',
                'Đã hủy thành công.',
                'success'
                )
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Hủy thao tác',
            'Tui biết bạn ấn nhầm mà :)',
            'error'
            )
        }
        })
    })
    $('#ma_sv').change(function(){

        console.log("Dô");

        ma_sv=$(this).val();
        console.log($sinhviens);
        //console.log(ma_sv);
        $sinhviens.forEach(sinhvien => {
            //console.log(sinhvien);
            if(sinhvien.sinh_vien.ma_sv==ma_sv){
                $('#id_hinh_thuc_thanh_toan').val(1).trigger('change');
                if(sinhvien.da_dong_hoc_phi==0){
                    $('#savedata').prop("disabled",false);
                    $('#btn-paypal_querydr').css('display','block');
                    $('#btn-querydr').css('display','block');
                    $('.paypal_payments input').val("");
                    console.log("Dính");
                }else{
                    thongtinthanhtoan=sinhvien.thong_tin_thanh_toan;
                    console.log(thongtinthanhtoan);
                    $('#id_hinh_thuc_thanh_toan').val(thongtinthanhtoan.hinh_thuc_thanh_toan.id).trigger('change');
                    if(thongtinthanhtoan.hinh_thuc_thanh_toan.id==1){
                        $('#payment_id').val(thongtinthanhtoan.thong_tin_thanh_toan.payment_id);
                        $('#payer_email_address').val(thongtinthanhtoan.thong_tin_thanh_toan.payer_email_address);
                        $('#payer_id').val(thongtinthanhtoan.thong_tin_thanh_toan.payer_id);
                        $('#gross_amount').val(thongtinthanhtoan.thong_tin_thanh_toan.gross_amount);
                        $('#paypal_fee').val(thongtinthanhtoan.thong_tin_thanh_toan.paypal_fee);
                        $('#net_amount').val(thongtinthanhtoan.thong_tin_thanh_toan.net_amount);
                        $('#currency_code').val(thongtinthanhtoan.thong_tin_thanh_toan.currency_code);

                        $('#btn-paypal_querydr').css('display','none');
                    }
                    if(thongtinthanhtoan.hinh_thuc_thanh_toan.id==2){
                        $('#vnp_Amount').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_Amount);
                        $('#vnp_BankCode').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_BankCode);
                        $('#vnp_OrderInfo').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_OrderInfo);
                        $('#vnp_PayDate').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_PayDate);
                        $('#vnp_ResponseCode').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_ResponseCode);
                        $('#vnp_TmnCode').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_TmnCode);
                        $('#vnp_TransactionNo').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_TransactionNo);
                        $('#vnp_TransactionStatus').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_TransactionStatus);
                        $('#vnp_TxnRef').val(thongtinthanhtoan.thong_tin_thanh_toan.vnp_TxnRef);
                        $('#btn-querydr').css('display','none');
                    }
                    $('#savedata').prop("disabled",true);

                }

            }
        });
    });
    $('#createNewBtn').click(function() {

        $('#savedata').val("create-Btn");
        $('#id').val('');
        $('#chon_theo_lop_hoc_hien_tai').prop('checked',false);
        $('#btn-paypal_querydr').css('display','none');
        $('#btn-querydr').css('display','none');
        // $('#danh_sach_sinh_vien tbody').empty();
        $('#modalForm').trigger("reset");
        // $('#modelHeading').html("Thêm");
        $('#ajaxModelexa').modal('show');
    });
    $('#id_hinh_thuc_thanh_toan').change(function(){

        if($(this).val()==1){

            $('.vnpay_payments input').val("");

            $(".paypal_payments").attr("hidden",false);
            $(".vnpay_payments").attr("hidden",true);
        }else{

            $('.paypal_payments input').val("");
            $(".paypal_payments").attr("hidden",true);
            $(".vnpay_payments").attr("hidden",false);
        }
    })
    $('#btn-querydr').click(function(){
        var btn_loading='<div class="spinner-border text-light" role="status"><span class="visually-hidden"></span> </div>'
        $(this).html(btn_loading);
        $.ajax({
            method:"GET",
            url:'{{route('thanhtoanhocphi.getVNPayPaymentDetail')}}',
            data:{
                'vnp_TxnRef':$('#vnp_TxnReQuerydr').val(),
                'vnp_PayDate':$('#transactionDate').val(),
            }
        }).done(function(data){
           $dataVnpayPayment=data;
            $('#vnp_Amount').val(data.vnp_Amount);
            $('#vnp_BankCode').val(data.vnp_BankCode);
            $('#vnp_OrderInfo').val(data.vnp_OrderInfo);
            $('#vnp_PayDate').val(data.vnp_PayDate);
            $('#vnp_ResponseCode').val(data.vnp_ResponseCode);
            $('#vnp_TmnCode').val(data.vnp_TmnCode);
            $('#vnp_TransactionNo').val(data.vnp_TransactionNo);
            $('#vnp_TransactionStatus').val(data.vnp_TransactionStatus);
            $('#vnp_TxnRef').val(data.vnp_TxnRef);
            $('#btn-querydr').text('Truy vấn thông tin giao dịch');
        })
    })
    $('#btn-paypal_querydr').click(function(){
        var btn_loading='<div class="spinner-border text-light" role="status"><span class="visually-hidden"></span> </div>'
        $(this).html(btn_loading);
        $.ajax({
            method:"GET",
            url:'{{route('thanhtoanhocphi.getPaypalOrderDetail')}}',
            data:{
                'Paypal_paymentID':$('#Paypal_paymentID').val(),
            }
        }).done(function(data){
            $dataPaypalPayment=data;
            console.log(data);
           try {
                $('#payment_id').val(data.id);
                $('#payer_email_address').val(data.payer.email_address);
                $('#payer_id').val(data.payer.payer_id);
                $('#gross_amount').val(data.purchase_units[0].payments.captures[0].seller_receivable_breakdown.gross_amount.value);
                $('#paypal_fee').val(data.purchase_units[0].payments.captures[0].seller_receivable_breakdown.paypal_fee.value);
                $('#net_amount').val(data.purchase_units[0].payments.captures[0].seller_receivable_breakdown.net_amount.value);
                $('#currency_code').val(data.purchase_units[0].amount.currency_code);
                $('#btn-paypal_querydr').text('Truy vấn thông tin giao dịch');
           } catch (error) {
                $('#btn-paypal_querydr').text('Truy vấn thông tin giao dịch');
           }



        })

    })
    $('body').on('click', '.editBtn', function() {
        // $('#savedata').html('Đóng');
        $option=0;
        var id = $(this).data('id');
        var id_lop_hoc=$(this).attr('data-id-lop-hoc');
        var hoc_ky=$(this).attr('data-hoc-ky');
        var khoa_hoc=$(this).attr('data-khoa-hoc');
        $selectLopHoc=id_lop_hoc;
        var ma_sv=$(this).attr('data-ma-sv');
        $selectMasv=ma_sv

        // $('#id_hoc_phi').val(id_hoc_phi).trigger('change').promise().done(function() {
        //     $('#id_lop_hoc').val(id_lop_hoc).trigger('change').promise().done(function() {
        //             $('#ma_sv').val(ma_sv).trigger('change');
        //         });
        //     });

        // $('#id_hoc_phi').val(id_hoc_phi).trigger('change');
        $('#id_hoc_phi option').filter(function() {
            return $(this).data('hoc-ky') == hoc_ky && $(this).data('khoa-hoc') == khoa_hoc;
        }).prop('selected', true);
        $.get("{{ route('thanhtoanhocphi.index') }}" + '/' + id + '/edit', function(data) {

            // $('#ma_sv').val(data.ma_sv);
            $('#id_hinh_thuc_thanh_toan').val(data.id_hinh_thuc_thanh_toan).trigger('change');
            $('#chon_theo_lop_hoc_hien_tai').prop('checked',false);
            thong_tin_giao_dich=data.thong_tin_giao_dich;
            if(data.id_hinh_thuc_thanh_toan==1){
                $('.paypal_payments').attr('hidden',false);
                $('.vnpay_payments').attr('hidden',true);
                // console.log(thong_tin_giao_dich.payment_id);
                // console.log("Dô");
                $('#payment_id').val(thong_tin_giao_dich.payment_id);
                $('#payer_email_address').val(thong_tin_giao_dich.payer_email_address);
                $('#payer_id').val(thong_tin_giao_dich.payer_id);
                $('#gross_amount').val(thong_tin_giao_dich.gross_amount);
                $('#paypal_fee').val(thong_tin_giao_dich.paypal_fee);
                $('#net_amount').val(thong_tin_giao_dich.net_amount);
                $('#currency_code').val(thong_tin_giao_dich.currency_code);

            }
            if(data.id_hinh_thuc_thanh_toan==2){
                $('.paypal_payments').attr('hidden',true);
                $('.vnpay_payments').attr('hidden',false);
                $('#vnp_Amount').val(thong_tin_giao_dich.vnp_Amount);
                $('#vnp_BankCode').val(thong_tin_giao_dich.vnp_BankCode);
                $('#vnp_OrderInfo').val(thong_tin_giao_dich.vnp_OrderInfo);
                $('#vnp_PayDate').val(thong_tin_giao_dich.vnp_PayDate);
                $('#vnp_ResponseCode').val(thong_tin_giao_dich.vnp_ResponseCode);
                $('#vnp_TmnCode').val(thong_tin_giao_dich.vnp_TmnCode);
                $('#vnp_TransactionNo').val(thong_tin_giao_dich.vnp_TransactionNo);
                $('#vnp_TransactionStatus').val(thong_tin_giao_dich.vnp_TransactionStatus);
                $('#vnp_TxnRef').val(thong_tin_giao_dich.vnp_TxnRef);
            }
            $('#ajaxModelexa').modal('show');
            // $('#so_tien').val(data.so_tien);
            // $('#ngay_bat_dau').val(data.ngay_bat_dau);
            // $('#ngay_ket_thuc').val(data.ngay_ket_thuc);
            // $('#hoc_ky').val(data.hoc_ky);
        })
    });
    function reloadLopHoc(){
        $.ajax({
            method:"GET",
            url:"{{env('SERVER_URL')}}/api/sinhvien/sinhvientheolophoc/"+$('#id_lop_hoc').val()+"/"+$('#id_hoc_phi option:selected').attr('data-hoc-ky')+"/"+$('#id_hoc_phi option:selected').attr('data-khoa-hoc'),
        }).done(function(data){
            console.log(data);
            text="";

            $sinhviens=data;
            data.forEach(element => {
                // textOption=textOption+'<option value="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+' - '+element.sinh_vien.ten_sinh_vien+'</option>';
                if(element.da_dong_hoc_phi==0){
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-warning text-dark">Chưa đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td></td></tr>';
                }
                else{
                    text=text+'<tr><td><div class="form-check"><span class="badge rounded-pill bg-success">Đã đóng</span></div></td><td><a href="#" class="xem_thong_tin_thanh_toan" data-ma-sv="'+element.sinh_vien.ma_sv+'">'+element.sinh_vien.ma_sv+'</a></td><td>'+element.sinh_vien.ten_sinh_vien+'</td><td><a type="button" class="btn btn-danger huy-dong-hoc-phi" data-ma-sv="'+element.sinh_vien.ma_sv+'" style="font-size:0.8em">Hủy đóng</a></td></tr>';
                }

            });
            // $('#ma_sv').append(textOption);
            $('#danh_sach_sinh_vien tbody').empty();
            $('#danh_sach_sinh_vien tbody').append(text);
        });
    }
    $('#savedata').click(function(e) {
        e.preventDefault();
            $(this).html('Sending..');
            console.log("OK");

            $.ajax({
                data: $('#modalForm').serialize(),
                url: "{{ route('thanhtoanhocphi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if(data.status==1){
                        // $('#modalForm').trigger("reset");
                        // $('#ajaxModelexa').modal('hide');
                        // $('#savedata').html('Lưu');
                        reloadLopHoc();
                        console.log("OK");
                        table.draw();
                    }
                    if(data.status==2){
                        Swal.fire({
                        icon: 'error',
                        title: 'Lỗi...',
                        text: data.message,
                        // footer: '<a href="">Why do I have this issue?</a>'
                        })
                    }

                },
                error: function(data) {
                    console.log('Error:', data);

                }
            });

    });

    // $('body').on('click', '.deleteBtn', function() {
    //     var id = $(this).data("id");
    //     if (confirm("Bạn có muốn xóa?")) {
    //         $.ajax({
    //             type: "DELETE",
    //             url: "{{ route('thanhtoanhocphi.destroy', '') }}/" + id,
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
    //             url: "{{ route('thanhtoanhocphi.restore', '') }}/" + id,
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
