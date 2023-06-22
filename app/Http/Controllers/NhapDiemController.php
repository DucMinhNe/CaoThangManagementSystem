<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CTLopHocPhan;
use App\Models\LopHocPhan;
use App\Models\SinhVien;

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