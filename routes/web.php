<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\TaiKhoanGiangVienController;
use App\Http\Controllers\ChucVuGiangVienController;
use App\Http\Controllers\DanhSachChucVuGiangVienController;
use App\Http\Controllers\LoaiMonHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\BoMonController;
use App\Http\Controllers\ChuyenNganhController;
use App\Http\Controllers\GiangVienController;

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

    Route::get('/chucvugiangvien/getInactiveData', [ChucVuGiangVienController::class, 'getInactiveData'])->name('chucvugiangvien.getInactiveData');
    Route::get('/chucvugiangvien/restore/{id}', [ChucVuGiangVienController::class, 'restore'])->name('chucvugiangvien.restore');
    Route::resource('chucvugiangvien', ChucVuGiangVienController::class);

    Route::get('/giangvien/getInactiveData', [GiangVienController::class, 'getInactiveData'])->name('giangvien.getInactiveData');
    Route::get('/giangvien/restore/{id}', [GiangVienController::class, 'restore'])->name('giangvien.restore');
    Route::resource('giangvien', GiangVienController::class);

    Route::get('/danhsachchucvugiangvien/getInactiveData', [DanhSachChucVuGiangVienController::class, 'getInactiveData'])->name('danhsachchucvugiangvien.getInactiveData');
    Route::get('/danhsachchucvugiangvien/restore/{id}', [DanhSachChucVuGiangVienController::class, 'restore'])->name('danhsachchucvugiangvien.restore');
    Route::resource('danhsachchucvugiangvien', DanhSachChucVuGiangVienController::class);

    Route::get('/taikhoangiangvien/getInactiveData', [TaiKhoanGiangVienController::class, 'getInactiveData'])->name('taikhoangiangvien.getInactiveData');
    Route::get('/taikhoangiangvien/restore/{id}', [TaiKhoanGiangVienController::class, 'restore'])->name('taikhoangiangvien.restore');
    Route::resource('taikhoangiangvien', TaiKhoanGiangVienController::class);

    Route::get('/chuyennganh/getInactiveData', [ChuyenNganhController::class, 'getInactiveData'])->name('chuyennganh.getInactiveData');
    Route::get('/chuyennganh/restore/{id}', [ChuyenNganhController::class, 'restore'])->name('chuyennganh.restore');
    Route::resource('chuyennganh', ChuyenNganhController::class);
});

