<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTQuyetDinh;
use App\Models\QuyetDinh;
use App\Models\SinhVien;
use DataTables;
class CTQuyetDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CTQuyetDinh::leftJoin('quyet_dinhs', 'ct_quyet_dinhs.id_quyet_dinh', '=', 'quyet_dinhs.id')
            ->leftJoin('sinh_viens', 'ct_quyet_dinhs.ma_sv_nhan_quyet_dinh', '=', 'sinh_viens.ma_sv')
            ->select('ct_quyet_dinhs.*', 'quyet_dinhs.noi_dung', 'sinh_viens.ten_sinh_vien')
            ->where('ct_quyet_dinhs.trang_thai', 1)
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
        $quyetdinhs = QuyetDinh::all();
        $sinhviens = SinhVien::all();
        return view('admin.ctquyetdinhs.index', compact('quyetdinhs','sinhviens'));   
    }
    public function getInactiveData()
    {
        $data = CTQuyetDinh::leftJoin('quyet_dinhs', 'ct_quyet_dinhs.id_quyet_dinh', '=', 'quyet_dinhs.id')
            ->leftJoin('sinh_viens', 'ct_quyet_dinhs.ma_sv_nhan_quyet_dinh', '=', 'sinh_viens.ma_sv')
            ->select('ct_quyet_dinhs.*', 'quyet_dinhs.noi_dung', 'sinh_viens.ten_sinh_vien')
            ->where('ct_quyet_dinhs.trang_thai', 0)
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
        CTQuyetDinh::updateOrCreate(['id' => $request->id],
        ['id_quyet_dinh' => $request->id_quyet_dinh,
           'ma_sv_nhan_quyet_dinh' => $request->ma_sv_nhan_quyet_dinh,
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
        $ctquyetdinh = CTQuyetDinh::find($id);
        return response()->json($ctquyetdinh);
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
        CTQuyetDinh::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        CTQuyetDinh::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
}