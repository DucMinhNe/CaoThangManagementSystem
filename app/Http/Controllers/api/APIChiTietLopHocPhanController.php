<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\CTLopHocPhan;
use App\Models\SinhVien;
class APIChiTietLopHocPhanController extends Controller
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
    public function bangdiemsinhvien($id)
    {
        $bangdiem = CTLopHocPhan::where('id_lop_hoc_phan',$id)->where ('trang_thai',1)->get();

        $data = [];


        foreach ($bangdiem as $diem_sv) {
            $sinhvien = SinhVien::where('ma_sv',$diem_sv->ma_sv)->where ('trang_thai',1)->first();
            if($diem_sv->ma_sv == $sinhvien->ma_sv)
            {
                array_push($data,[
                    'id'=>$diem_sv->id,
                    'ma_sv'=>$diem_sv->ma_sv,
                    'ten_sinh_vien'=>$sinhvien->ten_sinh_vien,
                    'chuyen_can'=>$diem_sv->chuyen_can,
                    'tbkt'=>$diem_sv->tbkt,

                    'thi_1'=>$diem_sv->thi_1,
                    'thi_2'=>$diem_sv->thi_2,
                    'tong_ket_1'=>$diem_sv->tong_ket_1,
                    'tong_ket_2'=>$diem_sv->tong_ket_2
                ]);
            }
        }

        return $data;
    }

    public function thaydoidiem($id_lop_hoc_phan,Request $request)
    {

        $diem_sv = CTLopHocPhan::where('ma_sv',$request->ma_sv)->where('trang_thai',1)->where('id_lop_hoc_phan',$id_lop_hoc_phan)->first();
        unset($request['ma_sv']);
        $diem_sv->update([
            'chuyen_can'=> $request->chuyen_can,
            'tbkt' =>$request->tbkt,
            'thi_1'=> $request->thi_1,
            'thi_2'=>$request->thi_2,
            'tong_ket_1'=>$request->tong_ket_1,
            'tong_ket_2'=>$request->tong_ket_2,
        ]
        );
        return response()->json([
            'message'=>"Cập nhật điểm thành công",
            'status'=>1
        ],  201);
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
}
