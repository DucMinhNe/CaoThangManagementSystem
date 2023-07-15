<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SinhVien;
use App\Models\GiangVien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class APIAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getPasswordHash(Request $request){
        return Hash::make($request->mat_khau);
    }
    //  public function loginSinhVien(Request $request){
    //     $credentials = $request->validate([
    //         'tai_khoan' => ['required'],
    //         'mat_khau' => ['required'],
    //     ]);

    //     if (Auth::guard('sinh_viens')->attempt($credentials)) {
    //         $sinhvien = Auth::guard('sinh_viens')->user();
    //         $token = $sinhvien->createToken('myapptoken')->plainTextToken;

    //         return response()->json([
    //             'sinh_vien' => $sinhvien,
    //             'token' => $token,
    //         ]);
    //     }
    // }
    // public function loginSinhVien(Request $request){
    //     $taiKhoanSinhVien=TaiKhoanSinhVien::where('tai_khoan',$request->tai_khoan)->where('trang_thai',1)->first();
    //     if(!$taiKhoanSinhVien||!Hash::check($request->mat_khau, $taiKhoanSinhVien->mat_khau)){
    //         return response([
    //             'message'=>'Đăng nhập không được'
    //         ],401);
    //     }
    //     $token=$taiKhoanSinhVien->createToken('myapptoken')->plainTextToken;
    //     $sinhVien=SinhVien::where('ma_sv',$taiKhoanSinhVien->ma_sv)->where('trang_thai',1)->first();
    //     $response=[
    //         'sinh_vien'=>$sinhVien,
    //         'token'=>$token,
    //     ];
    //     return response($response,201);
    //}
     public function loginSinhVien(Request $request){
        $sinhvien=SinhVien::where('tai_khoan',$request->tai_khoan)->where('trang_thai',1)->first();
        if($sinhvien && !Hash::check($request->mat_khau, $sinhvien->mat_khau))
        {
            return response([
                'message'=>'Sai mật khẩu',
                'status' => '-1',
                'token' =>''
            ],401);
        }
        if(!$sinhvien){
            return response([
                'message'=>'Tài khoản không tồn tại trong hệ thống',
                'status' => '0',
                'token' =>''
            ],401);
        }
        $token=$sinhvien->createToken('myapptoken')->plainTextToken;
        $sinhvien=SinhVien::where('ma_sv',$sinhvien->ma_sv)->where('trang_thai',1)->first();
        $response=[
            'sinh_vien'=>$sinhvien,
            'token'=>$token,
            'status'=>'1'
        ];
        return response($response,201);
    }
    public function logoutSinhVien(Request $request){

        $token=SinhVien::where('ma_sv',$request->ma_sv)->where('trang_thai',1)->first()->tokens()->delete();
        return [
            'message'=>"Logged out",
            'code'=>201,
        ];
    }
    public function checkLogin(Request $request){
        $sinhvien=SinhVien::join('personal_access_tokens','personal_access_tokens.tokenable_id','sinh_viens.ma_sv')
                                            ->where('tokenable_type','App\Models\SinhVien')
                                            ->where('ma_sv',$request->ma_sv)
                                            ->first();
        if($sinhvien!=null){
            return[
                'status'=>true,
                'code'=>201
            ];
        }
        return[
            'status'=>false,
            'code'=>201
        ];
    }
    public function DangNhapGiangVien(Request $request)
    {
        $taiKhoanGiangVien=GiangVien::where('tai_khoan',$request->tai_khoan)->where('trang_thai',1)->first();

        if($taiKhoanGiangVien && !Hash::check($request->mat_khau, $taiKhoanGiangVien->mat_khau))
        {
            return response([
                'message'=>'Sai mật khẩu',
                'status' => '-1',
                'token' =>''
            ],401);
        }
        if(!$taiKhoanGiangVien){
            return response([
                'message'=>'Tài khoản không tồn tại trong hệ thống',
                'status' => '0',
                'token' =>''
            ],401);
        }

        $token=$taiKhoanGiangVien->createToken('myapptoken')->plainTextToken;

        $giangVien=GiangVien::where('ma_gv',$taiKhoanGiangVien->ma_gv)->where('trang_thai',1)->first();
        $response=[
            'giang_vien'=>$giangVien,
            'token'=>$token,
            'status' => '1',
        ];
        return $response;
    }
    public function dangXuatGiangVien(Request $request){

        $token=GiangVien::where('ma_gv',$request->ma_gv)->where('trang_thai',1)->first()->tokens()->delete();
        return [
            'message'=>"Logged out",
            'code'=>201,
        ];
    }
    public function kiemtraDangNhap_GiangVien(Request $request){
        $taiKhoanGiangVien=GiangVien::join('personal_access_tokens','personal_access_tokens.tokenable_id','giang_viens.ma_gv')
                                            ->where('tokenable_type','App\Models\GiangVien')
                                            ->where('ma_gv',$request->ma_gv)
                                            ->first();
        if($taiKhoanGiangVien!=null){
            return[
                'status'=>true,
                'code'=>201
            ];
        }
        return[
            'status'=>false,
            'code'=>201
        ];
    }
}
