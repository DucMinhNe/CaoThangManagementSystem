<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThanhToanHocPhi;
use App\Models\HocPhi;
use App\Models\SinhVien;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHoc;
use App\Models\ChuyenNganh;
use App\Models\HinhThucThanhToan;
use App\Models\PaypalPayment;
use App\Models\VnpayPayment;
use App\Models\QuaTrinhHocTap;
use DataTables;


class ThanhToanHocPhiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ThanhToanHocPhi::leftJoin('qua_trinh_hoc_taps','qua_trinh_hoc_taps.ma_sv','thanh_toan_hoc_phis.ma_sv')
                                   ->leftJoin('sinh_viens','qua_trinh_hoc_taps.ma_sv','sinh_viens.ma_sv')
                                   ->leftJoin('lop_hocs','qua_trinh_hoc_taps.id_lop_hoc','lop_hocs.id')
                                   ->leftJoin('hoc_phis','thanh_toan_hoc_phis.id_hoc_phi','hoc_phis.id')
                                   ->leftJoin('chuyen_nganhs','chuyen_nganhs.id','hoc_phis.id_chuyen_nganh')
                                   ->select('thanh_toan_hoc_phis.*','sinh_viens.ten_sinh_vien','sinh_viens.id_lop_hoc','lop_hocs.ten_lop_hoc','hoc_phis.hoc_ky','hoc_phis.so_tien','hoc_phis.khoa_hoc','chuyen_nganhs.ten_chuyen_nganh')
                                   ->where('thanh_toan_hoc_phis.trang_thai',1)
                                   ->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    // ->addColumn('action', function($row){

                    //     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-ma-sv="'.$row->ma_sv.'" data-id-lop-hoc="'.$row->id_lop_hoc.'" data-hoc-ky="'.$row->hoc_ky.'" data-khoa-hoc="'.$row->khoa_hoc.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Xem</a>';

                    //         $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Xóa</a>';



                    //     return $btn;


                    // })
                    // ->rawColumns(['action'])
                    ->make(true);
        }
        $khoahocs=ChuongTrinhDaoTao::where('trang_thai',1)->get();
        $chuyennganhs=ChuyenNganh::where('trang_thai',1)->get();
        $lophocs=LopHoc::where('trang_thai',1)->get();
        $hocphis=HocPhi::where('hoc_phis.trang_thai',1)->select('hoc_ky','khoa_hoc')->distinct()->get();
        $sinhviens=SinhVien::where('trang_thai',1)->whereNotIn('ma_sv',ThanhToanHocPhi::select('ma_sv')->where('trang_thai',1)->get())->get();
        $hinhthucthanhtoans=HinhThucThanhToan::where('trang_thai',1)->get();
        return view('admin.thanhtoanhocphis.index',compact('hocphis','sinhviens','hinhthucthanhtoans','chuyennganhs','lophocs'));
    }
    public function getInactiveData()
    {
        $data = ThanhToanHocPhi::leftJoin('qua_trinh_hoc_taps','qua_trinh_hoc_taps.ma_sv','thanh_toan_hoc_phis.ma_sv')
                               ->leftJoin('sinh_viens','qua_trinh_hoc_taps.ma_sv','sinh_viens.ma_sv')
                               ->leftJoin('lop_hocs','qua_trinh_hoc_taps.id_lop_hoc','lop_hocs.id')
                               ->leftJoin('hoc_phis','thanh_toan_hoc_phis.id_hoc_phi','hoc_phis.id')
                               ->leftJoin('chuyen_nganhs','chuyen_nganhs.id','hoc_phis.id_chuyen_nganh')
                               ->select('thanh_toan_hoc_phis.*','sinh_viens.ten_sinh_vien','lop_hocs.ten_lop_hoc','hoc_phis.hoc_ky','hoc_phis.so_tien','hoc_phis.khoa_hoc','chuyen_nganhs.ten_chuyen_nganh')
                               ->where('thanh_toan_hoc_phis.trang_thai',0)
                               ->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-ma-sv="'.$row->ma_sv.'" data-id-lop-hoc="'.$row->id_lop_hoc.'" data-id-hoc-phi="'.$row->id_hoc_phi.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Xem</a>';

                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Xóa</a>';

                        return $btn;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id_hinh_thuc_thanh_toan==1){
            $searchPayment=PaypalPayment::where('payment_id',$request->payment_id)->first();
            if($searchPayment==null){

                $paypalPayment=PaypalPayment::create($request->all());
                ThanhToanHocPhi::create([
                    'id_hoc_phi'=>$request->id_hoc_phi,
                    'id_hinh_thuc_thanh_toan'=>$request->id_hinh_thuc_thanh_toan,
                    'paypal_payment_id'=>$paypalPayment->id,
                    'ma_sv'=>$request->ma_sv,
                ]);
            }
            else
                return response()->json([
                    'message'=>"Thông tin giao dịch đã tồn tại, Vui lòng nhập thông tin giao dịch khác",
                    'status'=>2
                ]);
        }
        if($request->id_hinh_thuc_thanh_toan==2){
            $searchPayment=VnpayPayment::where('vnp_TxnRef',$request->vnp_TxnRef)->where('vnp_PayDate',$request->vnp_PayDate)->first();
            if($searchPayment==null){
                $vnpayPayment=VnpayPayment::create($request->all());
                ThanhToanHocPhi::create([
                    'id_hoc_phi'=>$request->id_hoc_phi,
                    'id_hinh_thuc_thanh_toan'=>$request->id_hinh_thuc_thanh_toan,
                    'vnpay_payment_id'=>$vnpayPayment->id,
                    'ma_sv'=>$request->ma_sv,
                ]);
            }
            else
                return response()->json([
                    'message'=>"Thông tin giao dịch đã tồn tại, Vui lòng nhập thông tin giao dịch khác",
                    'status'=>2
                ]);
        }
        return response()->json(['success' => 'Lưu Thành Công.','status'=>1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thanhtoanhocphi = ThanhToanHocPhi::find($id);
        $data=array();
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
            $data=PaypalPayment::where('id',$thanhtoanhocphi->paypal_payment_id)->where('trang_thai',1)->first();
        }
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==2){
            $data=VnpayPayment::where('id',$thanhtoanhocphi->vnpay_payment_id)->where('trang_thai',1)->first();
        }
        return response()->json([
            'id'=>$thanhtoanhocphi->id,
            'id_hoc_phi'=>$thanhtoanhocphi->id_hoc_phi,
            'ma_sv'=>$thanhtoanhocphi->ma_sv,
            'id_hinh_thuc_thanh_toan'=>$thanhtoanhocphi->id_hinh_thuc_thanh_toan,
            'thong_tin_giao_dich'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ThanhToanHocPhi::where('id', $id)->update(['trang_thai' => 0]);
        $thanhtoanhocphi=ThanhToanHocPhi::where('id',$id)->first();
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
            PaypalPayment::where('id',$thanhtoanhocphi->paypal_payment_id)->update(['trang_thai'=>0]);
        }
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==2){
            VnpayPayment::where('id',$thanhtoanhocphi->vnpay_payment_id)->update(['trang_thai'=>0]);
        }
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function huyDongHocPhi(Request $request){
        $thanhtoanhocphi=ThanhToanHocPhi::where('id_hoc_phi',$request->id_hoc_phi)->where('ma_sv',$request->ma_sv)->where('trang_thai',1)->first();
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
            PaypalPayment::find($thanhtoanhocphi->paypal_payment_id)->update(['trang_thai'=>0]);
        }else{
            VnpayPayment::find($thanhtoanhocphi->vnpay_payment_id)->update(['trang_thai'=>0]);
        }
        $thanhtoanhocphi->update(['trang_thai'=>0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        ThanhToanHocPhi::where('id', $id)->update(['trang_thai' => 1]);
        $thanhtoanhocphi=ThanhToanHocPhi::where('id',$id)->first();
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
            PaypalPayment::where('id',$thanhtoanhocphi->paypal_payment_id)->update(['trang_thai'=>1]);
        }
        if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==2){
            VnpayPayment::where('id',$thanhtoanhocphi->vnpay_payment_id)->update(['trang_thai'=>1]);
        }
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
    public function getVNPayPaymentDetail(Request $request){
        // $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        // $orderId = $inputData['vnp_TxnRef'];
        $vnp_RequestId = rand(1,10000); // Mã truy vấn
        $vnp_Command = "querydr"; // Mã api
        $vnp_TxnRef = $request->vnp_TxnRef; // Mã tham chiếu của giao dịch
        $vnp_OrderInfo = "Query transaction"; // Mô tả thông tin
        //$vnp_TransactionNo= ; // Tuỳ chọn, Mã giao dịch thanh toán của CTT VNPAY
        $vnp_TransactionDate = $request->vnp_PayDate; // Thời gian ghi nhận giao dịch
        $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
        $vnp_IpAddr = $request->ip(); // Địa chỉ IP của máy chủ thực hiện gọi API


        $datarq = array(
            "vnp_RequestId" => $vnp_RequestId,
            "vnp_Version" => "2.1.0",
            "vnp_Command" => $vnp_Command,
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            //$vnp_TransactionNo= ;
            "vnp_TransactionDate" => $vnp_TransactionDate,
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_IpAddr" => $vnp_IpAddr
        );

        $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';

        $dataHash = sprintf(
            $format,
            $datarq['vnp_RequestId'], //1
            $datarq['vnp_Version'], //2
            $datarq['vnp_Command'], //3
            $datarq['vnp_TmnCode'], //4
            $datarq['vnp_TxnRef'], //5
            $datarq['vnp_TransactionDate'], //6
            $datarq['vnp_CreateDate'], //7
            $datarq['vnp_IpAddr'], //8
            $datarq['vnp_OrderInfo']//9
        );
        //dd($dataHash);
        $checksum = hash_hmac('SHA512', $dataHash, env('VNP_HASHSECRET'));
        //dd($checksum);
        $datarq["vnp_SecureHash"] = $checksum;
        $txnData = $this->callAPI_auth("POST", env('API_URL'), json_encode($datarq));
        $ispTxn = json_decode($txnData, true);
        return response()->json($ispTxn);
    }
    public function getAccessToKenPayPal(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_USERPWD => env('PAYPAL_SANDBOX_CLIENT_ID').":".env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Language: en_US"
        ),
        ));

        $result= curl_exec($curl);

        $array=json_decode($result, true);
        $token=$array['access_token'];
        return $token;

    }

    public function getPaypalOrderDetail(Request $request){
        $accessToken=$this->getAccessToKenPayPal();
        $url="https://api-m.sandbox.paypal.com/v2/checkout/orders/".$request->Paypal_paymentID;
        //dd($accessToken);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $accessToken"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);
        //dd($result);
        //close connection
        $array=json_decode($result, true);
        curl_close($ch);
        return $array;
    }
    function callAPI_auth($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
    public function lopThuocChuyenNganh($id_chuyen_nganh){
        return LopHoc::where('id_chuyen_nganh',$id_chuyen_nganh)->where('trang_thai',1)->get();
    }
    public function sinhVienDongHocPhiTheoLopHoc($id_lop_hoc,$hoc_ky,$khoa_hoc){
        $sinhviens= SinhVien::where('id_lop_hoc',$id_lop_hoc)->where('trang_thai',1)->orderBy('ma_sv','asc')->get();

        $data=array();
        foreach ($sinhviens as $sinhvien) {
            $sinhvien=SinhVien::where('ma_sv',$sinhvien->ma_sv)->where('trang_thai',1)->first();
            $thanhtoanhocphi=ThanhToanHocPhi::leftJoin('hoc_phis','hoc_phis.id','thanh_toan_hoc_phis.id_hoc_phi')
            ->where('hoc_phis.hoc_ky',$hoc_ky)
            ->where('hoc_phis.khoa_hoc',$khoa_hoc)
            ->where('ma_sv',$sinhvien->ma_sv)->where('thanh_toan_hoc_phis.trang_thai',1)->first();
            if($thanhtoanhocphi!=null){
                $dataPayment=array();
                if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
                    $dataPayment=array(
                        'hinh_thuc_thanh_toan'=>HinhThucThanhToan::find($thanhtoanhocphi->id_hinh_thuc_thanh_toan),
                        'thong_tin_thanh_toan'=>PaypalPayment::find($thanhtoanhocphi->paypal_payment_id),
                    );
                }
                else{
                    $dataPayment=array(
                        'hinh_thuc_thanh_toan'=>HinhThucThanhToan::find($thanhtoanhocphi->id_hinh_thuc_thanh_toan),
                        'thong_tin_thanh_toan'=>VnpayPayment::find($thanhtoanhocphi->vnpay_payment_id),
                    );
                }
                $data[]=array(
                    'sinh_vien'=>$sinhvien,
                    'da_dong_hoc_phi'=>1,
                    'thong_tin_thanh_toan'=>$dataPayment,
                );
            }else{
                $data[]=array(
                    'sinh_vien'=>$sinhvien,
                    'da_dong_hoc_phi'=>0,
                );
            }
        }
        return $data;
    }
    public function danhSachSinhVienDongHocPhiTheoHocKy($hoc_ky,$khoa_hoc){

        $sinhviens=SinhVien::where('trang_thai',1)->orderBy('ma_sv','asc')->get();
        $data=array();
        foreach ($sinhviens as $sinhvien) {
            $thanhtoanhocphi=ThanhToanHocPhi::leftJoin('hoc_phis','hoc_phis.id','thanh_toan_hoc_phis.id_hoc_phi')
                                            ->where('hoc_phis.hoc_ky',$hoc_ky)
                                            ->where('hoc_phis.khoa_hoc',$khoa_hoc)
                                            ->where('thanh_toan_hoc_phis.ma_sv',$sinhvien->ma_sv)
                                            ->where('thanh_toan_hoc_phis.trang_thai',1)
                                            ->select('thanh_toan_hoc_phis.*')
                                            ->first();
            if($thanhtoanhocphi!=null){
                $dataPayment=array();
                if($thanhtoanhocphi->id_hinh_thuc_thanh_toan==1){
                    $dataPayment=array(
                        'hinh_thuc_thanh_toan'=>HinhThucThanhToan::find($thanhtoanhocphi->id_hinh_thuc_thanh_toan),
                        'thong_tin_thanh_toan'=>PaypalPayment::find($thanhtoanhocphi->paypal_payment_id),
                    );
                }
                else{
                    $dataPayment=array(
                        'hinh_thuc_thanh_toan'=>HinhThucThanhToan::find($thanhtoanhocphi->id_hinh_thuc_thanh_toan),
                        'thong_tin_thanh_toan'=>VnpayPayment::find($thanhtoanhocphi->vnpay_payment_id),
                    );
                }
                $data[]=array(
                    'sinh_vien'=>$sinhvien,
                    'da_dong_hoc_phi'=>1,
                    'thong_tin_thanh_toan'=>$dataPayment,
                );
            }else{
                $data[]=array(
                    'sinh_vien'=>$sinhvien,
                    'da_dong_hoc_phi'=>0,
                );
            }
        }
        return $data;
    }
}
