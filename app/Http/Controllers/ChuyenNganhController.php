<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuyenNganh;
use App\Models\Khoa;
use DataTables;
class ChuyenNganhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ChuyenNganh::leftJoin('khoas', 'chuyen_nganhs.id_khoa', '=', 'khoas.id')
                ->select('chuyen_nganhs.*', 'khoas.ten_khoa')
                ->where('chuyen_nganhs.trang_thai', 1) // Thêm điều kiện trạng thái bằng 1
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
        
        $khoas = Khoa::all();
        return view('admin.chuyennganhs.index', compact('khoas'));        
    }
    public function getInactiveData()
    {
        $data = ChuyenNganh::leftJoin('khoas', 'chuyen_nganhs.id_khoa', '=', 'khoas.id')
        ->select('chuyen_nganhs.*', 'khoas.ten_khoa')
        ->where('chuyen_nganhs.trang_thai', 0) // Thêm điều kiện trạng thái bằng 1
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
        ChuyenNganh::updateOrCreate(['id' => $request->id],
                 ['ten_chuyen_nganh' => $request->ten_chuyen_nganh,
                    'ma_chu' => $request->ma_chu,
                  'ma_so' => $request->ma_so,
                  'id_khoa' => $request->id_khoa],
        );        
        return response()->json(['success'=>'Lưu Chuyên Ngành Thành Công.']);
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
        $chuyennganh = ChuyenNganh::find($id);
        return response()->json($chuyennganh);
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
        ChuyenNganh::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        ChuyenNganh::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
}
