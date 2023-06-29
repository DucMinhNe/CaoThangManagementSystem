<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\MoDangKyMon;
use DataTables;
class MoDangKyMonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MoDangKyMon::join('mon_hocs','mo_dang_ky_mons.id_mon_hoc','mon_hocs.id')
            ->select('mo_dang_ky_mons.*','mon_hocs.ten_mon_hoc')
            ->where('mo_dang_ky_mons.trang_thai', 1)->latest()->get();
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
        $monhocs=MonHoc::where('trang_thai',1)->get();
        return view('admin.modangkymons.index',compact('monhocs'));
    }
    public function getInactiveData()
    {
        $data = MoDangKyMon::join('mon_hocs','mo_dang_ky_mons.id_mon_hoc','mon_hocs.id')
        ->select('mo_dang_ky_mons.*','mon_hocs.ten_mon_hoc')
        ->where('mo_dang_ky_mons.trang_thai', 0)->latest()->get();
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
        MoDangKyMon::updateOrCreate(
            ['id' => $request->id],
            [
                'id_mon_hoc' => $request->id_mon_hoc,
                'khoa_hoc'=>$request->khoa_hoc,
                'mo_dang_ky'=>$request->mo_dang_ky,
                'dong_dang_ky'=>$request->dong_dang_ky,
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
        $mondangkymon = MoDangKyMon::find($id);
        return response()->json($mondangkymon);
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
        MoDangKyMon::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        MoDangKyMon::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi phục thành công.']);
    }
}
