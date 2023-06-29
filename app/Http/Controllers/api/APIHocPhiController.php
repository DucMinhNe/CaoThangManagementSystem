<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\PaypalPayment;
use App\Models\VnpayPayment;
use App\Models\ThanhToanVNPay;
use App\Models\DangKyLopHocPhan;
use App\Models\MoDangKyMon;
use App\Models\HocPhi;
use App\Models\SinhVien;
use App\Models\DanhSachDaDongHocPhi;
use App\Models\ThanhToanHocPhi;
use App\Models\ThanhToanDangKyLopHocPhan;
use App\Models\ChuyenNganh;

class APIHocPhiController extends Controller
{
    function xuLyDongHocPhiPaypal(Request $request){
        $rawHash="payment_id=" . $request->payment_id . "&payer_email_address=" . $request->payer_email_address . "&payer_id=" . $request->payer_id . "&gross_amount=" . $request->gross_amount . "&paypal_fee=" . $request->paypal_fee . "&net_amount=" . $request->net_amount . "&currency_code=" . $request->currency_code . "&id_hoc_phi=" . $request->id_hoc_phi . "&ma_sv=" . $request->ma_sv . "&type=" . $request->type;
        $signature=hash_hmac("sha256",$rawHash,env('PAYPAL_LIVE_CLIENT_SECRET'));
        if($signature==$request->signature){
            $hocPhi=PaypalPayment::create($request->all());
            if($request->type=="hoc_phi_mon"){
                ThanhToanDangKyLopHocPhan::create([
                    'id_dang_ky_lop_hoc_phan'=>$request->id_hoc_phi,
                    'id_hinh_thuc_thanh_toan'=>1,
                    'ma_sv'=>$request->ma_sv,
                    'paypal_payment_id'=>$hocPhi->id,
                ]);
                $dangKyHocPhan=DangKyLopHocPhan::where('id',$request->id_hoc_phi)->where('trang_thai',1)->first();
                $dangKyHocPhan->update(['da_dong_tien'=>1]);
                $dangKyHocPhan->save();
            }else{
                ThanhToanHocPhi::create([
                    'id_hoc_phi'=>$request->id_hoc_phi,
                    'id_hinh_thuc_thanh_toan'=>1,
                    'ma_sv'=>$request->ma_sv,
                    'paypal_payment_id'=>$hocPhi->id,
                   ]);
            }

            return response()->json([
                'message'=>"Thêm đóng học phí thành công",
                "status"=>1
            ], 201, );

        }else{
            return response()->json([
                'message'=>"Lỗi",
                "status"=>0
            ], 401, );
        }
    }
    function xuLyDongHocPhiVNPay(Request $request){

        $inputData = array();
        $returnData = array();
        foreach ($request->all() as $key => $value) {
                    if (substr($key, 0, 4) == "vnp_") {
                        $inputData[$key] = $value;
                    }
                }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi
        if($secureHash==$request->vnp_SecureHash){
            $kiemTraThanhToan=VnpayPayment::where('vnp_TxnRef',$request->vnp_TxnRef)->where('vnp_PayDate',$request->vnp_PayDate)->first();
            if($kiemTraThanhToan==null){
                $hocPhi=VnpayPayment::create($request->all());
                if($request->type=="hoc_phi_mon"){
                   ThanhToanDangKyLopHocPhan::create([
                    'id_dang_ky_lop_hoc_phan'=>$request->id_hoc_phi,
                    'id_hinh_thuc_thanh_toan'=>2,
                    'ma_sv'=>$request->ma_sv,
                    'vnpay_payment_id'=>$hocPhi->id,
                   ]);
                    $dangKyHocPhan=DangKyLopHocPhan::where('id',$request->id_hoc_phi)->where('trang_thai',1)->first();
                    $dangKyHocPhan->update(['da_dong_tien'=>1]);
                    $dangKyHocPhan->save();
                }else{
                    ThanhToanHocPhi::create([
                        'id_hoc_phi'=>$request->id_hoc_phi,
                        'id_hinh_thuc_thanh_toan'=>1,
                        'ma_sv'=>$request->ma_sv,
                        'vnpay_payment_id'=>$hocPhi->id,

                       ]);
                }

                return response()->json([
                    'message'=>"Thêm đóng học phí thành công",
                    "status"=>1
                ], 201, );
            }else{
                return response()->json([
                    'message'=>"Lỗi, request không hợp lệ",
                    "status"=>3
                ], 401, );
            }

        }else{
            return response()->json([
                'message'=>"Lỗi",
                "status"=>0
            ], 401, );
        }
    }
    function danhSachHocPhi($ma_sv){
        $idChuyenNganhs=ChuyenNganh::join('lop_hocs','chuyen_nganhs.id','lop_hocs.id_chuyen_nganh')
                                ->join('qua_trinh_hoc_taps','qua_trinh_hoc_taps.id_lop_hoc','lop_hocs.id')
                                ->select('lop_hocs.id_chuyen_nganh')
                                ->where('qua_trinh_hoc_taps.ma_sv',$ma_sv)->where('qua_trinh_hoc_taps.trang_thai',1)->get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        $danhSachDangKyLopHocPhan=DangKyLopHocPhan::where('ma_sv',$ma_sv)
        ->where('da_dong_tien',0)
        ->where('trang_thai',1)

        ->get();
        //dd($danhSachDangKyLopHocPhan);
        $data=array();
        foreach($danhSachDangKyLopHocPhan as $dangKyLopHocPhan){
            $hanDongHocPhi=MoDangKyMon::where('id_mon_hoc',$dangKyLopHocPhan->lopHocPhan->ctChuongTrinhDaoTao->monHoc->id)
            ->where('mo_dang_ky','<',$currenDateTime)
            ->where('dong_dang_ky','>',$currenDateTime)
            ->first();
            if($hanDongHocPhi!=null){

                    $data[]=array(
                        'dang_ky_lop_hoc_phan'=>$dangKyLopHocPhan,
                        'mon_hoc'=>[
                            'mon_hoc'=>$dangKyLopHocPhan->lopHocPhan->ctChuongTrinhDaoTao->monHoc,
                            'loai_mon_hoc'=>$dangKyLopHocPhan->lopHocPhan->ctChuongTrinhDaoTao->monHoc->loaiMonHoc,
                        ],
                        'lop_hoc_phan'=>$dangKyLopHocPhan->lopHocPhan,
                        'ngay_mo'=>$hanDongHocPhi->mo_dang_ky,
                        'ngay_dong'=>$hanDongHocPhi->dong_dang_ky,

                    );
            }

        }
        $danhSachHocPhiHocKy=HocPhi::where('mo_dong_hoc_phi',1)->get();
        $dataHocPhiHocKy=array();
        foreach($danhSachHocPhiHocKy as $hocPhiHocKy){
            if(HocPhi::whereIn('id_chuyen_nganh',$idChuyenNganhs)->where('id',$hocPhiHocKy->id)->first()!=null){
                $payment=ThanhToanHocPhi::where('id_hoc_phi',$hocPhiHocKy->id)->where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
                if($payment==null){
                    $dataHocPhiHocKy[]=array(
                        'hoc_phi'=>$hocPhiHocKy,
                        'chuyen_nganh'=>ChuyenNganh::find($hocPhiHocKy->id_chuyen_nganh),
                    );
                }
            }

        }
        return response()->json([
            'danh_sach_hoc_phi_mon'=>$data,
            'danh_sach_hoc_phi_hoc_ky'=>$dataHocPhiHocKy
        ],201);
    }
}
