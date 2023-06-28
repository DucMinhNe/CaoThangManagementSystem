<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHocPhan;
use App\Models\CTLopHocPhan;
use App\Models\LopHoc;
use App\Models\GiangVien;
use App\Models\SinhVien;
use App\Models\CTChuongTrinhDaoTao;
use DataTables;
class LopHocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LopHocPhan::leftJoin('lop_hocs', 'lop_hoc_phans.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('giang_viens as gv1', 'lop_hoc_phans.ma_gv_1', '=', 'gv1.ma_gv')
        ->leftJoin('giang_viens as gv2', 'lop_hoc_phans.ma_gv_2', '=', 'gv2.ma_gv')
        ->leftJoin('giang_viens as gv3', 'lop_hoc_phans.ma_gv_3', '=', 'gv3.ma_gv')
        ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
        ->leftJoin('chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao', '=', 'chuong_trinh_dao_taos.id')
        ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
        ->select('lop_hoc_phans.*', 'lop_hocs.ten_lop_hoc', 'gv1.ten_giang_vien as ten_gv_1', 'gv2.ten_giang_vien as ten_gv_2', 'gv3.ten_giang_vien as ten_gv_3', 'ct_chuong_trinh_dao_taos.hoc_ky', 'mon_hocs.ten_mon_hoc')
        ->selectRaw('CONCAT(mon_hocs.ten_mon_hoc, ".", chuong_trinh_dao_taos.khoa_hoc) AS ten_mon_hoc_khoa_hoc')
        ->where('lop_hoc_phans.trang_thai', 1)
        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fa-solid fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $lophocs = LopHoc::all();
        $giangviens = GiangVien::all();
      
        $ctchuongtrinhdaotaos = CTChuongTrinhDaoTao::leftJoin('chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao', '=', 'chuong_trinh_dao_taos.id')
        ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
        ->leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->selectRaw('ct_chuong_trinh_dao_taos.*, CONCAT(chuong_trinh_dao_taos.khoa_hoc, ".", mon_hocs.ten_mon_hoc) AS ten_mon_hoc_khoa_hoc, mon_hocs.ten_mon_hoc')
        ->where('ct_chuong_trinh_dao_taos.trang_thai', 1)
        ->latest()
        ->get();
        $lophocphans = LopHocPhan::all();
    
        return view('admin.lophocphans.index', compact('lophocs', 'giangviens', 'ctchuongtrinhdaotaos','lophocphans'));

    }
    public function getInactiveData()
    {
        $data = LopHocPhan::leftJoin('lop_hocs', 'lop_hoc_phans.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('giang_viens as gv1', 'lop_hoc_phans.ma_gv_1', '=', 'gv1.ma_gv')
        ->leftJoin('giang_viens as gv2', 'lop_hoc_phans.ma_gv_2', '=', 'gv2.ma_gv')
        ->leftJoin('giang_viens as gv3', 'lop_hoc_phans.ma_gv_3', '=', 'gv3.ma_gv')
        ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
        ->leftJoin('chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao', '=', 'chuong_trinh_dao_taos.id')
        ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
        ->select('lop_hoc_phans.*', 'lop_hocs.ten_lop_hoc', 'gv1.ten_giang_vien as ten_gv_1', 'gv2.ten_giang_vien as ten_gv_2', 'gv3.ten_giang_vien as ten_gv_3', 'ct_chuong_trinh_dao_taos.hoc_ky', 'mon_hocs.ten_mon_hoc')
        ->selectRaw('CONCAT(mon_hocs.ten_mon_hoc, ".", chuong_trinh_dao_taos.khoa_hoc) AS ten_mon_hoc_khoa_hoc')
        ->where('lop_hoc_phans.trang_thai', 0)
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Restore" class="restore btn btn-success btn-sm restoreBtn"><i class="fa-solid fa-trash-can-arrow-up"></i></a>';
            
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function themSinhVienVaoLopHocPhan($idLopHoc,$idLopHocPhan)
    {
        $sinhViens = SinhVien::where('id_lop_hoc', $idLopHoc)->get();
        $lopHocPhan = LopHocPhan::find($idLopHocPhan);

        foreach ($sinhViens as $sinhVien) {
        $ctLopHocPhan = new CTLopHocPhan();
        $ctLopHocPhan->id_lop_hoc_phan = $lopHocPhan->id;
        $ctLopHocPhan->ma_sv = $sinhVien->ma_sv;
        $ctLopHocPhan->save();
        }
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
        LopHocPhan::updateOrCreate(['id' => $request->id],
                 ['ten_lop_hoc_phan' => $request->ten_lop_hoc_phan,
                    'id_lop_hoc' => $request->id_lop_hoc,
                    'ma_gv_1' => $request->ma_gv_1,
                    'ma_gv_2' => $request->ma_gv_2,
                    'ma_gv_3' => $request->ma_gv_3,
                    'id_ct_chuong_trinh_dao_tao' => $request->id_ct_chuong_trinh_dao_tao,
                    'mo_dang_ky' => $request->mo_dang_ky,
                    'trang_thai_hoan_thanh' => $request->trang_thai_hoan_thanh,
             ],
        );        
        return response()->json(['success'=>'Lưu Chuyên Ngành Thành Công.']);
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
        $lophocphans = LopHocPhan::find($id);
        return response()->json($lophocphans);
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
        LopHocPhan::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        LopHocPhan::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
}