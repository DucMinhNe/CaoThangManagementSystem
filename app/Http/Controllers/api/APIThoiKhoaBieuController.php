<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\GiangVien;
use App\Models\MonHoc;
use App\Models\LopHocPhan;
use App\Models\LopHoc;
use App\Models\SinhVien;
use App\Models\Phong;
use App\Models\DangKyLopHocPhan;
use App\Models\CTChuongTrinhDaoTao;
class APIThoiKhoaBieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ThoiKhoaBieu::where('trang_thai',1)->first();
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
    // public function lichHocCuaCacLopHocPhanDangDangKy($ma_sv){
    //     $dangKyLopHocPhan=DangKyLopHocPhan::where('ma_sv',$ma_sv)->where('trang_thai',1)->get();
    //     $lichHocCuaLopHocPhanDangKy=array();
    //     foreach ($dangKyLopHocPhan as $dangKy) {
    //         $chiTietLopHocPhan=$dangKy->lopHocPhan->chiTietLopHocPhan->where('ma_sv',$ma_sv)->first();
    //         if($chiTietLopHocPhan==null){
    //             $lichHocCuaLopHocPhanDangKy[]=array(

    //             );
    //         }
    //     }

    // }
    public function layHocKyHienTaiCuaSinhVien($ma_sv){
        $hocKyHienTai=LopHocPhan::join('ct_lop_hoc_phans','lop_hoc_phans.id','ct_lop_hoc_phans.id_lop_hoc_phan')
                              ->join('thoi_khoa_bieus','thoi_khoa_bieus.id_lop_hoc_phan','lop_hoc_phans.id')
                              ->where('ct_lop_hoc_phans.ma_sv',$ma_sv)
                              ->where('ct_lop_hoc_phans.trang_thai',1)
                              ->where('lop_hoc_phans.trang_thai',1)
                              ->where('thoi_khoa_bieus.trang_thai',1)
                              ->orderBy('thoi_khoa_bieus.hoc_ky','desc')
                              ->first()->hoc_ky;
        return response()->json([
            'hoc_ky_hien_tai'=>$hocKyHienTai,
            'status'=>1,
        ]);
    }
    public function getLichHoc($id){
        $ThoiKhoaBieu=ThoiKhoaBieu::where('id',$id)->where('trang_thai',1)->first();
        $PhongHoc=Phong::where('id',$ThoiKhoaBieu->id_phong_hoc)->where('trang_thai',1)->first();
        $LopHocPhan=LopHocPhan::where('id',$ThoiKhoaBieu->id_lop_hoc_phan)->where('trang_thai',1)->first();
        $CtChuongTrinhDaoTao=CTChuongTrinhDaoTao::where('id',$LopHocPhan->id_ct_chuong_trinh_dao_tao)->where('trang_thai',1)->first();
        $GiangVien=GiangVien::where('id',$LopHocPhan->ma_gv_1)->where('trang_thai',1)->first();
        $MonHoc=MonHoc::where('id',$CtChuongTrinhDaoTao->id_mon_hoc)->where('trang_thai',1)->first();
        $TietBatDau=ThoiGianBieu::where('id',$ThoiKhoaBieu->id_tiet_bat_dau)->where('trang_thai',1)->first();
        $TietKetThuc=ThoiGianBieu::where('id',$ThoiKhoaBieu->id_tiet_ket_thuc)->where('trang_thai',1)->first();
         return response()->json([
            'data'=>[
                'id'=>$ThoiKhoaBieu->id,
                'id_phong_hoc'=>$PhongHoc->id,
                'id_lop_hoc_phan'=>$LopHocPhan->id,
                'ten_phong_hoc'=>$PhongHoc->ten_phong,
                'ten_phong_hoc'=>$PhongHoc->ten_phong,
                'id_mon_hoc'=>$MonHoc->id,
                'ten_mon_hoc'=>$MonHoc->ten_mon_hoc,
                'id_giang_vien'=>$GiangVien->id,
                'ten_giang_vien'=>$GiangVien->ten_giang_vien,
                'tiet_bat_dau'=>$TietBatDau->stt,
                'tiet_ket_thuc'=>$TietKetThuc->stt,
                'thoi_gian_bat_dau'=>$TietBatDau->thoi_gian_bat_dau,
                'thoi_gian_ket_thuc'=>$TietKetThuc->thoi_gian_ket_thuc,
                'thu_trong_tuan'=>$ThoiKhoaBieu->thu_trong_tuan,
            ]


         , 'status'=>200]);
    }
    public function danhSachLichHocCuaSinhVienDangKyHocPhan($ma_sv){
        $lopDangKyHocPhan=DangKyLopHocPhan::where('ma_sv',$ma_sv)->where('trang_thai',1)->get();
        $data=array();
        $thu=array(1,2,3,4,5,6,7);
        $lich_hoc=array();
        foreach ($thu as $day) {
            foreach ($lopDangKyHocPhan as $dangKy) {
                $count=0;
                $lichThuocThu=array();
                $sinhVienDaHoanThanhLopHocPhan=$dangKy->lopHocPhan->chiTietLopHocPhan->where('ma_sv',$ma_sv)->whereNull('tong_ket_1')->whereNull('tong_ket_2')->first();
                if($sinhVienDaHoanThanhLopHocPhan!=null){
                    $dataLichHoc=array();
                    foreach ($dangKy->lopHocPhan->thoiKhoaBieu as $tkb) {
                        if($tkb->thu_trong_tuan==$day){
                            $count=$count+1;
                            $dataLichHoc[]=array(
                                'phong_hoc'=>$tkb->phongHoc,
                                //'thu_trong_tuan'=>$tkb->thu_trong_tuan,
                                'tiet_bat_dau'=>$tkb->tietBatDau,
                                'tiet_ket_thuc'=>$tkb->tietKetThuc,
                            );
                        }

                    }
                    $lichThuocThu[]=array(
                        'mon_hoc'=>$dangKy->lopHocPhan->chiTietChuongTrinhDaoTao->monHoc,
                        'lop_hoc'=>$dangKy->lopHocPhan->lopHoc,
                        'giang_vien_1'=>$dangKy->lopHocPhan->giangVienChinh!=null?$dangKy->lopHocPhan->giangVienChinh:"Empty",
                        'giang_vien_2'=>$dangKy->lopHocPhan->giangVienPhu!=null?$dangKy->lopHocPhan->giangVienPhu:"Empty",
                        'giang_vien_3'=>$dangKy->lopHocPhan->giangVienPhu2!=null?$dangKy->lopHocPhan->giangVienPhu2:"Empty",
                        'lich_hoc'=>$dataLichHoc
                    );
                    // 'thu_trong_tuan'=>$dangKy->lopHocPhan,
                    //     'tiet_bat_dau'=>$tietBatDau->stt,
                    //     'thoi_gian_bat_dau'=>$tietBatDau->thoi_gian_bat_dau,
                    //     'tiet_ket_thuc'=>$tietKetThuc->stt,
                    //     'thoi_gian_ket_thuc'=>$tietKetThuc->thoi_gian_ket_thuc
                    if($count>0){
                        $lich_hoc[]=array(
                            'thu_trong_tuan'=>$day,
                            'lich_hoc'=>$lichThuocThu
                        );
                    }
                }
            }

        }

        return $lich_hoc;
    }
    public function danhSachLichHocCuaSinhVienTheoChuongTrinh($ma_sv){
        $sinhVien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $lophoc=LopHoc::where('id',$sinhVien->id_lop_hoc)->first();
        $thoiKhoaBieu= ThoiKhoaBieu::join('lop_hoc_phans','thoi_khoa_bieus.id_lop_hoc_phan','lop_hoc_phans.id')
                                // ->join('ct_lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                // ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                // ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
                                ->join('phongs','phongs.id','thoi_khoa_bieus.id_phong_hoc')
                                // ->where('ct_lop_hoc_phans.ma_sv',$ma_sv)
                                ->where('id_lop_hoc',$sinhVien->id_lop_hoc)
                                ->where('lop_hoc_phans.trang_thai_hoan_thanh')
                                ->where('thoi_khoa_bieus.trang_thai',1);

        // return $thoiKhoaBieu->select('lop_hoc_phans.*')->get();
        $phongHoc= clone $thoiKhoaBieu;
        $phongHoc=$phongHoc->select('id_lop_hoc','ten_phong','id_phong_hoc')->distinct()->get();
        //dd($phongHoc);
        $data=array();
        foreach($phongHoc as $p){
            $lichThuocPhong=array();
            $lichHoc=clone $thoiKhoaBieu;
            $lichHoc=$lichHoc->where('id_phong_hoc',$p->id_phong_hoc)->get();
            //dd($lichHoc);
            foreach($lichHoc as $lich){
                // $lopHocPhanDangKy=DangKyLopHocPhan::where('id_lop_hoc_phan',$lich->id_lop_hoc_phan)->where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
                // if($lopHocPhanDangKy==null){
                    $tietBatDau=ThoiGianBieu::where('id',$lich->id_tiet_bat_dau)->where('trang_thai',1)->first();
                    $tietKetThuc=ThoiGianBieu::where('id',$lich->id_tiet_ket_thuc)->where('trang_thai',1)->first();
                    $giangVien1=GiangVien::where('ma_gv',$lich->ma_gv_1)->where('trang_thai',1)->first();

                    $monhoc=null;
                    if($lich->id_ct_chuong_trinh_dao_tao!=null){
                        $monhoc=MonHoc::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id_mon_hoc','mon_hocs.id')->where('ct_chuong_trinh_dao_taos.id',$lich->id_ct_chuong_trinh_dao_tao)->select('mon_hocs.*')->first();
                    }
                    $giangVien2=GiangVien::where('ma_gv',$lich->ma_gv_2)->where('trang_thai',1)->first();
                    $lichThuocPhong[]=array(
                        'mon_hoc'=>$monhoc!=null?$monhoc->ten_mon_hoc:$lich->ten_lop_hoc_phan,
                        'hoc_ky'=>$lich->hoc_ky,
                        'giang_vien_1'=>$giangVien1!=null?$giangVien1->ten_giang_vien:"Empty",
                        'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_giang_vien:"Empty",
                        'lop_hoc'=>array(
                            'ten_lop_hoc'=>$lophoc->ten_lop_hoc,
                            'giang_vien_chu_nhiem'=>$lophoc->giangVienChuNhiem,
                        ),
                        'thu_trong_tuan'=>$lich->thu_trong_tuan,
                        'tiet_bat_dau'=>$tietBatDau->stt,
                        'thoi_gian_bat_dau'=>$tietBatDau->thoi_gian_bat_dau,
                        'tiet_ket_thuc'=>$tietKetThuc->stt,
                        'thoi_gian_ket_thuc'=>$tietKetThuc->thoi_gian_ket_thuc
                    );
                // }

            }
            $data[]=array(
                'id_phong_hoc'=>$p->id_phong_hoc,
                'ten_phong_hoc'=>$p->ten_phong,

                'lich'=>$lichThuocPhong

            );
        }

        return $data;

    }

    // public function DanhSachLichDayGiangVien($ma_giang_vien)
    // {

    //     $thoiKhoaBieu= ThoiKhoaBieu::join('lop_hoc_phans','thoi_khoa_bieus.id_lop_hoc_phan','lop_hoc_phans.id')
    //     ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
    //     ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
    //     ->join('phong_hocs','phong_hocs.id','thoi_khoa_bieus.id_phong_hoc')
    //     ->where('lop_hoc_phans.ma_gv_1',$ma_giang_vien)
    //     ->orWhere('lop_hoc_phans.ma_gv_2',$ma_giang_vien)
    //     ->orWhere('lop_hoc_phans.ma_gv_3',$ma_giang_vien)
    //     ->where('lop_hoc_phans.mo_lop',1)
    //     ->where('thoi_khoa_bieus.trang_thai',1);

    //     //    dd($thoiKhoaBieu->get());
    //     $phongHoc= clone $thoiKhoaBieu;
    //     $phongHoc=$phongHoc->select('ten_phong_hoc','id_phong_hoc')->distinct()->get();
    //     //dd($phongHoc);
    //     $data=array();
    //     foreach($phongHoc as $p){
    //     $lichThuocPhong=array();
    //     $lichHoc=clone $thoiKhoaBieu;
    //     $lichHoc=$lichHoc->where('id_phong_hoc',$p->id_phong_hoc)->get();
    //     //dd($lichHoc);
    //     foreach($lichHoc as $lich){
    //     $tietBatDau=ThoiGianBieu::where('id',$lich->id_tiet_bat_dau)->where('trang_thai',1)->first();
    //     $tietKetThuc=ThoiGianBieu::where('id',$lich->id_tiet_ket_thuc)->where('trang_thai',1)->first();
    //     $giangVien1=GiangVien::where('ma_gv',$lich->ma_gv_1)->where('trang_thai',1)->first();
    //     $giangVien2=GiangVien::where('ma_gv',$lich->ma_gv_2)->where('trang_thai',1)->first();
    //     $lichThuocPhong[]=array(
    //             'mon_hoc'=>$lich->ten_mon_hoc,
    //             'giang_vien_1'=>$giangVien1!=null?$giangVien1->ten_giang_vien:"Empty",
    //             'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_giang_vien:"Empty",
    //             'thu_trong_tuan'=>$lich->thu_trong_tuan,
    //             'tiet_bat_dau'=>$tietBatDau->stt,
    //             'thoi_gian_bat_dau'=>$tietBatDau->thoi_gian_bat_dau,
    //             'tiet_ket_thuc'=>$tietKetThuc->stt,
    //             'thoi_gian_ket_thuc'=>$tietKetThuc->thoi_gian_ket_thuc
    //     );
    //     }
    //     $data[]=array(
    //             'id_phong_hoc'=>$p->id_phong_hoc,
    //             'ten_phong_hoc'=>$p->ten_phong_hoc,
    //             'lich'=>$lichThuocPhong
    //     );
    //     }

    //     return $data;

    // }

    public function DanhSachLichDayGiangVien($ma_giang_vien)
    {

        $thoiKhoaBieu= ThoiKhoaBieu::join('lop_hoc_phans','thoi_khoa_bieus.id_lop_hoc_phan','lop_hoc_phans.id')
        // ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
        // ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
        ->join('phongs','phongs.id','thoi_khoa_bieus.id_phong_hoc')
        ->join('lop_hocs','lop_hocs.id','lop_hoc_phans.id_lop_hoc')
        ->where(function($query) use ($ma_giang_vien){
            $query->where('lop_hoc_phans.ma_gv_1',$ma_giang_vien)
            ->orWhere('lop_hoc_phans.ma_gv_2',$ma_giang_vien)
            ->orWhere('lop_hoc_phans.ma_gv_3',$ma_giang_vien)
            ->orWhere('lop_hocs.ma_gv_chu_nhiem',$ma_giang_vien);
        })
        ->where('lop_hoc_phans.trang_thai_hoan_thanh',0)
        ->where('thoi_khoa_bieus.trang_thai',1);

        //return $thoiKhoaBieu->get();
        $phongHoc= clone $thoiKhoaBieu;
        $phongHoc=$phongHoc->select('ten_phong','id_phong_hoc')->distinct()->get();
        //dd($phongHoc);
        $data=array();

        foreach($phongHoc as $p){
        $lichThuocPhong=array();
        $lichHoc=clone $thoiKhoaBieu;
        $lichHoc=$lichHoc->where('id_phong_hoc',$p->id_phong_hoc)->get();
        //dd($lichHoc);
        foreach($lichHoc as $lich){
        $tietBatDau=ThoiGianBieu::where('id',$lich->id_tiet_bat_dau)->where('trang_thai',1)->first();
        $tietKetThuc=ThoiGianBieu::where('id',$lich->id_tiet_ket_thuc)->where('trang_thai',1)->first();
        $giangVien1=GiangVien::where('ma_gv',$lich->ma_gv_1)->where('trang_thai',1)->first();
        $giangVien2=GiangVien::where('ma_gv',$lich->ma_gv_2)->where('trang_thai',1)->first();
        $lophocphan=LopHocPhan::where('id',$lich->id_lop_hoc_phan)->first();
        $lophoc=null;
        if($lich->id_ct_chuong_trinh_dao_tao==null){
            $lophoc=LopHoc::where('id',$lich->id_lop_hoc)->first();
        }
        $lichThuocPhong[]=array(
                'mon_hoc'=>$lophocphan->chiTietChuongTrinhDaoTao!=null?$lophocphan->chiTietChuongTrinhDaoTao->monHoc->ten_mon_hoc:$lich->ten_lop_hoc_phan,
                'giang_vien_1'=>$giangVien1!=null?$giangVien1->ten_giang_vien:"Empty",
                'giang_vien_2'=>$giangVien2!=null?$giangVien2->ten_giang_vien:"Empty",
                'lop_hoc'=>$lophoc!=null?array(
                    'ten_lop_hoc'=>$lophoc->ten_lop_hoc,
                    'giang_vien_chu_nhiem'=>$lophoc->giangVienChuNhiem,
                ):null,
                'thu_trong_tuan'=>$lich->thu_trong_tuan,
                'tiet_bat_dau'=>$tietBatDau->stt,
                'thoi_gian_bat_dau'=>$tietBatDau->thoi_gian_bat_dau,
                'tiet_ket_thuc'=>$tietKetThuc->stt,
                'thoi_gian_ket_thuc'=>$tietKetThuc->thoi_gian_ket_thuc
        );
        }
        $data[]=array(
                'id_phong_hoc'=>$p->id_phong_hoc,
                'ten_phong_hoc'=>$p->ten_phong,
                'lich'=>$lichThuocPhong
        );
        }
        return $data;

    }
}
