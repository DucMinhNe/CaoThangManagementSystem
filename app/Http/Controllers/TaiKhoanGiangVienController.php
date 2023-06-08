<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoanGiangVien;
use App\Models\GiangVien;
use DataTables;
class TaiKhoanGiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TaiKhoanGiangVien::leftJoin('giang_viens', 'tai_khoan_giang_viens.ma_gv', '=', 'giang_viens.ma_gv')
            ->select('tai_khoan_giang_viens.*', 'giang_viens.ten_giang_vien')
            ->where('tai_khoan_giang_viens.trang_thai', 1)
            ->latest()
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Xóa</a>';
        
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $giangviens = GiangVien::all();
    
        return view('admin.taikhoangiangviens.index', compact('giangviens'));    
    }
    public function getInactiveData()
    { $data = TaiKhoanGiangVien::leftJoin('giang_viens', 'tai_khoan_giang_viens.ma_gv', '=', 'giang_viens.ma_gv')
        ->select('tai_khoan_giang_viens.*', 'giang_viens.ten_giang_vien')
        ->where('tai_khoan_giang_viens.trang_thai', 0)
        ->latest()
        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';
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
        TaiKhoanGiangVien::updateOrCreate(['id' => $request->id],[
            'tai_khoan' => $request->tai_khoan,
            'mat_khau' => bcrypt($request->mat_khau),
            'ma_gv' => $request->ma_gv,
        ]);
       return response()->json(['success'=>'Lưu Thành Công.']);
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
        $taikhoangiangvien = TaiKhoanGiangVien::find($id);
        return response()->json($taikhoangiangvien);
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
        TaiKhoanGiangVien::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        TaiKhoanGiangVien::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi Phục Thành Công.']);
    }
}
