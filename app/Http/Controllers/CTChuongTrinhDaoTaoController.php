<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\MonHoc;
use DataTables;
use Illuminate\Support\Facades\DB;

class CTChuongTrinhDaoTaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CTChuongTrinhDaoTao::leftJoin('chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao', '=', 'chuong_trinh_dao_taos.id')
            ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
            ->leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
            ->select('ct_chuong_trinh_dao_taos.*', 'mon_hocs.ten_mon_hoc', DB::raw('CONCAT(chuong_trinh_dao_taos.khoa_hoc, ".", chuyen_nganhs.ten_chuyen_nganh) AS khoa_hoc_chuyen_nganh'))
            ->where('ct_chuong_trinh_dao_taos.trang_thai', 1)
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
        $chuongtrinhdaotaos = ChuongTrinhDaoTao::leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->selectRaw('chuong_trinh_dao_taos.*, CONCAT(chuong_trinh_dao_taos.khoa_hoc, ".", chuyen_nganhs.ten_chuyen_nganh) AS khoa_hoc_chuyen_nganh')
        ->get();
        $monhocs = MonHoc::all();
        return view('admin.ctchuongtrinhdaotaos.index', compact('chuongtrinhdaotaos','monhocs'));   
    }
    public function getInactiveData()
    {
        $data = CTChuongTrinhDaoTao::leftJoin('chuong_trinh_dao_taos', 'ct_chuong_trinh_dao_taos.id_chuong_trinh_dao_tao', '=', 'chuong_trinh_dao_taos.id')
        ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
        ->leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->select('ct_chuong_trinh_dao_taos.*', 'mon_hocs.ten_mon_hoc', DB::raw('CONCAT(chuong_trinh_dao_taos.khoa_hoc, ".", chuyen_nganhs.ten_chuyen_nganh) AS khoa_hoc_chuyen_nganh'))
        ->where('ct_chuong_trinh_dao_taos.trang_thai', 0)
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
        CTChuongTrinhDaoTao::updateOrCreate(['id' => $request->id],
        ['id_chuong_trinh_dao_tao' => $request->id_chuong_trinh_dao_tao,
           'hoc_ky' => $request->hoc_ky,
           'id_mon_hoc' => $request->id_mon_hoc,
           'so_tin_chi' => $request->so_tin_chi,
           'so_tiet' => $request->so_tiet,
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
        $ctchuongtrinhdaotaos = CTChuongTrinhDaoTao::find($id);
        return response()->json($ctchuongtrinhdaotaos);
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
        CTChuongTrinhDaoTao::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
    public function restore($id)
    {
        CTChuongTrinhDaoTao::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Thành Công.']);
    }
}