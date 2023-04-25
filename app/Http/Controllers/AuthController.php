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
       //dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password'=> $request->password],true))
       {
        return redirect('/dashboard');
       }
       else 
       {
        return redirect()->back()->with('error','email hoac pass ko dung');
       }
    }
    public function logout(){
       Auth::logout();
        return redirect(url(''));
    }
}
