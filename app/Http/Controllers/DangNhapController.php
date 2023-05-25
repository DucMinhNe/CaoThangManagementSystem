<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
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
        // dd($request->all());
       //  $request->validate([
       //     'tai_khoan' => 'required',
       //     'mat_khau' => 'required',
       // ]);
   
       // $credentials = $request->only('tai_khoan', 'mat_khau');
       // if (Auth::attempt($credentials)) {
       //     return redirect('/dashboard');
       // }
       // return redirect()->back()->with('message', 'Login details are not valid!');    
       if (Auth::attempt(['tai_khoan' => $request->input('tai_khoan'), 'password' => $request->input('mat_khau')], true)) {
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
