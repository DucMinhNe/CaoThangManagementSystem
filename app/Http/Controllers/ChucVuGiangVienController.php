<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChucVuGiangVien;
use DataTables;
class ChucVuGiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ChucVuGiangVien::where('trang_thai', 1)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fa-solid fa-trash"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.chucvugiangviens.index');
    }
    public function getInactiveData()
    {
        $data = ChucVuGiangVien::where('trang_thai', 0)->latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

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
        ChucVuGiangVien::updateOrCreate(
            ['id' => $request->id],
            [
                'ten_chuc_vu' => $request->ten_chuc_vu,
            ]
        );        
        return response()->json(['success' => 'Lưu Thành Công.']);
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
        $chucvugiangvien = ChucVuGiangVien::find($id);
        return response()->json($chucvugiangvien);
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
        ChucVuGiangVien::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        ChucVuGiangVien::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
}