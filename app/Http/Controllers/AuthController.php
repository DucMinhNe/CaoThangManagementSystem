<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Hash;
class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check()))
        {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }
    public function AuthLogin(Request $request){
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
        return redirect('/dashboard');
    } else {
        return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }
    }
    public function logout(){
       Auth::logout();
        return redirect(url(''));
    }
}
