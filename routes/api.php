<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DangKyLopHocPhanController;
use App\Http\Controllers\ThanhToanHocPhiController;
use App\Http\Controllers\ThoiKhoaBieuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\APISinhVienController;
use App\Http\Controllers\api\APIThoiKhoaBieuController;
use App\Http\Controllers\api\APIPhongHocController;
use App\Http\Controllers\api\APILopHocController;
use App\Http\Controllers\api\APIThoiGianBieuController;
use App\Http\Controllers\api\APILopHocPhanController;
use App\Http\Controllers\api\APIMonHocController;
use App\Http\Controllers\api\APIGiangVienController;
use App\Http\Controllers\api\APIThongBaoController;
use App\Http\Controllers\api\APIMoDangKyMonController;
use App\Http\Controllers\api\APIDangKyLopHocPhanController;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\api\APIHocPhiController;
use App\Http\Controllers\api\APIChiTietLopHocPhanController;
use App\Http\Controllers\api\APIQuaTrinhHocTapController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hash',[APIAuthController::class,'getPasswordHash']);


Route::post('/login-sinh-vien',[APIAuthController::class,'loginSinhVien']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('/logout',[APIAuthController::class,'logoutSinhVien']);
    Route::get('/check-login',[APIAuthController::class,'checkLogin']);

    Route::get('/thoi-khoa-bieu',[APIThoiKhoaBieuController::class,'index']);
    Route::get('/phong-hoc/{id}',[APIPhongHocController::class,'show']);
    Route::get('/thoi-gian-bieu/{id}',[APIThoiGianBieuController::class,'show']);

    Route::get('/mon-hoc/{id}',[APIMonHocController::class,'show']);
    Route::get('/lop-hoc-phan/{id}',[APILopHocPhanController::class,'show']);
    Route::get('/thoi-khoa-bieu/{id}',[APIThoiKhoaBieuController::class,'getLichHoc']);
    Route::get('/danh-sach-thong-bao/{id}',[APIThongBaoController::class,'layDanhSachThongBaoCuaSinhVien']);
    Route::get('/danh-sach-diem-cua-sinh-vien/{ma_sv}',[APISinhVienController::class,'layBangDiemCuaSinhVien']);
    Route::get('/danh-sach-diem-cua-sinh-vien/{ma_sv}/hoc-ky/{hocky}',[APISinhVienController::class,'layBangDiemCuaSinhVienTheoHocKy']);


    Route::get('/sinh-vien-duoc-phep-vao-trang-dang-ky-mon',[APIMoDangKyMonController::class,'choPhepTruyCapDangKyMonHoc']);

    Route::get('/danh-sach-dang-ky-mon-cua-sinh-vien/{ma_sv}',[APIMoDangKyMonController::class,'hienThiDanhSachDangKyMonHocCuaSinhVien']);


    Route::get('/danh-sach-dong-hoc-phi-cua-sinh-vien/{ma_sv}',[APIHocPhiController::class,'danhSachHocPhi']);
    Route::get('/danh-sach-lop-dang-ky/{ma_sv}',[APIDangKyLopHocPhanController::class,'layDanhSachLopDangKyCuaSinhVien']);
    Route::get('/mo-dang-ky-mon',[APIMoDangKyMonController::class,'choPhepMoDangKyMon']);
    Route::post('/them-dang-ky-lop-hoc-phan',[APIDangKyLopHocPhanController::class,'themDangKyLopHocPhan']);

    Route::post('/huy-dang-ky-lop-hoc-phan',[APIDangKyLopHocPhanController::class,'huyDangKyLopHocPhan']);
    Route::get('/kiem-tra-mon-hoc-cua-lop-hoc-phan-dang-ky',[APIDangKyLopHocPhanController::class,'kiemTraLopHocPhanCoMonDangKy']);
    Route::post('/cap-nhat-trang-thai-da-doc-cua-thong-bao/{id}',[APIThongBaoController::class,'capNhatTrangThaiThongBao']);
    Route::get('/thoi-khoa-bieu-cua-sinh-vien-dang-ky-lop-hoc-phan/{ma_sv}',[APIThoiKhoaBieuController::class,'danhSachLichHocCuaSinhVienDangKyHocPhan']);

    Route::get('/hoc-ky-hien-tai-cua-sinh-vien/{ma_sv}',[APIThoiKhoaBieuController::class,'layHocKyHienTaiCuaSinhVien']);
    Route::get('/danh-sach-lop-dang-ky/{ma_sv}',[APIDangKyLopHocPhanController::class,'layDanhSachLopDangKyCuaSinhVien']);
    Route::get('/danh-sach-lop-hoc-phan-theo-mon-con-mo/{id}',[APILopHocPhanController::class,'danhSachLopHocPhanConMoThuocMonHoc']);
    Route::get('/hoc-phi/thong-tin-hoc-phi/{id}',[APIHocPhiController::class,'thongTinHocPhi']);
    Route::post('/sinh-vien/doi-mat-khau/{ma_sv}',[APISinhVienController::class,'doiMatKhau']);
}); Route::get('/thoi-khoa-bieu-cua-sinh-vien/{ma_sv}',[APIThoiKhoaBieuController::class,'danhSachLichHocCuaSinhVienTheoChuongTrinh']);
Route::get('/test-array',function(Request $request){
    dd($request);
    $data=$request->getContent();
    $data=json_decode($data);
    dd($data);
});



