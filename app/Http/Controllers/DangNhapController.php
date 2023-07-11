<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\GiangVien;
class DangNhapController extends Controller
{
    public function dangNhap(){
        if(!empty(Auth::check()))
        {
            return redirect('/admin');
        }
        return view('admin.dangnhaps.dangnhap');
    }
    public function kiemTraDangNhap(Request $request){
       $credentials = [
        'tai_khoan' => $request->input('tai_khoan'),
        'password' => $request->input('mat_khau')
    ];
    if (Auth::attempt($credentials, true)) {
        $user = Auth::user();
        if ($user->trang_thai == 0) {
            Auth::logout();
            return redirect('/admin/dangnhap')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa.');
        }
        return redirect('/admin');
    } else {
        return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function dangXuat(){
        Auth::logout();
        return redirect(url('/admin/dangnhap'));
     }
}