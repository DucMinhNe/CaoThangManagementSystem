<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\GiangVien;


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
    public function xulydoimatkhau(Request $request)
    {
        $giangvien = GiangVien::where('ma_gv',$request->id)->where('trang_thai',1)->get();
    
        $newpassword= Hash::make($request->mat_khau_moi);
        $giangvien->update(
            ['mat_khau'=>$newpassword]
    );
        return response()->json(['success' => 'Thay dổi thành công.']);
        
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
