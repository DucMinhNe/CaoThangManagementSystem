<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Khoa;
use App\Models\ChuyenNganh;
use App\Models\LopHoc;
use App\Models\LopHocPhan;
use App\Models\CtChuongTrinhDaoTao;
use DataTables;
use Illuminate\Support\Facades\DB;
class XetTotNghiepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                 'sinh_viens.ma_sv',
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
            )
            ->where('lop_hoc_phans.id_lop_hoc', 1)
            ->groupBy('sinh_viens.ma_sv', 'sinh_viens.ten_sinh_vien')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_sv.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_sv.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fa-solid fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $khoas = Khoa::all();
        $chuyennganhs = ChuyenNganh::all();
        $lophocs = LopHoc::all();
        return view('admin.xettotnghieps.index', compact('khoas','chuyennganhs','lophocs'));    
    }
    public function getDiemTrungBinhHocKyByLop_xettotnghiep($id_lop_hoc)
    {
            $data = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                 'sinh_viens.ma_sv',
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
            )
            ->where('lop_hoc_phans.id_lop_hoc', $id_lop_hoc)
            ->groupBy('sinh_viens.ma_sv', 'sinh_viens.ten_sinh_vien')
            ->get();
            // return response()->json($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_sv.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_sv.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fa-solid fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function getSinhVienByIdKhoa($id_khoa)
    {
        $data = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
        ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
        ->leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('chuyen_nganhs', 'lop_hocs.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                 'sinh_viens.ma_sv',
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
            )
            ->where('chuyen_nganhs.id_khoa', $id_khoa)
            ->groupBy('sinh_viens.ma_sv', 'sinh_viens.ten_sinh_vien')
            ->get();
            // return response()->json($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
    }   
    public function getSinhVienByIdChuyenNganh($id_chuyen_nganh)
    {
        $data = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
        ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
        ->leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
        ->select(
             'sinh_viens.ma_sv',
            'sinh_viens.ten_sinh_vien',
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
            DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
        )
        ->where('lop_hocs.id_chuyen_nganh', $id_chuyen_nganh)
        ->groupBy('sinh_viens.ma_sv', 'sinh_viens.ten_sinh_vien')
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function getSinhVienByIdLop($id_lop_hoc)
    {
        $data = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                 'sinh_viens.ma_sv',
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
            )
            ->where('lop_hoc_phans.id_lop_hoc', $id_lop_hoc)
            ->groupBy('sinh_viens.ma_sv', 'sinh_viens.ten_sinh_vien')
            ->get();
            // return response()->json($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
    }
    public function getCacLopHocPhanByMaSv($ma_sv,$hoc_ky)
    {
        if($hoc_ky != 0){
        $cacLopHocPhan = LopHocPhan::leftJoin('ct_lop_hoc_phans', 'lop_hoc_phans.id', '=', 'ct_lop_hoc_phans.id_lop_hoc_phan')
        ->leftJoin('ct_chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id', '=', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
        ->where('ct_lop_hoc_phans.ma_sv', $ma_sv)
        ->select(
            'lop_hoc_phans.ten_lop_hoc_phan',
            'ct_chuong_trinh_dao_taos.hoc_ky',
            'ct_lop_hoc_phans.chuyen_can',
            'ct_lop_hoc_phans.tbkt',
            'ct_lop_hoc_phans.thi_1',
            'ct_lop_hoc_phans.thi_2',
            'ct_lop_hoc_phans.tong_ket_1',
            'ct_lop_hoc_phans.tong_ket_2'
        )
        ->where('ct_chuong_trinh_dao_taos.hoc_ky', $hoc_ky)
        ->get();
    }else { $cacLopHocPhan = LopHocPhan::leftJoin('ct_lop_hoc_phans', 'lop_hoc_phans.id', '=', 'ct_lop_hoc_phans.id_lop_hoc_phan')
        ->leftJoin('ct_chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id', '=', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
        ->where('ct_lop_hoc_phans.ma_sv', $ma_sv)
        ->select(
            'lop_hoc_phans.ten_lop_hoc_phan',
            'ct_chuong_trinh_dao_taos.hoc_ky',
            'ct_lop_hoc_phans.chuyen_can',
            'ct_lop_hoc_phans.tbkt',
            'ct_lop_hoc_phans.thi_1',
            'ct_lop_hoc_phans.thi_2',
            'ct_lop_hoc_phans.tong_ket_1',
            'ct_lop_hoc_phans.tong_ket_2'
        )
        ->get();}
    return Datatables::of($cacLopHocPhan)
        ->addIndexColumn()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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