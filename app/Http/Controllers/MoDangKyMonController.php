<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\MoDangKyMon;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChuyenNganh;
use DataTables;
class MoDangKyMonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MoDangKyMon::join('mon_hocs','mo_dang_ky_mons.id_mon_hoc','mon_hocs.id')

            ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id_mon_hoc','mon_hocs.id')

            ->join('chuong_trinh_dao_taos',function($join){
                $join->on('chuong_trinh_dao_taos.id','ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao');
                $join->on('chuong_trinh_dao_taos.khoa_hoc','mo_dang_ky_mons.khoa_hoc');
            })
            ->select('mo_dang_ky_mons.*','mon_hocs.ten_mon_hoc','chuong_trinh_dao_taos.id_chuyen_nganh')
            ->where('mo_dang_ky_mons.trang_thai', 1)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-khoa-hoc="'.$row->khoa_hoc.'" data-id-chuyen-nganh="'.$row->id_chuyen_nganh.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';
                        if($row->da_dong==0){
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Close" class="btn btn-danger btn-sm closeBtn">Đóng</a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $monhocs=MonHoc::where('trang_thai',1)->get();
        $khoahocs=ChuongTrinhDaoTao::select('khoa_hoc')->where('trang_thai',1)->distinct()->get();
        $chuyennganhs=ChuyenNganh::where('trang_thai',1)->get();
        return view('admin.modangkymons.index',compact('khoahocs','chuyennganhs','monhocs'));
    }
    public function getInactiveData()
    {
        $data = MoDangKyMon::join('mon_hocs','mo_dang_ky_mons.id_mon_hoc','mon_hocs.id')
        ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id_mon_hoc','mon_hocs.id')
        ->join('chuong_trinh_dao_taos','chuong_trinh_dao_taos.id','ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao')
        ->select('mo_dang_ky_mons.*','mon_hocs.ten_mon_hoc','chuong_trinh_dao_taos.khoa_hoc')
        ->where('mo_dang_ky_mons.trang_thai', 0)->latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-khoa-hoc="'.$row->khoa_hoc.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Restore" class="restore btn btn-success btn-sm restoreBtn">Khôi phục</a>';

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
        MoDangKyMon::updateOrCreate(
            ['id' => $request->id],
            [
                'id_mon_hoc' => $request->id_mon_hoc,
                'khoa_hoc'=>$request->khoa_hoc,
                'mo_dang_ky'=>$request->mo_dang_ky,
                'dong_dang_ky'=>$request->dong_dang_ky,
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
        $mondangkymon = MoDangKyMon::find($id);
        return response()->json($mondangkymon);
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
        MoDangKyMon::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        MoDangKyMon::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
    public function moDangKyMon(Request $request){
        //dd($request->danh_sach_mon_hoc[5]['da_dong']);
        foreach ($request->danh_sach_mon_hoc as $monhoc) {
            MoDangKyMon::updateOrCreate(
                [
                    'khoa_hoc'=>$request->khoa_hoc,
                    'id_mon_hoc'=>$monhoc['id_mon_hoc']
                ],
                [
                    'mo_dang_ky'=>$monhoc['ngay_bat_dau'],
                    'dong_dang_ky'=>$monhoc['ngay_ket_thuc'],
                    'da_dong'=>$monhoc['da_dong'],
                ]
            );
        }
        return response()->json([
            'message'=>"Lưu thành công",
            'status'=>1,
        ],201);
    }
    public function close($id){
        MoDangKyMon::where('id',$id)->update(['da_dong'=>1]);
        return response()->json(['success' => 'Đóng Thành Công.']);
    }
    public function danhSachMonHocMoDangKyMon(Request $request){
        $chuongtrinhdaotao=ChuongTrinhDaoTao::where('khoa_hoc',$request->khoa_hoc)->where('id_chuyen_nganh',$request->id_chuyen_nganh)->where('trang_thai',1)->first();
        //dd($chuongtrinhdaotao->ctChuongTrinhDaoTao);
        $data=array();
        foreach ($chuongtrinhdaotao->ctChuongTrinhDaoTao as $ctchuongtrinhdaotao) {
           $modangkymon=MoDangKyMon::where('khoa_hoc',$request->khoa_hoc)->where('id_mon_hoc',$ctchuongtrinhdaotao->id_mon_hoc)->where('trang_thai',1)->first();

           if($modangkymon!=null){
                $data[]=array(
                    'mon_hoc'=>$ctchuongtrinhdaotao->monHoc,
                    'mo_dang_ky'=>$modangkymon->mo_dang_ky,
                    'dong_dang_ky'=>$modangkymon->dong_dang_ky,
                    'da_dong'=>$modangkymon->da_dong,
                );
           }
           else{
                $data[]=array(
                    'mon_hoc'=>$ctchuongtrinhdaotao->monHoc,
                    'mo_dang_ky'=>null,
                    'dong_dang_ky'=>null,
                    'da_dong'=>1,
                );
           }
        }
        return $data;

    }
}
