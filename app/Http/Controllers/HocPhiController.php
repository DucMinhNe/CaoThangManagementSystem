<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HocPhi;
use App\Models\ChuyenNganh;

use DataTables;

class HocPhiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HocPhi::leftJoin('chuyen_nganhs','hoc_phis.id_chuyen_nganh','chuyen_nganhs.id')
                          ->select('hoc_phis.*','chuyen_nganhs.ten_chuyen_nganh')
                          ->where('hoc_phis.trang_thai', 1)->latest()->get();
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
        $chuyennganhs=ChuyenNganh::where('trang_thai',1)->get();
        return view('admin.hocphis.index',compact('chuyennganhs'));
    }
    public function getInactiveData()
    {
        $data = HocPhi::leftJoin('chuyen_nganhs','hoc_phis.id_chuyen_nganh','chuyen_nganhs.id')
        ->select('hoc_phis.*','chuyen_nganhs.ten_chuyen_nganh')
        ->where('hoc_phis.trang_thai', 0)->latest()->get();
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
        //return $request->all();
        HocPhi::updateOrCreate(
            ['id' => $request->id],
            [
                'id_chuyen_nganh'=>$request->id_chuyen_nganh,
                'khoa_hoc'=>$request->khoa_hoc,
                'hoc_ky' => $request->hoc_ky,
                'so_tien'=>$request->so_tien,
                'ngay_bat_dau'=>$request->ngay_bat_dau,
                'ngay_ket_thuc'=>$request->ngay_ket_thuc,
                'mo_dong_hoc_phi'=>$request->mo_dong_hoc_phi,
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
        $hocphi = HocPhi::find($id);
        return response()->json($hocphi);
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
        HocPhi::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        HocPhi::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
}
