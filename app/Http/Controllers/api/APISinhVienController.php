<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Khoa;
use App\Models\ChuyenNganh;
use App\Models\LopHocPhan;
use App\Models\MonHoc;
use App\Models\CTLopHocPhan;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHoc;

class APISinhVienController extends Controller
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
    public function show($ma_sv)
    {
        $sinhvien= SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $lopHoc=LopHoc::where('id',$sinhvien->id_lop_hoc)->where('trang_thai',1)->first();
        $chuyen_nganh=ChuyenNganh::where('id',$lopHoc->id_chuyen_nganh)->where('trang_thai',1)->first();
        $khoa_nganh=Khoa::where('id',$chuyen_nganh->id_khoa)->where('trang_thai',1)->first();
        return response()->json([
            'ma_sv'=>$sinhvien->ma_sv,
            'ten_sinh_vien'=>$sinhvien->ten_sinh_vien,
            'ngay_sinh'=>$sinhvien->ngay_sinh,
            'noi_sinh'=>$sinhvien->noi_sinh,
            'gioi_tinh'=>$sinhvien->gioi_tinh,
            'dan_toc'=>$sinhvien->dan_toc,
            'ton_giao'=>$sinhvien->ton_giao,
            'so_cmt'=>$sinhvien->so_cmt,
            'email'=>$sinhvien->email,
            'hinh_anh_dai_dien'=>$sinhvien->hinh_anh_dai_dien,
            'so_dien_thoai'=>$sinhvien->so_dien_thoai,
            'dia_chi_thuong_tru'=>$sinhvien->dia_chi_thuong_tru,
            'dia_chi_tam_tru'=>$sinhvien->dia_chi_tam_tru,
            'quoc_gia'=>$sinhvien->quoc_gia,
            'bac_dao_tao'=>$sinhvien->bac_dao_tao,
            'he_dao_tao'=>$sinhvien->he_dao_tao,
            'nien_khoa'=>$sinhvien->khoa_hoc.' - '.$sinhvien->khoa_hoc+3,
            'khoa_hoc'=>$sinhvien->khoa_hoc,
            'chuyen_nganh'=>$chuyen_nganh,
            'khoa_nganh'=>$khoa_nganh,
            'lop_hoc'=>$lopHoc,
            'tinh_trang_hoc'=>$sinhvien->tinh_trang_hoc,
        ]
        );
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
    public function layBangDiemCuaSinhVien($ma_sv){
        $sinhvien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $lopHoc=LopHoc::join('chuyen_nganhs','chuyen_nganhs.id','lop_hocs.id_chuyen_nganh')
                      ->where('lop_hocs.id',$sinhvien->id_lop_hoc)
                      ->where('lop_hocs.trang_thai',1)
                      ->first();
        $chuongTrinhDaoTao=ChuongTrinhDaoTao::where('id_chuyen_nganh',$lopHoc->id_chuyen_nganh)->where('khoa_hoc',$sinhvien->khoa_hoc)->where('trang_thai',1)->first();
        $ctChuongTrinhDaoTaos=CtChuongTrinhDaoTao::where('id_chuong_trinh_dao_tao',$chuongTrinhDaoTao->id)->where('trang_thai',1)->get();
        $danhsachLopHocPhan=CTLopHocPhan::where('ma_sv',$id)->where('trang_thai',1)->first()->get();

        $data=array();
        foreach ($ctChuongTrinhDaoTaos as $item) {
            $monHoc=MonHoc::find($item->id_mon_hoc);
            $chiTietLopHocPhans=CTLopHocPhan::join('lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                                    ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                                    ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$monHoc->id)
                                                    ->where('ct_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                                                    ->where('ct_lop_hoc_phans.trang_thai',1)
                                                    ->get();

            if($chiTietLopHocPhans->count()>1){
                $temp=$chiTietLopHocPhans->orderBy('tong_ket_1')->orderBy('tong_ket_2')->first();
                dd($temp);
                $data[]=array(
                    'ten_mon_hoc'=>$monHoc->ten_mon_hoc,
                    'hoc_ky'=>$item->hoc_ky,
                    'diem'=>$temp->tong_ket_1!=null?
                  				$temp->tong_ket_2!=null?
                  					$temp->tong_ket_1>$temp->tong_ket_2?
                  						$temp->tong_ket_1:$temp->tong_ket_2
                  				:$temp->tong_ket_1
                  				:-1
                );
            }else{
                if($chiTietLopHocPhans->count()==0){
                    $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten,
                        'hoc_ky'=>$item->hocki,
                        'diem'=>-1

                    );
                }else{
                    //dd($chiTietLopHocPhans->first()->tong_ket_1);
                    $data[]=array(
                    'ten_mon_hoc'=>$monHoc->ten_mon_hoc,
                    'hoc_ky'=>$item->hoc_ky,
                    'diem'=>$chiTietLopHocPhans->first()->tong_ket_1!=null?
                  				$chiTietLopHocPhans->first()->tong_ket_2!=null?
                  					$chiTietLopHocPhans->first()->tong_ket_1 > $chiTietLopHocPhans->first()->tong_ket_2?
                  						$chiTietLopHocPhans->first()->tong_ket_1:$chiTietLopHocPhans->first()->tong_ket_2
                  				:$chiTietLopHocPhans->first()->tong_ket_1
                  				:-1
                      //$chiTietLopHocPhans->first()->tong_ket_1!=null?$chiTietLopHocPhans->first()->tong_ket_1:-1,
                    );
                }

            }
            // $lopHocPhan=LopHocPhan::find($item->id_lop_hoc_phan);
            // $ctChuongTrinhDaoTao=CtChuongTrinhDaoTao::find($lopHocPhan->id_ct_chuong_trinh_dao_tao);
            // $monHoc=MonHoc::find($ctChuongTrinhDaoTao->id_mon_hoc);
            // $data[]=array(
            //     'ten_mon_hoc'=>$monHoc->ten,
            //     'diem'=>$item->tong_ket_1!=null?$item->tong_ket_1:$item->tong_ket_2
            // );
        }
        //$json=json_encode($data);
        return $data;
    }
    public function layBangDiemCuaSinhVienTheoHocKy($ma_sv,$hocky){
        $sinhvien=SinhVien::where('ma_sv',$ma_sv)->where('trang_thai',1)->first();
        $lopHoc=LopHoc::join('chuyen_nganhs','chuyen_nganhs.id','lop_hocs.id_chuyen_nganh')
                      ->join('khoas','khoas.id','chuyen_nganhs.id_khoa')
                      ->where('lop_hocs.id',$sinhvien->id_lop_hoc)
                      ->where('lop_hocs.trang_thai',1)
                      ->first();
        $chuongTrinhDaoTao=ChuongTrinhDaoTao::where('id_chuyen_nganh',$lopHoc->id_chuyen_nganh)->where('khoa_hoc',$sinhvien->khoa_hoc)->where('trang_thai',1)->first();
        $ctChuongTrinhDaoTaos=CtChuongTrinhDaoTao::where('id_chuong_trinh_dao_tao',$chuongTrinhDaoTao->id)->where('hoc_ky',$hocky)->where('trang_thai',1)->get();

        $data=array();
        if($ctChuongTrinhDaoTaos->count()>0){
            foreach ($ctChuongTrinhDaoTaos as $item) {
                $monHoc=MonHoc::where('id',$item->id_mon_hoc)->where('trang_thai',1)->first();
                $chiTietLopHocPhans=CTLopHocPhan::join('lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                                        ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                                        ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$monHoc->id)
                                                        ->where('ct_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                                                        ->where('ct_lop_hoc_phans.trang_thai',1)
                                                        ->get();
                if($chiTietLopHocPhans->count()>1){
                    $temp=CTLopHocPhan::join('lop_hoc_phans','ct_lop_hoc_phans.id_lop_hoc_phan','lop_hoc_phans.id')
                                            ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                                            ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$monHoc->id)
                                            ->where('ct_lop_hoc_phans.ma_sv',$sinhvien->ma_sv)
                                            ->where('ct_lop_hoc_phans.trang_thai',1)
                                            // ->whereNotNull('chi_tiet_lop_hoc_phans.tong_ket_1')->whereNotNull('chi_tiet_lop_hoc_phans.tong_ket_2')
                                            ->orderBy('tong_ket_1','desc')->orderBy('tong_ket_2','desc')->first();
                    //$temp=$chiTietLopHocPhans->orderBy('tong_ket_1')->orderBy('tong_ket_2')->first();
                    //dd($temp);
                    $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten_mon_hoc,
                        'hoc_ky'=>$item->hoc_ky,
                        'diem'=>$temp->tong_ket_1!=null?
                  				$temp->tong_ket_2!=null?
                  					$temp->tong_ket_1>$temp->tong_ket_2?
                  						$temp->tong_ket_1:$temp->tong_ket_2
                  				:$temp->tong_ket_1
                  				:-1
                    );
                }else{
                    if($chiTietLopHocPhans->count()==0){
                        $data[]=array(
                            'ten_mon_hoc'=>$monHoc->ten_mon_hoc,
                            'hoc_ky'=>$item->hoc_ky,
                            'diem'=>-1

                        );
                    }else{
                        //dd($chiTietLopHocPhans->first()->tong_ket_1);
                        $data[]=array(
                        'ten_mon_hoc'=>$monHoc->ten_mon_hoc,
                        'hoc_ky'=>$item->hoc_ky,
                        'diem'=>$chiTietLopHocPhans->first()->tong_ket_1!=null?
                  				$chiTietLopHocPhans->first()->tong_ket_2!=null?
                  					$chiTietLopHocPhans->first()->tong_ket_1 > $chiTietLopHocPhans->first()->tong_ket_2?
                  						$chiTietLopHocPhans->first()->tong_ket_1:$chiTietLopHocPhans->first()->tong_ket_2
                  				:$chiTietLopHocPhans->first()->tong_ket_1
                  				:-1,
                        );
                    }

                }
                // $lopHocPhan=LopHocPhan::find($item->id_lop_hoc_phan);
                // $ctChuongTrinhDaoTao=CtChuongTrinhDaoTao::find($lopHocPhan->id_ct_chuong_trinh_dao_tao);
                // $monHoc=MonHoc::find($ctChuongTrinhDaoTao->id_mon_hoc);
                // $data[]=array(
                //     'ten_mon_hoc'=>$monHoc->ten,
                //     'diem'=>$item->tong_ket_1!=null?$item->tong_ket_1:$item->tong_ket_2
                // );
            }
            //$json=json_encode($data);
            return $data;
        }
        return response()->json(
            [
                'message'=>"Not Found",
            ]
            , 404);

    }
    public function doiMatKhau($ma_sv,Request $request){
        $sinhvien=SinhVien::find($ma_sv);
        if(Hash::check($request->mat_khau_cu,$sinhvien->mat_khau)){
            $sinhvien->update([
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
        ],201);
    }
}
