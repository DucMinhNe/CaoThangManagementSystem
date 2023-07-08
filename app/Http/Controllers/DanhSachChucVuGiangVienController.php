<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhSachChucVuGiangVien;
use App\Models\GiangVien;
use App\Models\ChucVuGiangVien;
use DataTables;
class DanhSachChucVuGiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DanhSachChucVuGiangVien::leftJoin('giang_viens', 'danh_sach_chuc_vu_giang_viens.ma_gv', '=', 'giang_viens.ma_gv')
            ->leftJoin('chuc_vu_giang_viens', 'danh_sach_chuc_vu_giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
            ->select('danh_sach_chuc_vu_giang_viens.*', 'giang_viens.ten_giang_vien', 'chuc_vu_giang_viens.ten_chuc_vu')
            ->where('danh_sach_chuc_vu_giang_viens.trang_thai', 1)
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
        $giangviens = GiangVien::all();
        $chucvus = ChucVuGiangVien::all();
        return view('admin.danhsachchucvugiangviens.index', compact('giangviens','chucvus'));   
    }
    public function getInactiveData()
    {
        $data = DanhSachChucVuGiangVien::leftJoin('giang_viens', 'danh_sach_chuc_vu_giang_viens.ma_gv', '=', 'giang_viens.ma_gv')
        ->leftJoin('chuc_vu_giang_viens', 'danh_sach_chuc_vu_giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
        ->select('danh_sach_chuc_vu_giang_viens.*', 'giang_viens.ten_giang_vien', 'chuc_vu_giang_viens.ten_chuc_vu')
        ->where('danh_sach_chuc_vu_giang_viens.trang_thai', 0)
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
            'ma_gv' => 'required',
            'id_chuc_vu' => 'required',
        ]);
        DanhSachChucVuGiangVien::updateOrCreate(['id' => $request->id],
        ['ma_gv' => $request->ma_gv,
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
        $danhsachchucvugiangvien = DanhSachChucVuGiangVien::find($id);
        return response()->json($danhsachchucvugiangvien);
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
        DanhSachChucVuGiangVien::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        DanhSachChucVuGiangVien::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
}