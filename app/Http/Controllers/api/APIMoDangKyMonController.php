<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\MoDangKyMon;
use App\Models\MonHoc;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\DangKyLopHocPhan;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\CTLopHocPhan;

class APIMoDangKyMonController extends Controller
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
    public function choPhepMoDangKyMon(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        //dd($request->all());
        $sinhvien=SinhVien::where('ma_sv',$request->ma_sv)->where('trang_thai',1)->first();
        $khoa_hoc=$sinhvien->khoa_hoc;
        $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$request->id_mon_hoc)
        ->where('khoa_hoc',$khoa_hoc)
        ->where('mo_dang_ky','<',$currenDateTime)
        ->where('dong_dang_ky','>',$currenDateTime)
        ->where('da_dong',0)
        ->where('trang_thai',1)
        ->first();
        //dd($moDangKyMon);
        if($moDangKyMon!=null){
            $daDangKyMon=DangKyLopHocPhan::join('lop_hoc_phans','lop_hoc_phans.id','dang_ky_lop_hoc_phans.id_lop_hoc_phan')
                                         ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                         ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                                         ->where('dang_ky_lop_hoc_phans.ma_sv',$request->ma_sv)
                                         ->where('dang_ky_lop_hoc_phans.created_at','>',$moDangKyMon->mo_dang_ky)
                                         ->where('dang_ky_lop_hoc_phans.created_at','<',$moDangKyMon->dong_dang_ky)
                                         ->where('dang_ky_lop_hoc_phans.trang_thai',1)
                                         ->first();
            $chuadangky=1;
            if($daDangKyMon==null)
                $chuadangky=0;
            return response()->json(
                [
                    'trang_thai'=>1,
                    'da_dang_ky_mon'=>$chuadangky,
                    'mo_dang_ky'=>$moDangKyMon->mo_dang_ky,
                    'dong_dang_ky'=>$moDangKyMon->dong_dang_ky,
                    'message'=>"Cho phép đăng ký môn"
                ], 200,);
        }
        return response()->json([
            'trang_thai'=>0,
            'message'=>"Chưa mở đăng ký"
        ], 200);
    }
    public function kiemTraSinhVienCoDuocPhepDangKyMon($ma_sv,$id_mon_hoc){
        $sinhvien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        $moDangKyMon=MoDangKyMon::where('khoa_hoc',$sinhvien->khoa_hoc)
                                ->where('id_mon_hoc',$id_mon_hoc)
                                ->where('mo_dang_ky','<',$currenDateTime)
                                ->where('dong_dang_ky','>',$currenDateTime)
                                ->where('trang_thai',1)
                                ->first();
        $daDangKyMon=DangKyLopHocPhan::join('lop_hoc_phans','lop_hoc_phans.id','dang_ky_lop_hoc_phans.id_lop_hoc_phan')
                                    ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                    ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$id_mon_hoc)
                                    ->where('dang_ky_lop_hoc_phans.ma_sv',$ma_sv)
                                    ->where('dang_ky_lop_hoc_phans.created_at','>',$moDangKyMon->mo_dang_ky)
                                    ->where('dang_ky_lop_hoc_phans.created_at','<',$moDangKyMon->dong_dang_ky)
                                    ->where('dang_ky_lop_hoc_phans.trang_thai',1)
                                    ->first();
        if($moDangKyMon!=null&&$daDangKyMon==null){
            return true;
        }return false;

    }
    public function choPhepTruyCapDangKyMonHoc(Request $request){
        if($this->kiemTraSinhVienCoDuocPhepDangKyMon($request->ma_sv,$request->id_mon_hoc)){
            return response()->json([
                'message'=>"Cho phép",
                'status'=>1
            ]);
        }
        return response()->json([
            'message'=>"Không cho phép",
            'status'=>0
        ]);
    }
    public function hienThiDanhSachDangKyMonHocCuaSinhVien($ma_sv){
        $sinhvien=SinhVien::where("ma_sv",$ma_sv)->where('trang_thai',1)->first();
        $chuongTrinhDaoTao=ChuongTrinhDaoTao::where('khoa_hoc',$sinhvien->khoa_hoc)->where('id_chuyen_nganh',$sinhvien->lopHoc->chuyenNganh->id)->where('trang_thai',1)->first();

        //dd($monHocTheoChuongTrinhDaoTao);

        if($chuongTrinhDaoTao->ctChuongTrinhDaoTao->count()>0){
        $data=array();
        $dataMonHocTinChi=array();
            foreach($chuongTrinhDaoTao->ctChuongTrinhDaoTao as $item){
                $diemMonHoc=LopHocPhan::join('ct_lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                      ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                      ->where('ct_chuong_trinh_dao_taos.id_mon_hoc','=',$item->id_mon_hoc)
                                      ->where('ct_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                                      ->where('lop_hoc_phans.trang_thai',1)
                                      ->orderBy('ct_lop_hoc_phans.tong_ket_2','desc')
                                      ->first();
                //dd($diemMonHoc);
                if($item->monHoc->loaiMonHoc->id==3){
                    if($diemMonHoc!=null &&$diemMonHoc->tong_ket_2!=null){
                        //dd($diemMonHoc);
                        if($diemMonHoc->tong_ket_2<5){
                            $dataMonHocTinChi[]=array(
                                'ten_mon_hoc'=>$item->monHoc->ten_mon_hoc,
                                'id_mon_hoc'=>$item->monHoc->id
                            );
                        }
                    }
                }else{
                    if($diemMonHoc!=null &&$diemMonHoc->tong_ket_2!=null){
                        //dd($diemMonHoc);
                        if($diemMonHoc->tong_ket_2<5){
                            $data[]=array(
                                'ten_mon_hoc'=>$item->monHoc->ten_mon_hoc,
                                'id_mon_hoc'=>$item->monHoc->id
                            );
                        }
                    }
                }


            }
        //dd($monHocRot->all());
        // $data=array();
        // foreach($monHocRot as $item){
        //     $data[]=array(
        //         'ten_mon_hoc'=>$item->ten,
        //         'id_mon_hoc_rot'=>$item->id_mon_hoc
        // );

        // }
        if(count($data)==0){
            return response()->json(
                [
                    "message"=>"Not Found",
                    "status"=>0
                ]

            , 200);
        }else{
            return response()->json([
                'dang_sach_mon_no'=>$data,
                'danh_sach_mon_hoc_chung_chi'=>$dataMonHocTinChi,
                'status'=>1,
            ]);
        }


       }else{

        return response()->json(
            [
                "message"=>"Not Found",
                "status"=>0
            ]

        , 200);
       }
    }

}
