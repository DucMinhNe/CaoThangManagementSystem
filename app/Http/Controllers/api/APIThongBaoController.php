<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\ThongBao;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\ThongBaoCuaSinhVien;


class APIThongBaoController extends Controller
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

    public function layDanhSachThongBaoCuaSinhVien($ma_sv){
        $listThongbaos=ThongBaoCuaSinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->orderBy('created_at','desc')->get();
        $data=[];

        foreach($listThongbaos as $thongbao){
            $tb=ThongBao::find($thongbao->id_thong_bao);
            $giangvien=GiangVien::where('ma_gv',$tb->ma_gv)->where('trang_thai',1)->first();

            array_push($data,[
                'id'=>$thongbao->id,
                'thong_bao'=>$thongbao->thongBao,
                'giang_vien'=>$giangvien,
                'ma_sv'=>$ma_sv,
                'trang_thai_doc'=>$thongbao->trang_thai_doc
            ]);

        }
        return $data;
    }
    // public function layDanhSachThongBaoCuaLop(Request $request){
    //     if ($request->type == 0 ){
    //         $listThongbaos=ThongBao::where('id_lop_hoc',$request->id)
    //                                 ->where('trang_thai',1)
    //                                 ->get();
    //     }
    //     else
    //     {
    //         $listThongbaos=ThongBao::where('id_lop_hoc_phan',$request->id)
    //         ->where('trang_thai',1)
    //         ->get();
    //     }

    //     $data=[];

    //     foreach($listThongbaos as $thongbao){
    //         $giangvien=GiangVien::where('ma_gv',$thongbao->ma_gv)
    //                             ->where('trang_thai',1)
    //                             ->first();

    //         $DSSV = array();
    //         foreach($thongbao->ThongBaoCuaSinhVien  as $thong_bao_sv)
    //         {
    //             $DSSV[]=$thong_bao_sv->SinhVien_ThongBao;
    //         }
    //         array_push($data,[
    //             'id'=>$thongbao->id,
    //             'ma_gv'=>$thongbao->ma_gv,
    //             'ten_giang_vien'=>$giangvien->ten_giang_vien,
    //             'hinh_anh_dai_dien'=>$giangvien->hinh_anh_dai_dien,
    //             'tieu_de'=>$thongbao->tieu_de,
    //             'noi_dung'=>$thongbao->noi_dung,
    //             'ngay_tao'=>$thongbao->created_at,
    //             'danh_sach_sinh_vien' => $DSSV
    //         ]);

    //     }
    //     return $data;
    // }
    public function layDanhSachThongBaoCuaLop(Request $request){
        if ($request->type == 0 ){
            $listThongbaos=ThongBao::where('id_lop_hoc',$request->id)
                                    ->where('trang_thai',1)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }
        else
        {
            $listThongbaos=ThongBao::where('id_lop_hoc_phan',$request->id)
            ->where('trang_thai',1)
            ->get();
        }

        $data=[];

        foreach($listThongbaos as $thongbao){
            $giangvien=GiangVien::where('ma_gv',$thongbao->ma_gv)
                                ->where('trang_thai',1)
                                ->first();

            $DSSV = array();
            foreach($thongbao->ThongBaoCuaSinhVien  as $thong_bao_sv)
            {
                $DSSV[]=$thong_bao_sv->SinhVien_ThongBao;
            }
            array_push($data,[
                'id'=>$thongbao->id,
                'ma_gv'=>$thongbao->ma_gv,
                'ten_giang_vien'=>$giangvien->ten_giang_vien,
                'hinh_anh_dai_dien'=>$giangvien->hinh_anh_dai_dien,
                'tieu_de'=>$thongbao->tieu_de,
                'noi_dung'=>$thongbao->noi_dung,
                'ngay_tao'=>$thongbao->created_at,
                'danh_sach_sinh_vien' => $DSSV
            ]);

        }
        return $data;
    }
    public function capNhatTrangThaiThongBao($id){
        $thongBao=ThongBaoCuaSinhVien::where('id',$id)->where('trang_thai',1)->first();
        $thongBao->update([
            'trang_thai_doc'=>1,
        ]);
        return response()->json([
            'message'=>"Cập nhật trạng thái thông báo đã đọc",
            'status'=>1
        ]);
    }

    public function xulythemthongbao(Request $request)
    {


            $data =$request->all();

            $js_e = json_encode($data);
            $js_d =json_decode($js_e);
                $thongbao = null;

            if($js_d->type == 1)
            {
                $thongbao = ThongBao::create(
                    [
                        'id_lop_hoc_phan'=>$js_d->id,
                        'ma_gv'=>$js_d->ma_gv,
                        'tieu_de'=>$js_d->tieu_de,
                        'noi_dung'=>$js_d->noi_dung
                    ]
                    );

            }
            else{
                $thongbao = ThongBao::create(
                    [
                        'id_lop_hoc'=>$js_d->id,
                        'ma_gv'=>$js_d->ma_gv,
                        'tieu_de'=>$js_d->tieu_de,
                        'noi_dung'=>$js_d->noi_dung
                    ]
                    );
            }

            foreach($js_d->danh_sach_sinh_vien as $sv )
            {

                $data = ThongBaoCuaSinhVien::create(
                    [
                        'id_thong_bao'=>$thongbao->id,
                         'ma_sv'=>$sv->ma_sinh_vien

                    ]
                    );
            }



            return response()->json([
                'message'=>'Thêm thông báo thành công',
                'status'=> 1 ,

            ],201
        );

        }

        public function laythongbao($id)
        {
                  $thongBao=ThongBao::where('id',$id)->where('trang_thai',1)->first();
                  $danh_sach_sinh_vien = ThongBaoCuaSinhVien::where('id_thong_bao',$id)->where('trang_thai',1)->get();

                  $data = array();

                  foreach($danh_sach_sinh_vien as $sv)
                  {
                    $sv_nhan = SinhVien::where('ma_sv',$sv->ma_sv)->where('trang_thai',1)->first();
                    $data[]=$sv_nhan;
                  }

                  return response()->json([
                   'thong_bao'=>$thongBao,
                   'danh_sach_sinh_vien'=>$data
                ]);

        }

        public function suathongbao(Request $request)
        {
            $thongBao=ThongBao::where('id',$request->id)->where('trang_thai',1)->first();
            $thongBao_sinhvien = ThongBaoCuaSinhVien::where('id_thong_bao',$request->id)->where('trang_thai',1)->delete();
            foreach ($request->danh_sach_sinh_vien as $sv) {
                ThongBaoCuaSinhVien::create(
                    [
                        'ma_sv'=> $sv['ma_sinh_vien'],
                        'id_thong_bao'=>$request->id,
                    ]
                );
            }
            $thongBao->update($request->all());

            return response()->json([
                'message'=>"Cập nhật thông báo thành công",
                'status'=>1
            ],  201);

        }


    public function xoaThongbao(Request $request)
    {
        $sinhvien_nhanthongbao =  ThongBaoCuaSinhVien::where('id_thong_bao',$request->id)
                                                     ->where('trang_thai',1)->get();

        foreach($sinhvien_nhanthongbao as $sv)
        {
            $sv->update(
                [
                    'trang_thai'=>0,
                ]
            ) ;
        }

        $thongBao = ThongBao::where('id',$request->id)
                            ->where('trang_thai',1)->first();
        $thongBao->update([
            'trang_thai'=>0,
        ]);

        return response()->json([
            'message'=>"Xoá thông báo thành công",
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
