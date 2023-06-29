<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;


class APIMonHocController extends Controller
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
        return MonHoc::where('id',$id)->where('trang_thai',1)->first();
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
