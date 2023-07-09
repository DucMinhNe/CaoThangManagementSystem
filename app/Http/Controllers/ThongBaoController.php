<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongBao;
use App\Models\ThongBaoCuaSinhVien;
use App\Models\LopHoc;
use App\Models\LopHocPhan;
use App\Models\QuaTrinhHocTap;
use App\Models\SinhVien;
use App\Models\CTLopHocPhan;
use DataTables;

class ThongBaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function danhsachsinhvienlophoc(Request $request)
    {
        $danh_sach_sinh_vien_cua_lop=null;
        if($request->loai_lop_hoc == 1)
        {
            $tontai_thongbao=ThongBao::where('id_lop_hoc',$request->id_lop_hoc)->first();
            if($tontai_thongbao==null)
            {
                $danh_sach_sinh_vien_cua_lop = SinhVien::select('ma_sv')
                                                        ->where('id_lop_hoc',$request->id_lop_hoc)
                                                        ->where('trang_thai',1)->get();
            }
            else
            {
                $danh_sach_sinh_vien_cua_lop = ThongBao::join('thong_bao_cua_sinh_viens','id_thong_bao','=','bang_thong_baos.id')
                                                        ->select('ma_sv')
                                                        ->distinct()
                                                        ->where('id_lop_hoc',$request->id_lop_hoc)
                                                        // ->where('bang_thong_baos.trang_thai',1)
                                                        ->get();
            }
            $danhSachSinhVien=array();


          foreach ($danh_sach_sinh_vien_cua_lop as $sinh_vien) {
            $danhSachSinhVien[] =SinhVien::where('ma_sv',$sinh_vien->ma_sv)->where('trang_thai',1)->first();
          }

          return $danhSachSinhVien;
        }
        else
        {
            $chitietlophocphan = CTLopHocPhan::where('id_lop_hoc_phan',$request->id_lop_hoc)->where('trang_thai',1)->get();
            $arr_sv = array();
            foreach($chitietlophocphan as $sv_lhp)
            {
                $sinhvien = SinhVien::find($sv_lhp->ma_sv);
                $arr_sv[]= $sinhvien;
            }
            return $arr_sv;
        }
    }
    public function xulydangthongbao(Request $request)
    {
        $data = array();

        $id_lop_hoc = $request->id_lop_hoc;
        $ma_giang_vien = auth()->user()->ma_gv;
        $danh_sach_sinh_vien = $request->danh_sach_sinh_vien ;
        $tieu_de = $request->tieu_de;
        $noi_dung = $request->noi_dung;
        $thongbao = null;


        if($request->loai_lop_hoc == 1 )
        {


            $thongbao = ThongBao::updateOrCreate(
            ['id'=>$request->id],
            [

                        'id_lop_hoc'=>$id_lop_hoc,
                        'id_lop_hoc_phan'=>null,
                        'ma_gv'=>$ma_giang_vien,
                        'tieu_de'=>$tieu_de,
                        'noi_dung'=>$noi_dung

            ]
            );

        }
        else
        {

            $thongbao = ThongBao::updateOrCreate(
                ['id'=>$request->id],
                [
                    'id_lop_hoc_phan'=>$id_lop_hoc,
                    'id_lop_hoc'=>null,
                    'ma_gv'=>$ma_giang_vien,
                    'tieu_de'=>$tieu_de,
                    'noi_dung'=>$noi_dung
                ]
                );

        }
       foreach ($danh_sach_sinh_vien as $sinhvien) {
            $data = ThongBaoCuaSinhVien::updateOrCreate(
            [
                'id_thong_bao'=>$thongbao->id,
                 'ma_sv'=>$sinhvien["ma_sinh_vien"]
            ],
            [
                'trang_thai' => $sinhvien['trang_thai']
            ]
            );
       }
       return response()->json([
        'message'=>'Thêm thông báo thành công',
        'status'=> 1 ,

    ],201);
}
public function xulysuaThongBao(Request $request )
{
        $thongBao=ThongBao::where('id',$request->id)->where('trang_thai',1)->first();
        $thongBao_sinhvien = ThongBaoCuaSinhVien::where('id_thong_bao',$request->id)->where('trang_thai',1)->delete();
        foreach ($request->danh_sach_sinh_vien as $sv) {
            ThongBaoCuaSinhVien::updateOrCreate(
                ['id_thong_bao'=> $request->id],
                ['ma_sv'=>$sv->ma_sv]
            );
        }
    if($request->loai_lop_hoc==1)
    {
        $thongBao->update(
            [
                'id_lop_hoc'=> $request->id_lop_hoc,
                'tieu_de'=>$request->tieu_de,
                'noi_dung'=>$request->noi_dung,
            ]
        );
    }
    else
    {
        $thongBao->update(
            [
                'id_lop_hoc_phan'=> $request->id_lop_hoc,
                'tieu_de'=>$request->tieu_de,
                'noi_dung'=>$request->noi_dung,
            ]
        );
    }


    return response()->json([
        'message'=>"Cập nhật thông báo thành công",
        'status'=>1
    ],  201);

}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ThongBao::leftJoin('lop_hocs', 'lop_hocs.id', '=', 'bang_thong_baos.id_lop_hoc')
                            ->leftJoin('lop_hoc_phans', 'lop_hoc_phans.id', '=', 'bang_thong_baos.id_lop_hoc_phan')
                            ->leftJoin('giang_viens', 'giang_viens.ma_gv', '=', 'bang_thong_baos.ma_gv')
                            ->select('bang_thong_baos.*','giang_viens.ten_giang_vien','ten_lop_hoc','ten_lop_hoc_phan',)
                            ->where('bang_thong_baos.trang_thai', 1)->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fa-solid fa-trash"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $lophoc = LopHoc::where('trang_thai',1)->get();
        $lophocphan = LopHocPhan::where('trang_thai',1)->get();
        return view('admin.thongbaos.index',['lop_hoc'=>$lophoc,'lop_hoc_phan'=>$lophocphan]);
    }
    public function getInactiveData()
    {
        $data = ThongBao::leftJoin('lop_hocs', 'lop_hocs.id', '=', 'bang_thong_baos.id_lop_hoc')
        ->leftJoin('lop_hoc_phans', 'lop_hoc_phans.id', '=', 'bang_thong_baos.id_lop_hoc_phan')
        ->leftJoin('giang_viens', 'giang_viens.ma_gv', '=', 'bang_thong_baos.ma_gv')
        ->select('bang_thong_baos.*','giang_viens.ten_giang_vien','ten_lop_hoc','ten_lop_hoc_phan',)
        ->where('bang_thong_baos.trang_thai', 0)->latest()->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Restore" class="restore btn btn-success btn-sm restoreBtn"><i class="fa-solid fa-trash-can-arrow-up"></i></a>';

                return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        ThongBao::updateOrCreate(
            ['id' => $request->id],
            [
                'ten_chuc_vu' => $request->ten_chuc_vu,
            ]
        );
        return response()->json(['success' => 'Lưu Thành Công.']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thongbao = ThongBao::find($id);
        $thongbaocuasinhviens=ThongBaoCuaSinhVien::where('id_thong_bao',$thongbao->id)->where('trang_thai',1)->get();
        return response()->json([
            'thong_bao'=>$thongbao,
            'loai_lop_hoc'=>$thongbao->id_lop_hoc_phan==null?1:2,
            'danh_sach_sinh_vien'=>$thongbaocuasinhviens,
        ]);
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
    // public function destroy($id)
    // {
    //     ChucVuSinhVien::where('id', $id)->update(['trang_thai' => 0]);
    //     return response()->json(['success' => 'Xóa Thành Công.']);
    // }
    public function destroy($id)
    {
        $sinhvien_nhanthongbao =  ThongBaoCuaSinhVien::where('id_thong_bao',$id)
                                                     ->where('trang_thai',1)->get();

        foreach($sinhvien_nhanthongbao as $sv)
        {
            $sv->update(
                [
                    'trang_thai'=>0,
                ]
            ) ;
        }

        $thongBao = ThongBao::where('id',$id)
                            ->where('trang_thai',1)->first();
        $thongBao->update([
            'trang_thai'=>0,
        ]);

        return response()->json(['success' => 'Xóa Thành Công.']);

}
    public function restore($id)
    {
        $sinhvien_nhanthongbao =  ThongBaoCuaSinhVien::where('id_thong_bao',$id)
                                                     ->where('trang_thai',0)->get();

        foreach($sinhvien_nhanthongbao as $sv)
        {
            $sv->update(
                [
                    'trang_thai'=>1,
                ]
            ) ;
        }

        $thongBao = ThongBao::where('id',$id)
                            ->where('trang_thai',0)->first();
        $thongBao->update([
            'trang_thai'=>1,
        ]);

        return response()->json(['success' => 'Khôi phục Thành Công.']);
    }
}
