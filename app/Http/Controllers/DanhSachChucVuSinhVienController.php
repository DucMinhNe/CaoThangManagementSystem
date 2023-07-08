<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhSachChucVuSinhVien;
use App\Models\SinhVien;
use App\Models\ChucVuSinhVien;
use App\Models\LopHoc;
use DataTables;
class DanhSachChucVuSinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DanhSachChucVuSinhVien::leftJoin('sinh_viens', 'danh_sach_chuc_vu_sinh_viens.ma_sv', '=', 'sinh_viens.ma_sv')
            ->leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
            ->leftJoin('chuc_vu_sinh_viens', 'danh_sach_chuc_vu_sinh_viens.id_chuc_vu', '=', 'chuc_vu_sinh_viens.id')
            ->select('danh_sach_chuc_vu_sinh_viens.*', 'sinh_viens.ten_sinh_vien', 'chuc_vu_sinh_viens.ten_chuc_vu', 'lop_hocs.ten_lop_hoc')
            ->where('danh_sach_chuc_vu_sinh_viens.trang_thai', 1)
            ->latest()
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
        $sinhviens = SinhVien::all();
        $chucvus = ChucVuSinhVien::all();
        return view('admin.danhsachchucvusinhviens.index', compact('sinhviens','chucvus','lophocs'));   
    }
    public function getInactiveData()
    {
        $data = DanhSachChucVuSinhVien::leftJoin('sinh_viens', 'danh_sach_chuc_vu_sinh_viens.ma_sv', '=', 'sinh_viens.ma_sv')
        ->leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('chuc_vu_sinh_viens', 'danh_sach_chuc_vu_sinh_viens.id_chuc_vu', '=', 'chuc_vu_sinh_viens.id')
        ->select('danh_sach_chuc_vu_sinh_viens.*', 'sinh_viens.ten_sinh_vien', 'chuc_vu_sinh_viens.ten_chuc_vu', 'lop_hocs.ten_lop_hoc')
        ->where('danh_sach_chuc_vu_sinh_viens.trang_thai', 0)
        ->latest()
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
        $request->validate([
            'ma_sv' => 'required',
            'id_chuc_vu' => 'required',
        ]);
        DanhSachChucVuSinhVien::updateOrCreate(['id' => $request->id],
        ['ma_sv' => $request->ma_sv,
           'id_chuc_vu' => $request->id_chuc_vu,
        ],
        );        
        return response()->json(['success'=>'Lưu  Thành Công.']);
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
        $danhsachchucvusinhvien = DanhSachChucVuSinhVien::find($id);
        return response()->json($danhsachchucvusinhvien);
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
        DanhSachChucVuSinhVien::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        DanhSachChucVuSinhVien::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
}