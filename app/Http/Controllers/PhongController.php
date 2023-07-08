<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phong;
use App\Models\LoaiPhong;
use DataTables;
class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Phong::leftJoin('loai_phongs', 'phongs.id_loai_phong', '=', 'loai_phongs.id')
                ->select('phongs.*', 'loai_phongs.ten_loai_phong')
                ->where('phongs.trang_thai', 1) // Thêm điều kiện trạng thái bằng 1
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
        $loaiphongs = LoaiPhong::all();
        return view('admin.phongs.index', compact('loaiphongs'));        
    }
    public function getInactiveData()
    {
        $data = Phong::leftJoin('loai_phongs', 'phongs.id_loai_phong', '=', 'loai_phongs.id')
        ->select('phongs.*', 'loai_phongs.ten_loai_phong')
        ->where('phongs.trang_thai', 0) // Thêm điều kiện trạng thái bằng 1
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
            'ten_phong' => ['required', 'regex:/^[\p{L}\s]+$/u'],
            'suc_chua' => 'required|numeric',
        ]);
        Phong::updateOrCreate(['id' => $request->id],
        ['ten_phong' => $request->ten_phong,
           'mo_ta' => $request->mo_ta,
         'suc_chua' => $request->suc_chua,
         'id_loai_phong' => $request->id_loai_phong],
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
        $phong = Phong::find($id);
        return response()->json($phong);
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
        Phong::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        Phong::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
}