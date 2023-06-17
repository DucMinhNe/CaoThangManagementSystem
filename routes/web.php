<?php

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

Route::get('/admin/dangnhap', [DangNhapController::class,'dangNhap'])->name('login');
Route::post('/admin/dangnhap', [DangNhapController::class,'kiemTraDangNhap']);
Route::get('/admin/dangxuat', [DangNhapController::class,'dangXuat']);
Route::get('/', function () {return redirect('/admin');})->middleware('auth');
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('thongtincanhan', ThongTinCaNhanController::class);

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

    Route::get('/giangvien/getInactiveData', [GiangVienController::class, 'getInactiveData'])->name('giangvien.getInactiveData');
    Route::get('/giangvien/restore/{id}', [GiangVienController::class, 'restore'])->name('giangvien.restore');
    Route::resource('giangvien', GiangVienController::class);

    Route::get('/danhsachchucvugiangvien/getInactiveData', [DanhSachChucVuGiangVienController::class, 'getInactiveData'])->name('danhsachchucvugiangvien.getInactiveData');
    Route::get('/danhsachchucvugiangvien/restore/{id}', [DanhSachChucVuGiangVienController::class, 'restore'])->name('danhsachchucvugiangvien.restore');
    Route::resource('danhsachchucvugiangvien', DanhSachChucVuGiangVienController::class);

    Route::get('/chuyennganh/getInactiveData', [ChuyenNganhController::class, 'getInactiveData'])->name('chuyennganh.getInactiveData');
    Route::get('/chuyennganh/restore/{id}', [ChuyenNganhController::class, 'restore'])->name('chuyennganh.restore');
    Route::resource('chuyennganh', ChuyenNganhController::class);

    Route::get('/quyetdinh/getInactiveData', [QuyetDinhController::class, 'getInactiveData'])->name('quyetdinh.getInactiveData');
    Route::get('/quyetdinh/restore/{id}', [QuyetDinhController::class, 'restore'])->name('quyetdinh.restore');
    Route::resource('quyetdinh', QuyetDinhController::class);

    Route::get('/ctquyetdinh/getInactiveData', [CTQuyetDinhController::class, 'getInactiveData'])->name('ctquyetdinh.getInactiveData');
    Route::get('/ctquyetdinh/restore/{id}', [CTQuyetDinhController::class, 'restore'])->name('ctquyetdinh.restore');
    Route::resource('ctquyetdinh', CTQuyetDinhController::class);


    Route::get('/chuongtrinhdaotao/getInactiveData', [ChuongTrinhDaoTaoController::class, 'getInactiveData'])->name('chuongtrinhdaotao.getInactiveData');
    Route::get('/chuongtrinhdaotao/restore/{id}', [ChuongTrinhDaoTaoController::class, 'restore'])->name('chuongtrinhdaotao.restore');
    Route::resource('chuongtrinhdaotao', ChuongTrinhDaoTaoController::class);

    Route::get('/ctchuongtrinhdaotao/getInactiveData', [CTChuongTrinhDaoTaoController::class, 'getInactiveData'])->name('ctchuongtrinhdaotao.getInactiveData');
    Route::get('/ctchuongtrinhdaotao/restore/{id}', [CTChuongTrinhDaoTaoController::class, 'restore'])->name('ctchuongtrinhdaotao.restore');
    Route::resource('ctchuongtrinhdaotao', CTChuongTrinhDaoTaoController::class);

    Route::get('/chucvugiangvien/getInactiveData', [ChucVuGiangVienController::class, 'getInactiveData'])->name('chucvugiangvien.getInactiveData');
    Route::get('/chucvugiangvien/restore/{id}', [ChucVuGiangVienController::class, 'restore'])->name('chucvugiangvien.restore');
    Route::resource('chucvugiangvien', ChucVuGiangVienController::class);

    Route::get('/sinhvien/getInactiveData', [SinhVienController::class, 'getInactiveData'])->name('sinhvien.getInactiveData');
    Route::get('/sinhvien/restore/{id}', [SinhVienController::class, 'restore'])->name('sinhvien.restore');
    Route::resource('sinhvien', SinhVienController::class);

    Route::get('/chucvusinhvien/getInactiveData', [ChucVuSinhVienController::class, 'getInactiveData'])->name('chucvusinhvien.getInactiveData');
    Route::get('/chucvusinhvien/restore/{id}', [ChucVuSinhVienController::class, 'restore'])->name('chucvusinhvien.restore');
    Route::resource('chucvusinhvien', ChucVuSinhVienController::class);

    Route::get('/danhsachchucvusinhvien/getInactiveData', [DanhSachChucVuSinhVienController::class, 'getInactiveData'])->name('danhsachchucvusinhvien.getInactiveData');
    Route::get('/danhsachchucvusinhvien/restore/{id}', [DanhSachChucVuSinhVienController::class, 'restore'])->name('danhsachchucvusinhvien.restore');
    Route::resource('danhsachchucvusinhvien', DanhSachChucVuSinhVienController::class);

 
    Route::get('/lay-sinhvien-theo-lophoc', [SinhVienController::class, 'laySinhVienTheoLopHoc'])->name('lay-sinhvien-theo-lophoc');

});

// use App\Http\Controllers\TaiKhoanGiangVienController;
// Route::get('/taikhoangiangvien/getInactiveData', [TaiKhoanGiangVienController::class, 'getInactiveData'])->name('taikhoangiangvien.getInactiveData');
// Route::get('/taikhoangiangvien/restore/{id}', [TaiKhoanGiangVienController::class, 'restore'])->name('taikhoangiangvien.restore');
// Route::resource('taikhoangiangvien', TaiKhoanGiangVienController::class);