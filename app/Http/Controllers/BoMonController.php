<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoMon;
use App\Models\Khoa;
use DataTables;
class BoMonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BoMon::leftJoin('khoas', 'bo_mons.id_khoa', '=', 'khoas.id')
                ->select('bo_mons.*', 'khoas.ten_khoa')
                ->where('bo_mons.trang_thai', 1) // Thêm điều kiện trạng thái bằng 1
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
        
        $khoas = Khoa::all();
        return view('admin.bomons.index', compact('khoas'));      
    }
    public function getInactiveData()
    {
        $data = BoMon::leftJoin('khoas', 'bo_mons.id_khoa', '=', 'khoas.id')
        ->select('bo_mons.*', 'khoas.ten_khoa')
        ->where('bo_mons.trang_thai', 0) 
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
            'ten_bo_mon' => ['required', 'regex:/^[\p{L}\d\s\-]+$/u'],
            'id_khoa' => 'required'
        ]);
        BoMon::updateOrCreate(
            ['id' => $request->id],
            [
                'ten_bo_mon' => $request->ten_bo_mon,
                'id_khoa' => $request->id_khoa
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
        $bomon = BoMon::find($id);
        return response()->json($bomon);
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
        BoMon::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        BoMon::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Khôi Phục Thành Công.']);
    }
}