Route::get('giang-vien/danh-sach-lop-hoc-phan/{ma_gv}',[APILopHocPhanController::class,'layDanhSachLopHocPhanTheoGiangVien']);
Route::get('giang-vien/danh-sach-lop-hoc-phan-da-hoan-thanh/{ma_gv}',[APILopHocPhanController::class,'layDanhSachLopHocPhanDaHoanThanhTheoGiangVien']);
Route::get('/sinh-vien/{ma_sv}',[APISinhVienController::class,'show']);
Route::post('/xu-ly-dong-hoc-phi-paypal',[APIHocPhiController::class,'xuLyDongHocPhiPaypal']);
Route::post('/xu-ly-dong-hoc-phi-vnpay',[APIHocPhiController::class,'xuLyDongHocPhiVNPay']);
Route::get('/qua-trinh-hoc-tap-cua-sinh-vien/{ma_sv}',[APIQuaTrinhHocTapController::class,'layQuaTrinhHocTap']);

Route::post('/login-giang-vien',[APIAuthController::class,'DangNhapGiangVien']);



Route::get('/danh-sach-sinh-vien-lhp/{id}',[APILopHocPhanController::class,'laydssinhvien_lophocphan']);
Route::get('/giang-vien/lop-hoc-phan/{id}',[APILopHocPhanController::class,'show']);
Route::get('/giang-vien/lop-hoc/{id}',[APILopHocController::class,'show']);
Route::get('giang-vien/danh-sach-lop-chu-nhiem/{ma_gv}',[APILopHocController::class,'lopChuNhiem']);
Route::group(['middleware'=>'auth:sanctum'],function(){
     Route::post('/dang-xuat-giang-vien',[APIAuthController::class,'dangXuatGiangVien'])->name('dang-xuat-gv');
     Route::get('/kiem-tra-dang-nhap-gv',[APIAuthController::class,'kiemtraDangNhap_GiangVien']);

   


     Route::get('/danh-sach-sinh-vien-chu-nhiem/{id_lop_hoc}',[APILopHocController::class,'danhsachSinhvienlopChuNhiem']);
     Route::get('giang-vien/danh-sach-lop-hoc-phan/{ma_gv}',[APILopHocPhanController::class,'layDanhSachLopHocPhanTheoGiangVien']);
     Route::get('/giang-vien/thong-bao/danh-sach-thong-bao-lop-hoc-phan',[APIThongBaoController::class,'layDanhSachThongBaoCuaLop']);
     Route::post('/giang-vien/thong-bao/them-thong-bao',[APIThongBaoController::class,'xulythemthongbao'])->name('xu-ly-them-thong-bao');

     Route::post('/giang-vien/thong-bao/xoa-thong-bao',[APIThongBaoController::class,'xoathongbao'])->name('xoa-thong-bao');

     Route::get('/giang-vien/thong-bao/lay-thong-bao/{id}',[APIThongBaoController::class,'laythongbao'])->name('lay-thong-bao');

     Route::post('/giang-vien/thong-bao/sua-thong-bao/{id}',[APIThongBaoController::class,'suathongbao'])->name('sua-thong-bao');

     Route::get('/sinh-vien/{ma_sv}',[APISinhVienController::class,'show']);

     Route::get('/giang-vien/lop-hoc-phan/bang-diem/{id}',[APIChiTietLopHocPhanController::class,'bangdiemsinhvien']);
     Route::post('/giang-vien/lop-hoc-phan/bang-diem-sinh-vien/thay-doi-diem/{id_lop_hoc_phan}',[APIChiTietLopHocPhanController::class,'thaydoidiem']);

     Route::post('/giang-vien/xu-ly-doi-mat-khau/{ma_gv}',[APIGiangVienController::class,'xulydoimatkhau']);
     Route::get('/giang-vien/{id}',[APIGiangVienController::class,'show']);

 });
 Route::get('/giang-vien/thoi-khoa-bieu/{id}',[APIThoiKhoaBieuController::class,'DanhSachLichDayGiangVien']);



