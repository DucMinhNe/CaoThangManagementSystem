<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\ChuyenNganhController;

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
// Route::get('/', function () {return redirect('/admin/dangnhap');});
Route::get('/admin/dangnhap', [DangNhapController::class,'dangNhap'])->name('login');
Route::post('/admin/dangnhap', [DangNhapController::class,'kiemTraDangNhap']);
Route::get('/admin/dangxuat', [DangNhapController::class,'dangXuat']);

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', function () {return redirect('/admin');});
//     Route::get('/admin', function () {return view('admin.index');});

// 	Route::resource("/admin/sinhvien", SinhVienController::class);
//     Route::resource("/admin/giangvien", GiangVienController::class);
//     Route::resource('khoa', KhoaController::class);
// });
Route::get('/', function () {return redirect('/admin');})->middleware('auth');
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    
    Route::resource("sinhvien", SinhVienController::class);
    Route::resource("giangvien", GiangVienController::class);
    Route::get('/khoa/getInactiveData', [KhoaController::class, 'getInactiveData'])->name('khoa.getInactiveData');
    Route::get('/khoa/restore/{id}', [KhoaController::class, 'restore'])->name('khoa.restore');
    Route::resource('khoa', KhoaController::class);
   
    Route::resource('chuyennganh', ChuyenNganhController::class);
});

// Route::get('/', [AuthController::class,'login']);
// Route::post('/login', [AuthController::class,'AuthLogin']);
// Route::get('/logout', [AuthController::class,'logout']);
// Route::get('/dashboard', function () {
//     return view('main');
// });

// Route::get('/student/import', function () {
//     return view('students.import');
// });

// Route::resource("/student", StudentController::class);
// Route::controller(StudentController::class)->group(function(){
//     Route::get('students-export', 'export')->name('users.export');
//     Route::post('students-import', 'import')->name('users.import');
// });
// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('/', function () {return redirect('dashboard');})->middleware('auth')->name('dashboard');
// 	// Route::resource("/fied", FiedController::class);
// 	// Route::resource('/card', CardController::class);
// 	// Route::resource("/question", QuestionController::class);
// 	// Route::resource("/member", MemberController::class);
// 	// Route::resource("/admin", AdminController::class);
// });
// Route::get('/', function () {
//     return view('welcome');
// });
