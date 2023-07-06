<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\GiangVien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class APIGiangVienController extends Controller
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
    public function show($ma_gv)
    {
        return GiangVien::where('ma_gv',$ma_gv)->where('trang_thai',1)->first();

    }
    public function xulydoimatkhau($ma_gv,Request $request)
    {
        $giang_vien=GiangVien::find($ma_gv);
        if(Hash::check($request->mat_khau_cu,$giang_vien->mat_khau)){
            $giang_vien->update([
                'mat_khau'=>Hash::make($request->mat_khau_moi),
            ]);
            return response()->json([
                'message'=>"Thay đổi mật khẩu thành công",
                'status'=>1,
            ],201);
        }
        return response()->json([
            'message'=>"Mật khẩu cũ không khớp với mật khẩu hiện tại",
            'status'=>0,
        ],401);
        
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

}
