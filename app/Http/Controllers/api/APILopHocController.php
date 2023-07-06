<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\GiangVien;
use App\Models\LopHoc;
use App\Models\QuaTrinhHocTap;

class APILopHocController extends Controller
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
    public function lopChuNhiem($ma_gv,Request $requset)
    {
        $lopChuNhiem = LopHoc::where('ma_gv_chu_nhiem',$ma_gv)->where('trang_thai',1)->get();
        $danhSachSinhVien=array();
        $giangVien = GiangVien::find($ma_gv);
        if($lopChuNhiem==null){
            return response()->json([
                'message'=>"Không tìm thấy lớp chủ nhiệm của giảng viên này",
                'status'=>0
            ]);
        }
        $data = array();
        foreach ($lopChuNhiem as $lopHoc) {
          $QuaTrinhHocTaps = QuaTrinhHocTap::where('id_lop_hoc',$lopHoc->id)->where('trang_thai',1)->get();
          foreach ($QuaTrinhHocTaps as $QuaTrinhHocTap) {
            $danhSachSinhVien[] =SinhVien::where('ma_sv',$QuaTrinhHocTap->ma_sv)->where('trang_thai',1)->first();
          }
          $data[]=array(
            'lop_hoc'=> $lopHoc,
            'giang_vien' =>$giangVien,
            'danh_sach_sinh_vien'=>$danhSachSinhVien
          );
        }
        return $data;

    }
    public function danhsachSinhvienlopChuNhiem($id_lop_chu_nhiem)
    {
        $danhSachSinhVien=array();
        $QuaTrinhHocTaps = QuaTrinhHocTap::where('id_lop_hoc',$id_lop_chu_nhiem)->where('trang_thai',1)->get();

          foreach ($QuaTrinhHocTaps as $QuaTrinhHocTap) {
            $danhSachSinhVien[] =SinhVien::where('ma_sv',$QuaTrinhHocTap->ma_sv)->where('trang_thai',1)->first();
          }
      
          return $danhSachSinhVien;
        
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
        return LopHoc::where('id',$id)->where('trang_thai',1)->first();
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
