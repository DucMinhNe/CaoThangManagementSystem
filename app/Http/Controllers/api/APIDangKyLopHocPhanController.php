<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\MoDangKyMon;
use App\Models\MonHoc;
use App\Models\SinhVien;
use App\Models\GiangVien;
use App\Models\LopHocPhan;
use App\Models\LopHoc;
use App\Models\Phong;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\CTLopHocPhan;
use App\Models\DangKyLopHocPhan;

class APIDangKyLopHocPhanController extends Controller
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

    public function themDangKyLopHocPhan(Request $request){
        $tienDong=550000;
        $sinhvien=SinhVien::where('ma_sv',$request->ma_sv)->where('trang_thai',1)->first();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        //dd($currenDateTime);

        $monHocRot=CTChuongTrinhDaoTao::join('lop_hoc_phans','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                      ->join('ct_lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                      ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                                      ->where('ct_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                                      ->where('ct_chuong_trinh_dao_taos.trang_thai',1)
                                      ->orderBy('tong_ket_1','desc')->orderBy('tong_ket_2','desc')
                                    //   ->get();
                                      ->first();

        if($monHocRot!=null&&$monHocRot->tong_ket_2!=null){
            if($monHocRot->tong_ket_2<5){

                $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$request->id_mon_hoc)
                                    ->where('khoa_hoc',$sinhvien->khoa_hoc)
                                    ->where('mo_dang_ky','<',$currenDateTime)
                                    ->where('dong_dang_ky','>',$currenDateTime)
                                    ->where('da_dong','=',0)
                                    ->where('trang_thai',1)
                                    ->first();
                //dd($moDangKyMon);
                if($moDangKyMon!=null){
                    $lopHocPhanDangKy=LopHocPhan::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                                ->where('lop_hoc_phans.id',$request->id_lop_hoc_phan)
                                                ->where('lop_hoc_phans.trang_thai',1)
                                                ->first();

                    if($lopHocPhanDangKy!=null&&$lopHocPhanDangKy->id_mon_hoc==$request->id_mon_hoc){


                        $tienDong=env('TIEN_MON_HOC_LI_THUYET')*$lopHocPhanDangKy->so_tin_chi;
                        //dd($monHoc);
                        DangKyLopHocPhan::create([
                            'id_lop_hoc_phan'=>$request->id_lop_hoc_phan,
                            'ma_sv'=>$sinhvien->ma_sv,
                            'tien_dong'=>$tienDong,
                        ]);
                        return response()->json([
                            'message'=>"Đăng ký lớp học phần thành công"
                        ], 200);
                    }else{
                        return response()->json([
                            'message'=>"Không tìm thấy lớp học phần cần đăng ký"
                        ], 200);
                    }
                }else{
                    return response()->json([
                        'message'=>"Chưa mở đăng ký môn"
                    ], 200);
                }
            }

        }else{
            return response()->json([
                'message'=>"Đăng ký không thành công do không nợ môn"
            ], 200);
        }


    }
    public function layDanhSachLopDangKyCuaSinhVien($ma_sv){
        $sinhvien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $lopDangKy=LopHocPhan::join('dang_ky_lop_hoc_phans','dang_ky_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                             ->where('dang_ky_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                             ->where('mo_dang_ky',1)
                             ->where('trang_thai_hoan_thanh',0)
                             ->where('dang_ky_lop_hoc_phans.trang_thai',1)
                             ->where('duyet',0)
                             ->get();

        //dd($lopDangKy);
        if($lopDangKy!=null){
            $data=array();
            foreach($lopDangKy as $item){
                $lop=LopHoc::where('id',$item->id_lop_hoc)->where('trang_thai',1)->first();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $currenDateTime= date('Y-m-d H:i:s');
                //dd($request->all());

                $khoa_hoc=$sinhvien->khoa_hoc;
                $monHoc=MonHoc::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id_mon_hoc','mon_hocs.id')
                              ->join('lop_hoc_phans','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                              ->where('lop_hoc_phans.id',$item->id_lop_hoc_phan)
                              ->where('mon_hocs.trang_thai',1)
                              ->first();
                //dd($monHoc);
                $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$monHoc->id_mon_hoc)
                ->where('khoa_hoc',$khoa_hoc)
                ->where('mo_dang_ky','<',$currenDateTime)
                ->where('dong_dang_ky','>',$currenDateTime)
                ->where('da_dong',0)
                ->where('trang_thai',1)
                ->first();

                //dd($moDangKyMon);
                $chophepHuyDangKy=false;
                if($moDangKyMon!=null&&$item->da_dong_tien==false){

                    $chophepHuyDangKy=1;
                }
                else{
                    $chophepHuyDangKy=0;
                }
                $monHoc=LopHocPhan::join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                  ->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
                                  ->where('lop_hoc_phans.id',$item->id_lop_hoc_phan)
                                  ->where('lop_hoc_phans.trang_thai',1)
                                  ->first();
                $lichHoc=ThoiKhoaBieu::where('id_lop_hoc_phan',$item->id_lop_hoc_phan)->where('trang_thai',1)->get();
                $giangVien1=GiangVien::where('ma_gv',$item->ma_gv_1)->first();
                $giangVien2=GiangVien::where('ma_gv',$item->ma_gv_2)->first();
                $giangVien3=GiangVien::where('ma_gv',$item->ma_gv_3)->first();
                $arrLichHoc=array();
                foreach($lichHoc as $lich){
                    $phongHoc=Phong::where('id',$lich->id_phong_hoc)->where('trang_thai',1)->first();
                    $tietBatDau=ThoiGianBieu::where('id',$lich->id_tiet_bat_dau)->where('trang_thai',1)->first();
                    $tietKetThuc=ThoiGianBieu::where('id',$lich->id_tiet_ket_thuc)->where('trang_thai',1)->first();
                    $arrLichHoc[]=array(
                        'thu_trong_tuan'=>$lich->thu_trong_tuan,
                        'phong_hoc'=>$phongHoc,
                        'tiet_bat_dau'=>$tietBatDau,
                        'tiet_ket_thuc'=>$tietKetThuc,
                    );
                }
                $data[]=array(
                    'id'=>$item->id,
                    'id_lop_hoc_phan'=>$item->id_lop_hoc_phan,
                    'mon_hoc'=>['id_mon_hoc'=>$monHoc->id_mon_hoc,'ten_mon_hoc'=>$monHoc->ten_mon_hoc],
                    'giang_vien_1'=>$giangVien1,
                    'giang_vien_2'=>$giangVien2,
                    'giang_vien_3'=>$giangVien3,
                    'lop_hoc'=>$lop,
                    'lich'=>$arrLichHoc,
                    'da_dong_tien'=>$item->da_dong_tien,
                    'duyet'=>$item->duyet,
                    'cho_phep_huy_dang_ky'=>$chophepHuyDangKy
                );
            }

            return response()->json([
                'lop_dang_ky'=>$data,
                'status'=>1
            ]);
        }
        else{
            return response()->json([
                'message'=>"Không có lớp đăng ký nào chưa duyệt",
                'status'=>0,
            ]);
        }

    }
    function daCoLopHocPhanCoMonDangKy($id_mon_hoc,$ma_sv){
        $sinhVien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $moDangKyMon=MoDangKyMon::where('id_mon_hoc',$id_mon_hoc)->where('khoa_hoc',$sinhVien->khoa_hoc)->where('trang_thai',1)->first();

        $dangKyLopHocPhan=DangKyLopHocPhan::join('lop_hoc_phans','lop_hoc_phans.id','dang_ky_lop_hoc_phans.id_lop_hoc_phan')
                                          ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                          //->join('mon_hocs','mon_hocs.id','ct_chuong_trinh_dao_taos.id_mon_hoc')
                                          ->where('dang_ky_lop_hoc_phans.ma_sv',$ma_sv)
                                          ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$id_mon_hoc)
                                          ->where('dang_ky_lop_hoc_phans.created_at','>',$moDangKyMon->mo_dang_ky)
                                          ->where('dang_ky_lop_hoc_phans.created_at','<',$moDangKyMon->dong_dang_ky)
                                          ->where('dang_ky_lop_hoc_phans.trang_thai',1)
                                          ->get();
        if($dangKyLopHocPhan->count()>0){
            return false;
        }
        return true;

    }
    function kiemTraLopHocPhanCoMonDangKy(Request $request){
        if($this->daCoLopHocPhanCoMonDangKy($request->id_mon_hoc,$request->ma_sv)){
            return response()->json([
                'message'=>'Chưa có lớp học phần có môn đăng ký',
                'status'=>1,
            ]);
        }
        return response()->json([
            'message'=>'Đã có lớp học phần có môn đăng ký',
            'status'=>0,
        ]);

    }
    function huyDangKyLopHocPhan(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        //dd($request->all());
        $sinhvien=SinhVien::where('ma_sv',$request->ma_sv)->where('trang_thai',1)->first();
        //dd($sinhvien);
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
            $dangKyLopHocPhan=DangKyLopHocPhan::where('id',$request->id_dang_ky)->where('trang_thai',1)->first();
            //dd($dangKyLopHocPhan);
            $dangKyLopHocPhan->update(['trang_thai'=>0]);
            $dangKyLopHocPhan->save();
            return response()->json([
                'message'=>'Đã hủy đăng ký lớp học phần',
                'status'=>1
            ]);
        }
        else{
            return response()->json([
                'message'=>"Lỗi",
                'status'=>0,
            ]);
        }
    }
}
