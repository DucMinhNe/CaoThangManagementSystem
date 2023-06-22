<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\ChuyenNganh;
use App\Models\GiangVien;
use DataTables;
class LopHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LopHoc::leftJoin('giang_viens', 'lop_hocs.ma_gv_chu_nhiem', '=', 'giang_viens.ma_gv')
            ->leftJoin('chuyen_nganhs', 'lop_hocs.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
            ->select('lop_hocs.*', 'giang_viens.ten_giang_vien', 'chuyen_nganhs.ten_chuyen_nganh')
            ->where('lop_hocs.trang_thai', 1)
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
        $chuyennganhs = ChuyenNganh::all();
        return view('admin.lophocs.index', compact('giangviens','chuyennganhs'));   
    }
    public function getInactiveData()
    {
        $data = LopHoc::leftJoin('giang_viens', 'lop_hocs.ma_gv_chu_nhiem', '=', 'giang_viens.ma_gv')
        ->leftJoin('chuyen_nganhs', 'lop_hocs.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->select('lop_hocs.*', 'giang_viens.ten_giang_vien', 'chuyen_nganhs.ten_chuyen_nganh')
        ->where('lop_hocs.trang_thai', 0)
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
        LopHoc::updateOrCreate(['id' => $request->id],
        ['ten_lop_hoc' => $request->ten_lop_hoc,
          'id_chuyen_nganh' => $request->id_chuyen_nganh,
          'ma_gv_chu_nhiem' => $request->ma_gv_chu_nhiem,
        ],
        );        
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
        $lophoc = LopHoc::find($id);
        return response()->json($lophoc);
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
        LopHoc::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        LopHoc::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi Phục Thành Công.']);
    }
}