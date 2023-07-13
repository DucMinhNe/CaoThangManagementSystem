<?php
use Illuminate\Support\Facades\Auth;
use App\Models\GiangVien;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\ThongTinCaNhanController;
use App\Http\Controllers\KhoaController;


use App\Http\Controllers\LoaiMonHocController;

use App\Http\Controllers\MonHocController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\LopHocPhanController;
use App\Http\Controllers\CTLopHocPhanController;
use App\Http\Controllers\BoMonController;
use App\Http\Controllers\ChuyenNganhController;

use App\Http\Controllers\ChuongTrinhDaoTaoController;
use App\Http\Controllers\CTChuongTrinhDaoTaoController;

use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\ChucVuGiangVienController;
use App\Http\Controllers\DanhSachChucVuGiangVienController;


use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\ChucVuSinhVienController;
use App\Http\Controllers\DanhSachChucVuSinhVienController;
use App\Http\Controllers\QuyetDinhController;
use App\Http\Controllers\CTQuyetDinhController;


use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\PhongController;

use App\Http\Controllers\NhapDiemController;


use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\DangKyLopHocPhanController;
use App\Http\Controllers\ThoiKhoaBieuController;
use App\Http\Controllers\ThoiGianBieuController;
use App\Http\Controllers\MoDangKyMonController;
use App\Http\Controllers\HocPhiController;
use App\Http\Controllers\ThanhToanHocPhiController;
use App\Http\Controllers\ThanhToanDangKyLopHocPhan;
use App\Http\Controllers\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// $user = Auth::user();
// dd($user);
Route::get('khongcoquyen', function () {
    // Auth::logout();
    return view('errors.403');
})->name('khongcoquyen');


