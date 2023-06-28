<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CTLopHocPhan;
use App\Models\LopHocPhan;
use App\Models\SinhVien;

use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\GiangVien;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LoaiMonHoc;

use DataTables;
class NhapDiemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $selectedLopHocPhanId = $request->input('id_lop_hoc_phan');
    
            $data = CTLopHocPhan::leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
                ->leftJoin('sinh_viens', 'ct_lop_hoc_phans.ma_sv', '=', 'sinh_viens.ma_sv')
                ->select('ct_lop_hoc_phans.*', 'lop_hoc_phans.ten_lop_hoc_phan', 'sinh_viens.ten_sinh_vien')
                ->where('ct_lop_hoc_phans.trang_thai', 1)
                ->where('ct_lop_hoc_phans.id_lop_hoc_phan', $selectedLopHocPhanId)
                ->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    
        $giangVien = Auth::user();
        $lophocphans = LopHocPhan::where('ma_gv_1', $giangVien->ma_gv)
            ->orWhere('ma_gv_2', $giangVien->ma_gv)
            ->orWhere('ma_gv_3', $giangVien->ma_gv)
            ->get();
        $sinhviens = SinhVien::all();
    
        return view('admin.nhapdiems.index', compact('lophocphans', 'sinhviens'));
    }
    
    public function getThongTinLopHocPhan(Request $request)
{
    $idLopHocPhan = $request->input('id_lop_hoc_phan');
    
    try {
        // Lấy thông tin lớp học phần
        $lopHocPhan = LopHocPhan::find($idLopHocPhan);
        
        if (!$lopHocPhan) {
            return response()->json(['error' => 'Lớp học phần không tồn tại'], 404);
        }
        
        // Lấy thông tin lớp học
        $lopHoc = LopHoc::find($lopHocPhan->id_lop_hoc);
        
        if (!$lopHoc) {
            return response()->json(['error' => 'Lớp học không tồn tại'], 404);
        }
        
        // Lấy thông tin chương trình đào tạo
        $ctDaoTao = CTChuongTrinhDaoTao::find($lopHocPhan->id_ct_chuong_trinh_dao_tao);
        
        if (!$ctDaoTao) {
            return response()->json(['error' => 'Chương trình đào tạo không tồn tại'], 404);
        }
        
        // Lấy thông tin môn học
        $monHoc = MonHoc::find($ctDaoTao->id_mon_hoc);
        
        if (!$monHoc) {
            return response()->json(['error' => 'Môn học không tồn tại'], 404);
        }
        
        // Lấy thông tin giảng viên 1
        $giangVien1 = GiangVien::find($lopHocPhan->ma_gv_1);
        
        // Lấy thông tin giảng viên 2
        $giangVien2 = GiangVien::find($lopHocPhan->ma_gv_2);
        
        // Lấy thông tin giảng viên 3
        $giangVien3 = GiangVien::find($lopHocPhan->ma_gv_3);
        
        // Lấy thông tin chương trình đào tạo
        $chuongTrinhDaoTao = ChuongTrinhDaoTao::find($ctDaoTao->id_chuong_trinh_dao_tao);
        
        if (!$chuongTrinhDaoTao) {
            return response()->json(['error' => 'Chương trình đào tạo không tồn tại'], 404);
        }
        
        // Lấy thông tin loại môn học
        $loaiMonHoc = LoaiMonHoc::find($monHoc->id_loai_mon_hoc);
        
        if (!$loaiMonHoc) {
            return response()->json(['error' => 'Loại môn học không tồn tại'], 404);
        }
        
        $thongTin = [
            'ten_lop_hoc' => $lopHoc->ten_lop_hoc,
            'ten_mon_hoc' => $monHoc->ten_mon_hoc,
            'ten_gv_1' => $giangVien1 ? $giangVien1->ten_giang_vien : '',
            'ten_gv_2' => $giangVien2 ? $giangVien2->ten_giang_vien : '',
            'ten_gv_3' => $giangVien3 ? $giangVien3->ten_giang_vien : '',
            'hoc_ky' => $ctDaoTao->hoc_ky,
            'so_tin_chi' => $ctDaoTao->so_tin_chi,
            'so_tiet' => $ctDaoTao->so_tiet,
            'ten_loai_mon_hoc' => $loaiMonHoc->ten_loai_mon_hoc,
        ];

        return response()->json($thongTin);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
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
        if ($request->ajax()) {
            $input = $request->all();
            $id = $input['id'];
            $column = $input['column'];
            $value = ($input['value'] === 'null') ? null : $input['value'];
            $lopHocPhan = CTLopHocPhan::updateOrCreate(['id' => $id], [$column => $value]);
            return response()->json(['success' => 'Lưu thành công.']);
        }
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