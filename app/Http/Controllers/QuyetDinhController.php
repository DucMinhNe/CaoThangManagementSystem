<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuyetDinh;
use App\Models\GiangVien;
use DataTables;
class QuyetDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QuyetDinh::leftJoin('giang_viens', 'quyet_dinhs.ma_gv_ra_quyet_dinh', '=', 'giang_viens.ma_gv')
                ->select('quyet_dinhs.*', 'giang_viens.ten_giang_vien')
                ->where('quyet_dinhs.trang_thai', 1) // Thêm điều kiện trạng thái bằng 1
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
        return view('admin.quyetdinhs.index', compact('giangviens'));    
    }
    public function getInactiveData()
    {
        $data = QuyetDinh::leftJoin('giang_viens', 'quyet_dinhs.ma_gv_ra_quyet_dinh', '=', 'giang_viens.ma_gv')
        ->select('quyet_dinhs.*', 'giang_viens.ten_giang_vien')
        ->where('quyet_dinhs.trang_thai', 0) // Thêm điều kiện trạng thái bằng 1
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
            'ma_gv_ra_quyet_dinh' => 'required',
            'ngay_ra_quyet_dinh' => 'required',
            'noi_dung' => 'required',
            'hieu_luc_bat_dau' => 'required',
        ]);    
        QuyetDinh::updateOrCreate(['id' => $request->id],
        ['ma_gv_ra_quyet_dinh' => $request->ma_gv_ra_quyet_dinh,
           'ngay_ra_quyet_dinh' => $request->ngay_ra_quyet_dinh,
         'noi_dung' => $request->noi_dung,
         'hieu_luc_bat_dau' => $request->hieu_luc_bat_dau,
         'hieu_luc_ket_thuc' => $request->hieu_luc_ket_thuc,
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
        $quyetdinh = QuyetDinh::find($id);
        return response()->json($quyetdinh);
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
        QuyetDinh::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        QuyetDinh::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi Phục Thành Công.']);
    }
}