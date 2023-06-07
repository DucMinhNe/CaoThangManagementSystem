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
              //join null
        $data = ChuyenNganh::leftJoin('khoas', 'chuyen_nganhs.id_khoa', '=', 'khoas.id')
         ->select('chuyen_nganhs.*', 'khoas.ten_khoa')
         ->latest()
         ->get();
            // $data = ChuyenNganh::join('khoas', 'chuyen_nganhs.id_khoa', '=', 'khoas.id')
            //     ->select('chuyen_nganhs.*', 'khoas.ten_khoa')
            //     ->latest()
            //     ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Sửa</a>';
   
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Xóa</a>';
 
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $khoas = Khoa::all();
        return view('admin.chuyennganhs.index', compact('khoas'));
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
                 ['ma_chu' => $request->ma_chu,
                  'ma_so' => $request->ma_so,
                  'ten_chuyen_nganh' => $request->ten_chuyen_nganh,
                  'id_khoa' => $request->id_khoa],
        );        
        return response()->json(['success'=>'Lưu Khoa Thành Công.']);
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
        ChuyenNganh::find($id)->delete();
        return response()->json(['success'=>'Xóa Khoa Thành Công.']);
    }
}
