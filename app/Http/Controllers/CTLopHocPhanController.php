<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTLopHocPhan;
use App\Models\LopHocPhan;
use App\Models\SinhVien;
use DataTables;
class CTLopHocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CTLopHocPhan::leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('sinh_viens', 'ct_lop_hoc_phans.ma_sv', '=', 'sinh_viens.ma_sv')
            ->select('ct_lop_hoc_phans.*', 'lop_hoc_phans.ten_lop_hoc_phan', 'sinh_viens.ten_sinh_vien')
            ->where('ct_lop_hoc_phans.trang_thai', 1)
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
        $lophocphans = LopHocPhan::all();
        $sinhviens = SinhVien::all();
        return view('admin.ctlophocphans.index', compact('lophocphans','sinhviens'));   
    }
    public function getInactiveData()
    {
        $data = CTLopHocPhan::leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
        ->leftJoin('sinh_viens', 'ct_lop_hoc_phans.ma_sv', '=', 'sinh_viens.ma_sv')
        ->select('ct_lop_hoc_phans.*', 'lop_hoc_phans.ten_lop_hoc_phan', 'sinh_viens.ten_sinh_vien')
        ->where('ct_lop_hoc_phans.trang_thai', 0)
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
        CTLopHocPhan::updateOrCreate(['id' => $request->id],
        ['id_lop_hoc_phan' => $request->id_lop_hoc_phan,
           'ma_sv' => $request->ma_sv,
           'chuyen_can' => $request->chuyen_can,
           'tbkt' => $request->tbkt,
           'thi_1' => $request->thi_1,
           'thi_2' => $request->thi_2,
           'tong_ket_1' => $request->tong_ket_1,
           'tong_ket_2' => $request->tong_ket_2,
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
        $ctlophocphan = CTLopHocPhan::find($id);
        return response()->json($ctlophocphan);
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
        CTLopHocPhan::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        CTLopHocPhan::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
}