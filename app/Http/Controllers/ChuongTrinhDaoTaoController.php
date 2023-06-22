<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuongTrinhDaoTao;
use App\Models\CTChuongTrinhDaoTao;
use App\Models\ChuyenNganh;
use Illuminate\Support\Facades\DB;
use DataTables;
class ChuongTrinhDaoTaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ChuongTrinhDaoTao::leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
                ->select('chuong_trinh_dao_taos.*', 'chuyen_nganhs.ten_chuyen_nganh')
                ->where('chuong_trinh_dao_taos.trang_thai', 1) // Thêm điều kiện trạng thái bằng 1
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
        $chuongtrinhdaotaos = ChuongTrinhDaoTao::all();
        $chuyennganhs = ChuyenNganh::all();
        return view('admin.chuongtrinhdaotaos.index', compact('chuyennganhs','chuongtrinhdaotaos'));    
    }
    public function getInactiveData()
    {
        $data = ChuongTrinhDaoTao::leftJoin('chuyen_nganhs', 'chuong_trinh_dao_taos.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
                ->select('chuong_trinh_dao_taos.*', 'chuyen_nganhs.ten_chuyen_nganh')
                ->where('chuong_trinh_dao_taos.trang_thai', 0) 
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
    public function saoChepChiTiet($idChuongTrinhDaoTao1, $idChuongTrinhDaoTao2)
    {
        DB::beginTransaction();
        
        try {
            // Lấy danh sách các chi tiết chương trình đào tạo từ Chương trình đào tạo 1
            $chiTietDaoTao1 = CTChuongTrinhDaoTao::where('id_chuong_trinh_dao_tao', $idChuongTrinhDaoTao1)->get();
            
            foreach ($chiTietDaoTao1 as $chiTiet) {
                // Tạo mới một chi tiết chương trình đào tạo cho Chương trình đào tạo 2
                $chiTietDaoTao2 = new CTChuongTrinhDaoTao();
                $chiTietDaoTao2->id_chuong_trinh_dao_tao = $idChuongTrinhDaoTao2;
                $chiTietDaoTao2->hoc_ky = $chiTiet->hoc_ky;
                $chiTietDaoTao2->id_mon_hoc = $chiTiet->id_mon_hoc;
                $chiTietDaoTao2->so_tin_chi = $chiTiet->so_tin_chi;
                $chiTietDaoTao2->trang_thai = $chiTiet->trang_thai;
                $chiTietDaoTao2->save();
            }
            
            DB::commit();
            
            return response()->json(['success' => 'Sao chép chi tiết chương trình đào tạo thành công.']);
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json(['error' => 'Đã xảy ra lỗi khi sao chép chi tiết chương trình đào tạo.']);
        }
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
        ChuongTrinhDaoTao::updateOrCreate(['id' => $request->id],
                 ['khoa_hoc' => $request->khoa_hoc,
                    'id_chuyen_nganh' => $request->id_chuyen_nganh,
                 
             ],
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
        $chuongtrinhdaotao = ChuongTrinhDaoTao::find($id);
        return response()->json($chuongtrinhdaotao);
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
        ChuongTrinhDaoTao::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        ChuongTrinhDaoTao::where('id', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
}