Route::get('/thoikhoabieu/kiemtratrungphongtrungtiet',[ThoiKhoaBieuController::class,'kiemTraTrungPhongTrungTiet'])->name('thoikhoabieu.kiemtratrungphongtrungtiet');
Route::get('/chuyennganh/laymonhoctheokhoahocvanganh',[DangKyLopHocPhanController::class,'searchMonTheoChuyenNganh'])->name('chuyennganh.laymonhoctheokhoahocvanganh');
Route::get('/lophoc/danhsachlophocphantheomon',[DangKyLopHocPhanController::class,'danhSachLopHocPhanTheoMon'])->name('lophocphan.danhsachlophocphantheomon');
Route::get('/sinhvien/danhsachsinhvientheokhoahocvamonno',[DangKyLopHocPhanController::class,'danhSachSinhVienTheoKhoaHocTheoMonNo'])->name('sinhvien.danhsachsinhvientheokhoahocvamonno');
Route::get('/thanhtoanhocphi/getvnpaypaymentdetail',[ThanhToanHocPhiController::class,'getVNPayPaymentDetail'])->name('thanhtoanhocphi.getVNPayPaymentDetail');
Route::get('/thanhtoanhocphi/getpaypalorderdetail',[ThanhToanHocPhiController::class,'getPaypalOrderDetail'])->name('thanhtoanhocphi.getPaypalOrderDetail');
Route::get('/chuyennganh/lopthuocchuyennganh/{id_chuyen_nganh}',[ThanhToanHocPhiController::class,'lopThuocChuyenNganh'])->name('chuyennganh.lopthuocchuyennganh');
Route::get('/sinhvien/sinhvientheolophoc/{id_lop_hoc}/{hoc_ky}/{khoa_hoc}',[ThanhToanHocPhiController::class,'sinhVienDongHocPhiTheoLopHoc'])->name('sinhvien.sinhvientheolophoc');
Route::get('/hocphi/danhsachsinhviendonghocphihocky/{hoc_ky}/{khoa_hoc}',[ThanhToanHocPhiController::class,'danhSachSinhVienDongHocPhiTheoHocKy'])->name('hocphi.danhsachsinhviendonghocphihocky');
Route::get('/sinhvien/danhsachsinhvientheokhoatheonganh',[DangKyLopHocPhanController::class,'danhsachsinhvientheokhoatheonganh'])->name('danhsachsinhvientheokhoatheonganh');
