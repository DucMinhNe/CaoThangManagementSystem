<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\LopHocPhan;
use App\Models\CTLopHocPhan;
use App\Models\MonHoc;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\Phong;
use App\Models\LopHoc;

class APILopHocPhanController extends Controller
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
    public function laydssinhvien_lophocphan($id)
    {
       $chitietlophocphan = CTLopHocPhan::where('id_lop_hoc_phan',$id)->where('trang_thai',1)->get();
        $arr_sv = array();
       foreach($chitietlophocphan as $sv_lhp)
       {
        $sinhvien = SinhVien::find($sv_lhp->ma_sv);
        $arr_sv[]= $sinhvien;
       }
       return $arr_sv;
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
        return LopHocPhan::join('lop_hocs','lop_hocs.id','=','lop_hoc_phans.id_lop_hoc')
                        ->select('lop_hocs.ten_lop_hoc','lop_hoc_phans.ten_lop_hoc_phan')
                        ->where('lop_hoc_phans.id',$id)
                        ->first();
       
    }
    public function layLopHoc()
    {
        $data = null;
        
        return $data;
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
    public function layDanhSachLopHocPhanTheoGiangVien($ma_gv,Request $request){
        $danhSachlopHocPhan=null;
        if($request->option==1){
            $lopHocPhan=LopHocPhan::where('id',$request->id_lop_hoc_phan)
                                          ->where(function($query) use ($ma_gv){
                                            $query->where('lop_hoc_phans.ma_gv_1',$ma_gv)
                                            ->orWhere('lop_hoc_phans.ma_gv_2',$ma_gv)
                                            ->orWhere('lop_hoc_phans.ma_gv_3',$ma_gv);
                                        })
                                          ->where('trang_thai',1)
                                        
                                          ->first();
            $danhSachSinhVien=array();
            if($lopHocPhan==null){
                return response()->json([
                    'message'=>"Không tìm thấy lớp học phần của giảng viên này",
                    'status'=>0
                ]);
            }
            $danhSachChiTietLopHocPhan=CTLopHocPhan::where('id_lop_hoc_phan',$lopHocPhan->id)->where('trang_thai',1)->get();
            $danhSachSinhVien=array();
            foreach ($danhSachChiTietLopHocPhan as $chiTietLopHocPhan) {
                $danhSachSinhVien[]=$chiTietLopHocPhan->sinhVien;
            }
            return response()->json([
                'id_lop_hoc_phan'=>$lopHocPhan->id,
                'giang_vien_chinh'=>$lopHocPhan->giangVienChinh,
                'giang_vien_phu'=>$lopHocPhan->giangVienPhu,
                'mon_hoc'=>$lopHocPhan->chiTietChuongTrinhDaoTao->monHoc,
                'lop_hoc'=>$lopHocPhan->lopHoc,
                'danh_sach_sinh_vien'=>$danhSachSinhVien
                ]
            );

        }else{
            $danhSachlopHocPhan=LopHocPhan::
                where(function($query) use ($ma_gv){
                $query->where('lop_hoc_phans.ma_gv_1',$ma_gv)
                ->orWhere('lop_hoc_phans.ma_gv_2',$ma_gv)
                ->orWhere('lop_hoc_phans.ma_gv_3',$ma_gv);
                })->where('trang_thai_hoan_thanh',0)
                ->get();
                              //return $danhSachlopHocPhan;
        $data=array();
        foreach($danhSachlopHocPhan as $lopHocPhan){
            $danhSachSinhVien=array();

            foreach($lopHocPhan->chiTietLopHocPhan->sortBy('ma_sv') as $chiTietLopHocPhan){
                $danhSachSinhVien[]=$chiTietLopHocPhan->sinhVien;
            }
            $data[]=array(
                'id_lop_hoc_phan'=>$lopHocPhan->id,
                'giang_vien_chinh'=>$lopHocPhan->giangVienChinh,
                'giang_vien_phu'=>$lopHocPhan->giangVienPhu,
                'mon_hoc'=>$lopHocPhan->chiTietChuongTrinhDaoTao->monHoc,
                'lop_hoc'=>$lopHocPhan->lopHoc,
                'danh_sach_sinh_vien'=>$danhSachSinhVien
            );
        }
        
        return $data;
        }


    }

    
    public function danhSachLopHocPhanConMoThuocMonHoc($id){
        $lopHocPhan=LopHocPhan::select('lop_hoc_phans.*')
                              ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                              //->join('lop_hocs','lop_hocs.id','lop_hoc_phans.id_lop_hoc')
                              ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$id)
                              ->where('lop_hoc_phans.mo_dang_ky',1)
                              ->where('lop_hoc_phans.trang_thai',1)
                              ->get();
        //dd($lopHocPhan);
        $data=array();
        foreach($lopHocPhan as $item){
            $giangVien1=GiangVien::where('ma_gv',$item->ma_gv_1)->where('trang_thai',1)->first();
            $giangVien2=GiangVien::where('ma_gv',$item->ma_gv_2)->where('trang_thai',1)->first();
            //dd($giangVien2);
            $thoiKhoaBieu=ThoiKhoaBieu::where('id_lop_hoc_phan',$item->id)->where('trang_thai',1)->get();
            $dataThoiKhoaBieu=array();
            $lop_hoc=LopHoc::where('id',$item->id_lop_hoc)->where('trang_thai',1)->first();
            foreach($thoiKhoaBieu as $tkb){

                $tietBatDau=ThoiGianBieu::where('id',$tkb->id_tiet_bat_dau)->where('trang_thai',1)->first();
                $tietKetThuc=ThoiGianBieu::where('id',$tkb->id_tiet_ket_thuc)->where('trang_thai',1)->first();
                $phongHoc=Phong::where('id',$tkb->id_phong_hoc)->where('trang_thai',1)->first();
                $dataThoiKhoaBieu[]=array(
                    'id_lop_hoc_phan'=>$item->id,
                    'ten_lop_hoc_phan'=>$item->ten_lop_hoc_phan,
                    'phong_hoc'=>$phongHoc->ten_phong,
                    'thu'=>$tkb->thu_trong_tuan,
                    'tiet_bat_dau'=>$tietBatDau->stt,
                    'thoi_gian_bat_dau'=>$tietBatDau->thoi_gian_bat_dau,
                    'tiet_ket_thuc'=>$tietKetThuc->stt,
                    'thoi_gian_ket_thuc'=>$tietKetThuc->thoi_gian_ket_thuc,
                );
            }
            $data[]=array(
                'id_lop_hoc_phan'=>$item->id,
                'ten_lop_hoc_phan'=>$item->ten_lop_hoc_phan,
                'lop_hoc'=>$lop_hoc,
                'giang_vien_1'=>$giangVien1->ten_giang_vien,
                'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_giang_vien:"Empty",
                'lich_hoc'=>$dataThoiKhoaBieu,
            );
        }
        //dd($data);
        return $data;
    }
}