Route::get('/admin/dangnhap', [DangNhapController::class,'dangNhap'])->name('login');
Route::post('/admin/dangnhap', [DangNhapController::class,'kiemTraDangNhap']);
Route::get('/admin/dangxuat', [DangNhapController::class,'dangXuat']);
Route::get('/', function () {return redirect('/admin');})->middleware('auth');
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('admin.index');
    });
    Route::group(['middleware' => 'checkchucvu:1|2'], function () {

        Route::get('/diem-trung-binh-hoc-ky-by-lop-xet-tot-nghiep/{id_lop_hoc}', [SinhVienController::class, 'getDiemTrungBinhHocKyByLop_xettotnghiep']);
        Route::get('/diem-trung-binh-hoc-ky-by-lop/{id_lop_hoc}', [SinhVienController::class, 'getDiemTrungBinhHocKyByLop']);
        Route::get('/diem-trung-binh-hoc-ky', [SinhVienController::class, 'getDiemTrungBinhHocKy']);

        Route::get('/khoa/getInactiveData', [KhoaController::class, 'getInactiveData'])->name('khoa.getInactiveData');
        Route::get('/khoa/restore/{id}', [KhoaController::class, 'restore'])->name('khoa.restore');
        Route::resource('khoa', KhoaController::class);

        Route::get('/loaimonhoc/getInactiveData', [LoaiMonHocController::class, 'getInactiveData'])->name('loaimonhoc.getInactiveData');
        Route::get('/loaimonhoc/restore/{id}', [LoaiMonHocController::class, 'restore'])->name('loaimonhoc.restore');
        Route::resource('loaimonhoc', LoaiMonHocController::class);

        Route::get('/monhoc/getInactiveData', [MonHocController::class, 'getInactiveData'])->name('monhoc.getInactiveData');
        Route::get('/monhoc/restore/{id}', [MonHocController::class, 'restore'])->name('monhoc.restore');

        Route::resource('monhoc', MonHocController::class);

        Route::get('/bomon/getInactiveData', [BoMonController::class, 'getInactiveData'])->name('bomon.getInactiveData');
        Route::get('/bomon/restore/{id}', [BoMonController::class, 'restore'])->name('bomon.restore');
        Route::resource('bomon', BoMonController::class);

        Route::get('/lophoc/getInactiveData', [LopHocController::class, 'getInactiveData'])->name('lophoc.getInactiveData');
        Route::get('/lophoc/restore/{id}', [LopHocController::class, 'restore'])->name('lophoc.restore');
        Route::resource('lophoc', LopHocController::class);

        Route::get('/lophocphan/saochep/{idLopHoc}/{idLopHocPhan}', [LopHocPhanController::class, 'themSinhVienVaoLopHocPhan']);
        Route::get('/lophocphan/getInactiveData', [LopHocPhanController::class, 'getInactiveData'])->name('lophocphan.getInactiveData');
        Route::get('/lophocphan/restore/{id}', [LopHocPhanController::class, 'restore'])->name('lophocphan.restore');
        Route::resource('lophocphan', LopHocPhanController::class);

        Route::get('/ctlophocphan/getInactiveData', [CTLopHocPhanController::class, 'getInactiveData'])->name('ctlophocphan.getInactiveData');
        Route::get('/ctlophocphan/restore/{id}', [CTLopHocPhanController::class, 'restore'])->name('ctlophocphan.restore');
        Route::resource('ctlophocphan', CTLopHocPhanController::class);

        Route::get('/loaiphong/getInactiveData', [LoaiPhongController::class, 'getInactiveData'])->name('loaiphong.getInactiveData');
        Route::get('/loaiphong/restore/{id}', [LoaiPhongController::class, 'restore'])->name('loaiphong.restore');
        Route::resource('loaiphong', LoaiPhongController::class);

        Route::get('/phong/getInactiveData', [PhongController::class, 'getInactiveData'])->name('phong.getInactiveData');
        Route::get('/phong/restore/{id}', [PhongController::class, 'restore'])->name('phong.restore');
        Route::resource('phong', PhongController::class);

        Route::get('/chuyennganh/getInactiveData', [ChuyenNganhController::class, 'getInactiveData'])->name('chuyennganh.getInactiveData');
        Route::get('/chuyennganh/restore/{id}', [ChuyenNganhController::class, 'restore'])->name('chuyennganh.restore');
        Route::resource('chuyennganh', ChuyenNganhController::class);

        Route::get('/quyetdinh/getInactiveData', [QuyetDinhController::class, 'getInactiveData'])->name('quyetdinh.getInactiveData');
        Route::get('/quyetdinh/restore/{id}', [QuyetDinhController::class, 'restore'])->name('quyetdinh.restore');
        Route::resource('quyetdinh', QuyetDinhController::class);

        Route::get('/ctquyetdinh/getInactiveData', [CTQuyetDinhController::class, 'getInactiveData'])->name('ctquyetdinh.getInactiveData');
        Route::get('/ctquyetdinh/restore/{id}', [CTQuyetDinhController::class, 'restore'])->name('ctquyetdinh.restore');
        Route::resource('ctquyetdinh', CTQuyetDinhController::class);


        Route::get('/chuongtrinhdaotao/saochep/{idChuongTrinhDaoTao1}/{idChuongTrinhDaoTao2}', [ChuongTrinhDaoTaoController::class, 'saoChepChiTiet']);
        Route::get('/chuongtrinhdaotao/getInactiveData', [ChuongTrinhDaoTaoController::class, 'getInactiveData'])->name('chuongtrinhdaotao.getInactiveData');
        Route::get('/chuongtrinhdaotao/restore/{id}', [ChuongTrinhDaoTaoController::class, 'restore'])->name('chuongtrinhdaotao.restore');
        Route::resource('chuongtrinhdaotao', ChuongTrinhDaoTaoController::class);

        Route::get('/ctchuongtrinhdaotao/getInactiveData', [CTChuongTrinhDaoTaoController::class, 'getInactiveData'])->name('ctchuongtrinhdaotao.getInactiveData');
        Route::get('/ctchuongtrinhdaotao/restore/{id}', [CTChuongTrinhDaoTaoController::class, 'restore'])->name('ctchuongtrinhdaotao.restore');
        Route::resource('ctchuongtrinhdaotao', CTChuongTrinhDaoTaoController::class);
        Route::get('/sinhvien/getLopByKhoa/{id_khoa}', [SinhVienController::class, 'getLopByKhoa'])->name('sinhvien.getLopByKhoa');
        Route::get('/sinhvien/getChuyenNganhByKhoa/{id_khoa}', [SinhVienController::class, 'getChuyenNganhByKhoa'])->name('sinhvien.getChuyenNganhByKhoa');
        Route::get('/sinhvien/getLopByChuyenNganh/{id_chuyen_nganh}', [SinhVienController::class, 'getLopByChuyenNganh'])->name('sinhvien.getLopByChuyenNganh');

        Route::get('/sinhvien/getSinhVienByIdKhoa/{id_khoa}', [SinhVienController::class, 'getSinhVienByIdKhoa'])->name('sinhvien.getSinhVienByIdKhoa');
        Route::get('/sinhvien/getSinhVienByIdChuyenNganh/{id_chuyen_nganh}', [SinhVienController::class, 'getSinhVienByIdChuyenNganh'])->name('sinhvien.getSinhVienByIdChuyenNganh');
        Route::get('/sinhvien/getSinhVienByIdLop/{id_lop_hoc}', [SinhVienController::class, 'getSinhVienByIdLop'])->name('sinhvien.getSinhVienByIdLop');

        Route::get('/sinhvien/taothesinhvien/{ma_sv}', [SinhVienController::class, 'taoTheSinhVien'])->name('sinhvien.taothesinhvien');
        Route::get('/sinhvien/taobangten/{hoten}/{lop}', [SinhVienController::class, 'taoBangTen'])->name('sinhvien.taobangten');
        Route::post('/sinhvien/import', [SinhVienController::class, 'import'])->name('sinhvien.import');
        Route::get('/sinhvien/getInactiveData', [SinhVienController::class, 'getInactiveData'])->name('sinhvien.getInactiveData');
        Route::get('/sinhvien/restore/{id}', [SinhVienController::class, 'restore'])->name('sinhvien.restore');
        Route::resource('sinhvien', SinhVienController::class);

        Route::get('/chucvusinhvien/getInactiveData', [ChucVuSinhVienController::class, 'getInactiveData'])->name('chucvusinhvien.getInactiveData');
        Route::get('/chucvusinhvien/restore/{id}', [ChucVuSinhVienController::class, 'restore'])->name('chucvusinhvien.restore');
        Route::resource('chucvusinhvien', ChucVuSinhVienController::class);

        Route::get('/danhsachchucvusinhvien/getInactiveData', [DanhSachChucVuSinhVienController::class, 'getInactiveData'])->name('danhsachchucvusinhvien.getInactiveData');
        Route::get('/danhsachchucvusinhvien/restore/{id}', [DanhSachChucVuSinhVienController::class, 'restore'])->name('danhsachchucvusinhvien.restore');
        Route::resource('danhsachchucvusinhvien', DanhSachChucVuSinhVienController::class);
    });
    Route::group(['middleware' => 'checkchucvu:1'], function () {
        Route::get('/giangvien/getBoMonByKhoa/{id_khoa}', [GiangVienController::class, 'getBoMonByKhoa'])->name('giangvien.getBoMonByKhoa');
        Route::get('/giangvien/getGiangVienByIdKhoa/{id_khoa}', [GiangVienController::class, 'getGiangVienByIdKhoa'])->name('giangvien.getGiangVienByIdKhoa');
        Route::get('/giangvien/getGiangVienByIdBoMon/{id_bo_mon}', [GiangVienController::class, 'getGiangVienByIdBoMon'])->name('giangvien.getGiangVienByIdBoMon');
        Route::get('/giangvien/getInactiveData', [GiangVienController::class, 'getInactiveData'])->name('giangvien.getInactiveData');
        Route::get('/giangvien/restore/{id}', [GiangVienController::class, 'restore'])->name('giangvien.restore');
        Route::resource('giangvien', GiangVienController::class);

        Route::get('/chucvugiangvien/getInactiveData', [ChucVuGiangVienController::class, 'getInactiveData'])->name('chucvugiangvien.getInactiveData');
        Route::get('/chucvugiangvien/restore/{id}', [ChucVuGiangVienController::class, 'restore'])->name('chucvugiangvien.restore');
        Route::resource('chucvugiangvien', ChucVuGiangVienController::class);

        Route::get('/danhsachchucvugiangvien/getInactiveData', [DanhSachChucVuGiangVienController::class, 'getInactiveData'])->name('danhsachchucvugiangvien.getInactiveData');
        Route::get('/danhsachchucvugiangvien/restore/{id}', [DanhSachChucVuGiangVienController::class, 'restore'])->name('danhsachchucvugiangvien.restore');
        Route::resource('danhsachchucvugiangvien', DanhSachChucVuGiangVienController::class);


        Route::get('/thongbao/danhsachsinhvienlophoc',[ThongBaoController::class,'danhsachsinhvienlophoc']);
        Route::post('/thongbao/xu-ly-dang-thong-bao',[ThongBaoController::class,'xulydangthongbao'])->name('xu-ly-dang-thong-bao');
        Route::post('/thongbao/xu-ly-sua-thong-bao',[ThongBaoController::class,'xulysuaThongBao'])->name('xu-ly-sua-thong-bao');
        // Route::post('/thongbao/xoa-thong-bao/{id}',[ThongBaoController::class,'xoathongbao'])->name('xoa-thong-bao');
        Route::get('/thongbao/getInactiveData', [ThongBaoController::class, 'getInactiveData'])->name('thongbao.getInactiveData');
        Route::get('/thongbao/restore/{id}', [ThongBaoController::class, 'restore'])->name('thongbao.restore');
        Route::resource('thongbao', ThongBaoController::class);


        Route::get('/dangkylophocphan/getInactiveData',[DangKyLopHocPhanController::class,'getInactiveData'])->name('dangkylophocphan.getInactiveData');


        Route::get('/dangkylophocphan/restore/{id}', [DanhSachChucVuSinhVienController::class, 'restore'])->name('dangkylophocphan.restore');
        Route::get('/dangkylophocphan/review/{id}', [DangKyLopHocPhanController::class, 'review'])->name('dangkylophocphan.review');

        Route::resource('dangkylophocphan',DangKyLopHocPhanController::class);

        Route::get('/thoikhoabieu/getInactiveData', [ThoiKhoaBieuController::class, 'getInactiveData'])->name('thoikhoabieu.getInactiveData');
        Route::get('/thoikhoabieu/restore/{id}', [ThoiKhoaBieuController::class, 'restore'])->name('thoikhoabieu.restore');
        Route::resource('thoikhoabieu',ThoiKhoaBieuController::class);

        Route::get('/thoigianbieu/getInactiveData', [ThoiGianBieuController::class, 'getInactiveData'])->name('thoigianbieu.getInactiveData');
        Route::get('/thoigianbieu/restore/{id}', [ThoiGianBieuController::class, 'restore'])->name('thoigianbieu.restore');
        Route::resource('thoigianbieu',ThoiGianBieuController::class);

        Route::get('/modangkymon/getInactiveData', [MoDangKyMonController::class, 'getInactiveData'])->name('modangkymon.getInactiveData');
        Route::get('/modangkymon/restore/{id}', [MoDangKyMonController::class, 'restore'])->name('modangkymon.restore');
        Route::post('/modangkymon/close/{id}', [MoDangKyMonController::class, 'close'])->name('modangkymon.close');
        Route::post('/modangkymon/modangky',[MoDangKyMonController::class,'moDangKyMon'])->name('modangkymon.modangky');
        Route::get('/modangkymon/danhsachmonhocmodangky',[MoDangKyMonController::class,'danhSachMonHocMoDangKyMon'])->name('modangkymon.danhsachmonhocmodangky');
        Route::resource('modangkymon',MoDangKyMonController::class);

        Route::get('/hocphi/getInactiveData', [HocPhiController::class, 'getInactiveData'])->name('hocphi.getInactiveData');
        Route::get('/hocphi/restore/{id}', [HocPhiController::class, 'restore'])->name('hocphi.restore');
        Route::resource('hocphi',HocPhiController::class);

        Route::get('/thanhtoanhocphi/getInactiveData', [ThanhToanHocPhiController::class, 'getInactiveData'])->name('thanhtoanhocphi.getInactiveData');
        Route::get('/thanhtoanhocphi/restore/{id}', [ThanhToanHocPhiController::class, 'restore'])->name('thanhtoanhocphi.restore');
        Route::post('/thanhtoanhocphi/huy',[ThanhToanHocPhiController::class,'huyDongHocPhi'])->name('thanhtoanhocphi.huydonghocphi');
        Route::resource('thanhtoanhocphi',ThanhToanHocPhiController::class);

        // Route::get('/activitylog/getInactiveData', [ActivityLogController::class, 'getInactiveData'])->name('activitylog.getInactiveData');
        Route::resource('activitylog',ActivityLogController::class);
    });

    Route::resource('thongtincanhan', ThongTinCaNhanController::class);


    Route::get('/get-thong-tin-lop-hoc-phan', [NhapDiemController::class, 'getThongTinLopHocPhan']);
    Route::resource('nhapdiem', NhapDiemController::class);
    Route::get('/lay-sinhvien-theo-lophoc', [SinhVienController::class, 'laySinhVienTheoLopHoc'])->name('lay-sinhvien-theo-lophoc');
    Route::get('/lay-tong-sinh-vien', [SinhVienController::class, 'layTongSinhVien'])->name('lay-tong-sinh-vien');
    Route::get('/lay-tong-giang-vien', [GiangVienController::class, 'layTongGiangVien'])->name('lay-tong-giang-vien');
    Route::get('/lay-tong-khoa', [KhoaController::class, 'layTongKhoa'])->name('lay-tong-khoa');
    Route::get('/lay-tong-chuyen-nganh', [ChuyenNganhController::class, 'layTongChuyenNganh'])->name('lay-tong-chuyen-nganh');
});
Route::get('/lay-thong-tin-quan-tri-vien', [GiangVienController::class, 'layThongTinQuanTriVien'])->name('lay-thong-tin-quan-tri-vien');
