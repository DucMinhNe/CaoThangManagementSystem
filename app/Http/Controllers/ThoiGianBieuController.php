<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThoiGianBieu;
use DataTables;

class ThoiGianBieuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ThoiGianBieu::where('trang_thai', 1)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';

                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Xóa</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.thoigianbieus.index');
    }
    public function getInactiveData()
    {
        $data = ThoiGianBieu::where('trang_thai', 0)->latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';

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
        ThoiGianBieu::updateOrCreate(
            ['id' => $request->id],
            [
                'stt' => $request->stt,
                'thoi_gian_bat_dau'=>$request->thoi_gian_bat_dau,
                'thoi_gian_ket_thuc'=>$request->thoi_gian_ket_thuc,
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
        $thoigianbieu = ThoiGianBieu::find($id);    
        return response()->json($thoigianbieu);
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
        ThoiGianBieu::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        ThoiGianBieu::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
}
