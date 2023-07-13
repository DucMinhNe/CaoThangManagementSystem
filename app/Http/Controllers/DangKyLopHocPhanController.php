<?php

namespace App\Http\Controllers;

use App\Models\DangKyLopHocPhan;
use App\Models\MoDangKyMon;
use App\Models\LopHocPhan;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChuyenNganh;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\LoaiMonHoc;
use App\Models\CTLopHocPhan;

use Illuminate\Http\Request;
use DataTables;

class DangKyLopHocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function danhsachsinhvientheokhoatheonganh(Request $request){
        $sinhviens=SinhVien::leftJoin('lop_hocs','lop_hocs.id','sinh_viens.id_lop_hoc')
        ->where('sinh_viens.trang_thai',1)
        ->where('sinh_viens.khoa_hoc',$request->khoa_hoc)
        ->where('lop_hocs.id_chuyen_nganh',$request->id_chuyen_nganh)
        ->select('sinh_viens.*')
        ->get();
        $data=array();
            foreach ($sinhviens as $sinhvien) {
            $data[]=$sinhvien;
            }
            return response()->json([
                'sinh_vien'=>$data,
                'status'=>1,
            ]);
    }
    public function danhSachSinhVienTheoKhoaHocTheoMonNo(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currenDateTime= date('Y-m-d H:i:s');
        $modangkymon=MoDangKyMon::where('id_mon_hoc',$request->id_mon_hoc)
                                ->where('khoa_hoc',$request->khoa_hoc)
                                ->where('da_dong',0)
                                ->where('mo_dang_ky','<',$currenDateTime)
                                ->where('dong_dang_ky','>',$currenDateTime)
                                ->where('trang_thai',1)
                                ->first();
        if($modangkymon!=null){
            $dangkylophocphans=DangKyLopHocPhan::join('lop_hoc_phans','lop_hoc_phans.id','dang_ky_lop_hoc_phans.id_lop_hoc_phan')
                                          ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                                          ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                                        //   ->where('dang_ky_lop_hoc_phans.ma_sv',$request->ma_sv)
                                          ->where('dang_ky_lop_hoc_phans.trang_thai',1)
                                          ->where('dang_ky_lop_hoc_phans.created_at','>',$modangkymon->mo_dang_ky)
                                          ->where('dang_ky_lop_hoc_phans.created_at','<',$modangkymon->dong_dang_ky)

                                          ->select('dang_ky_lop_hoc_phans.ma_sv')
                                          ->get();
                                          //dd($dangkylophocphan);
            $sinhviens=SinhVien::join('ct_lop_hoc_phans','ct_lop_hoc_phans.ma_sv','sinh_viens.ma_sv')
                            ->join('lop_hoc_phans','lop_hoc_phans.id','ct_lop_hoc_phans.id_lop_hoc_phan')
                            ->join('ct_chuong_trinh_dao_taos','ct_chuong_trinh_dao_taos.id','lop_hoc_phans.id_ct_chuong_trinh_dao_tao')
                            ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                            ->where('sinh_viens.khoa_hoc',$request->khoa_hoc)
                            ->where(function($query){
                                    $query->whereNotNull('tong_ket_2')
                                    ->where('tong_ket_2','<',5);
                                })
                            ->whereNotIn('sinh_viens.ma_sv',$dangkylophocphans)
                            ->where('sinh_viens.trang_thai',1)
                            ->get();

            $data=array();
            foreach ($sinhviens as $sinhvien) {
            $data[]=$sinhvien;
            }
            return response()->json([
                'sinh_vien'=>$data,
                'status'=>1,
            ]);
        }
        return response()->json([
            'message'=>"Chưa mở đăng ký môn học này",
            'status'=>0,
        ]);

    }
    public function danhSachLopHocPhanTheoMon(Request $request){
        $lophocphans=LopHocPhan::select('lop_hoc_phans.*')
                              ->join('ct_chuong_trinh_dao_taos','lop_hoc_phans.id_ct_chuong_trinh_dao_tao','ct_chuong_trinh_dao_taos.id')
                              ->where('ct_chuong_trinh_dao_taos.id_mon_hoc',$request->id_mon_hoc)
                              ->where('lop_hoc_phans.mo_dang_ky',1)
                              ->where('lop_hoc_phans.trang_thai_hoan_thanh',0)
                              ->where('lop_hoc_phans.trang_thai',1)
                              ->get();
        $data=array();
        foreach ($lophocphans as $lophocphan) {
            $data[]=array(
                'lop_hoc_phan'=>$lophocphan,
                'lop_hoc'=>$lophocphan->lopHoc,
            );
        }
        return response()->json([
            'danh_sach_lop_hoc_phan'=>$data
        ]);
    }
    public function searchMonTheoChuyenNganh(Request $request){
        $chuyennganh=ChuongTrinhDaoTao::where('khoa_hoc',$request->khoa_hoc)->where('id_chuyen_nganh',$request->id_chuyen_nganh)->first();
        //dd($chuyennganh);
        $data=array();
        //dd($chuyennganh->ctChuongTrinhDaoTao);
        if(isset($chuyennganh->ctChuongTrinhDaoTao)){
            foreach ($chuyennganh->ctChuongTrinhDaoTao as $ctctdt) {
                $data[]=$ctctdt->monHoc;
            }
        }
        return response()->json([
            'mon_hoc'=>$data,
        ]);

    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DangKyLopHocPhan::leftJoin('sinh_viens', 'dang_ky_lop_hoc_phans.ma_sv', '=', 'sinh_viens.ma_sv')
            ->leftJoin('lop_hoc_phans', 'dang_ky_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->select('dang_ky_lop_hoc_phans.*', 'sinh_viens.ten_sinh_vien', 'lop_hoc_phans.ten_lop_hoc_phan')
            ->where('dang_ky_lop_hoc_phans.trang_thai', 1)
            ->where('dang_ky_lop_hoc_phans.duyet',0)
            ->latest()
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn="";
                    if($row->da_dong_tien==1){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="review" class="btn btn-success btn-sm reviewBtn">Duyệt</a>';
                    }
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Xem</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Xóa</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // $giangviens = GiangVien::all();
        // $chucvus = ChucVuGiangVien::all();
        $khoahocs=ChuongTrinhDaoTao::select('khoa_hoc')->where('trang_thai',1)->distinct()->get();
        $chuyennganhs=ChuyenNganh::where('trang_thai',1)->get();
        return view('admin.dangkylophocphan.index',compact('khoahocs','chuyennganhs'));
    }
    public function getInactiveData()
    {
        $data = DangKyLopHocPhan::leftJoin('sinh_viens', 'dang_ky_lop_hoc_phans.ma_sv', '=', 'sinh_viens.ma_sv')
        ->leftJoin('lop_hoc_phans', 'dang_ky_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
        ->select('dang_ky_lop_hoc_phans.*', 'sinh_viens.ten_sinh_vien', 'lop_hoc_phans.ten_lop_hoc_phan')
        ->where('dang_ky_lop_hoc_phans.trang_thai', 1)
        ->latest()
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn">Xem</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Restore" class="btn btn-success btn-sm restoreBtn">Khôi phục</a>';

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
        $chuongtrinhdaotao=ChuongTrinhDaoTao::where('khoa_hoc',$request->khoa_hoc)->where('id_chuyen_nganh',$request->id_chuyen_nganh)->first();
        $ctchuongtrinhdaotao=$chuongtrinhdaotao->ctChuongTrinhDaoTao->where('id_mon_hoc',$request->id_mon_hoc)->where('trang_thai',1)->first();
        $tiendong=$ctchuongtrinhdaotao->so_tin_chi*env('TIEN_MON_HOC_LI_THUYET');
        $lophocphan=LopHocPhan::find($request->id_lop_hoc_phan);
        $sinhvien=SinhVien::where('ma_sv',$request->ma_sv)->first();
        $dangkylophocphan=DangKyLopHocPhan::updateOrCreate(['id' => $request->id],
        ['ma_sv' => $request->ma_sv,
           'id_lop_hoc_phan' => $request->id_lop_hoc_phan,
           'tien_dong'=>$tiendong,
           'da_dong_tien'=>0,
           'duyet'=>0,
           'trang_thai',1
        ],
        );

        activity()
            ->useLog('Thêm đăng ký lớp học phần')
            ->performedOn($dangkylophocphan)
            ->withProperties(['attributes' => $dangkylophocphan->getAttributes(),'old'=>[]])
            ->causedBy(auth()->user())
            ->log('Thêm đăng ký lớp học phần cho sinh viên '.$sinhvien->ten_sinh_vien.'- Mã '.$sinhvien->ma_sv.' /  Đăng ký lớp: '.$lophocphan->ten_lop_hoc_phan.' - Mã lớp: '.$lophocphan->id ) ;
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
        $dangkylophocphan=DangKyLopHocPhan::find($id);
        return response()->json([
            'id'=>$dangkylophocphan->id,
            'khoa_hoc'=>$dangkylophocphan->sinhVien->khoa_hoc,
            'id_chuyen_nganh'=>$dangkylophocphan->lopHocPhan->chiTietChuongTrinhDaoTao->chuongTrinhDaoTao->id_chuyen_nganh,
            'id_mon_hoc'=>$dangkylophocphan->lopHocPhan->chiTietChuongTrinhDaoTao->id_mon_hoc,
            'id_lop_hoc_phan'=>$dangkylophocphan->id_lop_hoc_phan,
            'ma_sv'=>$dangkylophocphan->ma_sv
        ]);
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
        DangKyLopHocPhan::where('id', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Đăng Ký Lớp Học Phần Thành Công.']);
    }
    public function review($id)
    {

        DangKyLopHocPhan::where('id', $id)->update(['duyet' => 1]);
        $dangkylophocphan=DangKyLopHocPhan::where('id',$id)->where('trang_thai',1)->first();
        $lophocphan=LopHocPhan::find($request->id_lop_hoc_phan);
        $sinhvien=SinhVien::where('ma_sv',$request->ma_sv)->first();
        CTLopHocPhan::create([
            'id_lop_hoc_phan'=>$dangkylophocphan->id_lop_hoc_phan,
            'ma_sv'=>$dangkylophocphan->ma_sv,
        ]);

        activity()
        ->useLog('Duyệt đăng ký lớp học phần')
        ->performedOn($dangkylophocphan)
        ->withProperties(['attributes' => $dangkylophocphan->getAttributes(),'old'=>[]])
        ->causedBy(auth()->user())
        ->log('Duyệt đăng ký lớp học phần cho sinh viên '.$sinhvien->ten_sinh_vien.'- Mã '.$sinhvien->ma_sv.' /  Đăng ký lớp: '.$lophocphan->ten_lop_hoc_phan.' - Mã lớp: '.$lophocphan->id ) ;
        return response()->json(['success' => 'Duyệt Thành Công.']);
    }
}
