<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\BoMon;
use App\Models\LoaiMonHoc;
use DataTables;
class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = MonHoc::leftJoin('bo_mons', 'mon_hocs.id_bo_mon', '=', 'bo_mons.id')
            ->leftJoin('loai_mon_hocs', 'mon_hocs.id_loai_mon_hoc', '=', 'loai_mon_hocs.id')
            ->select('mon_hocs.*', 'bo_mons.ten_bo_mon', 'loai_mon_hocs.ten_loai_mon_hoc')
            ->where('mon_hocs.trang_thai', 1)
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
        $bomons = BoMon::all();
        $loaimonhocs = LoaiMonHoc::all();
        return view('admin.monhocs.index', compact('bomons','loaimonhocs'));    
    }
    public function getInactiveData()
    {
        $data = MonHoc::leftJoin('bo_mons', 'mon_hocs.id_bo_mon', '=', 'bo_mons.id')
        ->leftJoin('loai_mon_hocs', 'mon_hocs.id_loai_mon_hoc', '=', 'loai_mon_hocs.id')
        ->select('mon_hocs.*', 'bo_mons.ten_bo_mon', 'loai_mon_hocs.ten_loai_mon_hoc')
        ->where('mon_hocs.trang_thai', 0)
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
        MonHoc::updateOrCreate(['id' => $request->id],
        ['ten_mon_hoc' => $request->ten_mon_hoc,
           'id_bo_mon' => $request->id_bo_mon,
         'id_loai_mon_hoc' => $request->id_loai_mon_hoc
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
        $monhoc = MonHoc::find($id);
        return response()->json($monhoc);
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
        MonHoc::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        MonHoc::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
}
