<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThoiKhoaBieu;
use App\Models\ThoiGianBieu;
use App\Models\LopHocPhan;
use App\Models\Phong;
use DataTables;


class ThoiKhoaBieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LopHocPhan::leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->leftJoin('mon_hocs', 'ct_chuong_trinh_dao_taos.id_mon_hoc', '=', 'mon_hocs.id')
            ->leftJoin('lop_hocs','lop_hocs.id','lop_hoc_phans.id_lop_hoc')
            ->select('lop_hoc_phans.*', 'mon_hocs.ten_mon_hoc', 'lop_hocs.ten_lop_hoc')
            ->where('lop_hoc_phans.trang_thai', 1)

            ->latest()
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Sửa</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $phonghocs=Phong::where('trang_thai',1)->get();
        $thoigianbieus=ThoiGianBieu::where('trang_thai',1)->orderBy('stt','asc')->get();
        return view('admin.thoikhoabieus.index', compact('phonghocs','thoigianbieus'));
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
        //dd($request->all());
        $thoikhoabieus=ThoiKhoaBieu::where('id_lop_hoc_phan',$request->id_lop_hoc_phan)->delete();
        foreach ($request->lich_hoc as $lichhoc) {
            ThoiKhoaBieu::create([
                'id_lop_hoc_phan'=>$request->id_lop_hoc_phan,
                'id_phong_hoc'=>$lichhoc['phong_hoc']['id'],
                'hoc_ky'=>$request->hoc_ky,
                'thu_trong_tuan'=>$lichhoc['thu_trong_tuan'],
                'id_tiet_bat_dau'=>$lichhoc['tiet_bat_dau']['id'],
                'id_tiet_ket_thuc'=>$lichhoc['tiet_ket_thuc']['id'],
            ]);
        }
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
        $thoikhoabieus=ThoiKhoaBieu::join('thoi_gian_bieus as tkba','thoi_khoa_bieus.id_tiet_bat_dau','tkba.id')
                                ->join('thoi_gian_bieus as tkbb','thoi_khoa_bieus.id_tiet_ket_thuc','tkbb.id')
                                ->orderBy('thoi_khoa_bieus.thu_trong_tuan','asc')
                                ->orderBy('tkba.stt','asc')
                                ->where('id_lop_hoc_phan',$id)
                                ->where('thoi_khoa_bieus.trang_thai',1)->get();
        $dataLich=array();
        foreach ($thoikhoabieus as $thoikhoabieu) {
            $dataLich[]=array(

                'thu_trong_tuan'=>$thoikhoabieu->thu_trong_tuan,
                'phong_hoc'=>$thoikhoabieu->phongHoc,
                'tiet_bat_dau'=>$thoikhoabieu->tietBatDau,
                'tiet_ket_thuc'=>$thoikhoabieu->tietKetThuc,
            );
        }
        $lophocphan=LopHocPhan::where('id',$id)->where('trang_thai',1)->first();
        return response()->json([
            'id'=>$lophocphan->id,
            'giang_vien_1'=>$lophocphan->giangVienChinh,
            'giang_vien_2'=>$lophocphan->giangVienPhu,
            'giang_vien_3'=>$lophocphan->giangVienPhu2,
            'lop_hoc'=>$lophocphan->lopHoc,
            'hoc_ky'=>$lophocphan->chiTietChuongTrinhDaoTao->hoc_ky,
            'mon_hoc'=>$lophocphan->chiTietChuongTrinhDaoTao->monHoc,
            'ten_lop_hoc_phan'=>$lophocphan->ten_lop_hoc_phan,
            'lich_hoc'=>$dataLich,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kiemTraTrungPhongTrungTiet(Request $request){
        $thoikhoabieus=ThoiKhoaBieu::where('id_phong_hoc',$request->id_phong_hoc)->where('hoc_ky',$request->hoc_ky)->where('thu_trong_tuan',$request->thu_trong_tuan)->where('trang_thai',1)->get();
        $sttTietDau=ThoiGianBieu::where('id',$request->id_tiet_bat_dau)->where('trang_thai',1)->first()->stt;
        //dd($sttTietDau);
        $sttTietCuoi=ThoiGianBieu::where('id',$request->id_tiet_ket_thuc)->where('trang_thai',1)->first()->stt;
        //dd($thoikhoabieus);
        $arrKiemTra= range($sttTietDau,$sttTietCuoi );
        foreach ($thoikhoabieus as $thoikhoabieu) {
            $sttTietDau=ThoiGianBieu::where('id',$thoikhoabieu->id_tiet_bat_dau)->where('trang_thai',1)->first()->stt;
            $sttTietCuoi=ThoiGianBieu::where('id',$thoikhoabieu->id_tiet_ket_thuc)->where('trang_thai',1)->first()->stt;
            $arrDuyet=range($sttTietDau,$sttTietCuoi );
            $intersect = array_intersect($arrKiemTra, $arrDuyet);
            if (!empty($intersect)) {
                return response()->json([
                    'message'=>"Đã có tiết ở phòng này vào ngày đó",
                    'status'=>0
                ]);
            }
        }
        return response()->json([
            'message'=>"Hợp lệ",
            'status'=>1
        ]);

    }
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
        //
    }
}
