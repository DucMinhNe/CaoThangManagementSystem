<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Khoa;
use App\Models\ChuyenNganh;
use App\Imports\SinhViensImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LopHoc;
use DataTables;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
class SinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SinhVien::leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
                ->select('sinh_viens.*', 'lop_hocs.ten_lop_hoc')
                ->where('sinh_viens.trang_thai', 1) 
                ->latest()
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
                    
        
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $khoas = Khoa::all();
        $chuyennganhs = ChuyenNganh::all();
        $lophocs = LopHoc::all();
        return view('admin.sinhviens.index', compact('khoas','chuyennganhs','lophocs'));    
    }
    public function getInactiveData()
    {
        $data = SinhVien::leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
                ->select('sinh_viens.*', 'lop_hocs.ten_lop_hoc')
                ->where('sinh_viens.trang_thai', 0) 
                ->latest()
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_sv.'" data-original-title="Restore" class="restore btn btn-success btn-sm restoreBtn"><i class="fa-solid fa-trash-can-arrow-up"></i></a>';
        
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
    public function import() 
    {   
        $idLopHocExcel = request('id_lop_hoc_excel');
    
        Excel::import(new SinhViensImport($idLopHocExcel), request()->file('fileExcel'));
        // Excel::import(new SinhViensImport,request()->file('fileExcel'));
        return back();
    }
    public function getChuyenNganhByKhoa($id_khoa)
    {
        $chuyenNganhs = ChuyenNganh::where('id_khoa', $id_khoa)
        ->where('trang_thai', 1)
        ->get();

        return response()->json($chuyenNganhs);
    }
    public function getLopByChuyenNganh($id_chuyen_nganh)
    {
        $lops = LopHoc::where('id_chuyen_nganh', $id_chuyen_nganh)
        ->where('trang_thai', 1)
        ->get();
        return response()->json($lops);
    }
    public function getLopByKhoa($id_khoa)
    {
        $lops = LopHoc::join('chuyen_nganhs', 'lop_hocs.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->where('chuyen_nganhs.id_khoa', $id_khoa)
        ->where('lop_hocs.trang_thai', 1)
        ->select('lop_hocs.*')
        ->get();

        return response()->json($lops);
    }
    public function getSinhVienByIdKhoa($id_khoa)
    {
        $data = SinhVien::leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->leftJoin('chuyen_nganhs', 'lop_hocs.id_chuyen_nganh', '=', 'chuyen_nganhs.id')
        ->select('sinh_viens.*', 'lop_hocs.ten_lop_hoc')
        ->where('chuyen_nganhs.id_khoa', $id_khoa)
        ->where('sinh_viens.trang_thai', 1)
        ->latest()
        ->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }   
    public function getSinhVienByIdChuyenNganh($id_chuyen_nganh)
    {
        $data = SinhVien::leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->select('sinh_viens.*', 'lop_hocs.ten_lop_hoc')
        ->where('lop_hocs.id_chuyen_nganh', $id_chuyen_nganh)
        ->where('sinh_viens.trang_thai', 1)
        ->latest()
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function getSinhVienByIdLop($id_lop)
    {
        $data = SinhVien::leftJoin('lop_hocs', 'sinh_viens.id_lop_hoc', '=', 'lop_hocs.id')
        ->select('sinh_viens.*', 'lop_hocs.ten_lop_hoc')
        ->where('id_lop_hoc', $id_lop)
        ->where('sinh_viens.trang_thai', 1) 
        ->latest()
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_sv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function taoBangTen($hoten, $lop)
    {   
        $maxWidth = 1035 - (2 * 12); 
        $fontPath = public_path('sinhvien_bangten/calibri.ttf');
        $fontSize = 165;
        $image = Image::canvas(1000, 350, '#ffffff')->rectangle(6, 6, 995, 343, function ($draw) {
        $draw->border(12, '#0000FF');
        });
        $textLength = imagettfbbox($fontSize, 0, $fontPath, $hoten)[2];
        if ($textLength > $maxWidth) {
        $fontSize = $fontSize * $maxWidth / $textLength;
        $fontSize = $fontSize + 4;
        }
        $image->text(mb_strtoupper($hoten), 500, 110, function($font) use ($fontPath, $fontSize) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color('#0000FF');
            $font->align('center');
            $font->valign('middle');
        });
        $image->text(mb_strtoupper($lop), 500, 270, function($font) use ($fontPath, $fontSize) {
            $font->file($fontPath);
            $font->size(116);
            $font->color('#0000FF');
            $font->align('center');
            $font->valign('middle');
        });
        $newImagePath = public_path('sinhvien_bangten/image.jpg');
        $image->save($newImagePath);
        return response()->json(asset('sinhvien_bangten/image.jpg'));
    }
    public function taoTheSinhVien($mssv)
    {   
        $sv = SinhVien::where('ma_sv', $mssv)->first();
        $lop = LopHoc::where('id', $sv->id_lop_hoc)->first();
        // dd($sv->ten_sinh_vien);
        $image = Image::canvas(770, 400, '#ffffff');
        // $hinhsv = Image::make(public_path('sinhvien_img/'.$sv->hinh_anh_dai_dien))->resize(132, 175);
        $filePath = null;
        if ($sv->hinh_anh_dai_dien) {
            $filePath = public_path('sinhvien_img/'.$sv->hinh_anh_dai_dien);
        }
        if ($filePath && file_exists($filePath)) {
            $hinhsv = Image::make($filePath)->resize(132, 175);
        } else {
            return "Không tìm thấy hình ảnh";
        }
        $image->insert($hinhsv, 'top-left', 37, 165);
        $logocaothang = Image::make(public_path('sinhvien_thesinhvien/logo_caothang.jpg'))->resize(80, 120);
        $image->insert($logocaothang, 'top-left', 59, 10);
        $image->text('TRƯỜNG CAO ĐẲNG KỸ THUẬT CAO THẮNG', 170, 24, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(32);
            $font->color('#0000FF');
            $font->valign('middle');
        });
        $image->text('THẺ SINH VIÊN', 360, 65, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(42);
            $font->color('#FF0000');
            $font->align('left');
            $font->valign('middle');
        });
        $image->text(mb_strtoupper($sv->ten_sinh_vien), 250, 120, function($font) {
            $font->file(public_path('sinhvien_bangten/calibri.ttf'));
            $font->size(40);
            $font->color('#0000FF');
            $font->align('left');
            $font->valign('middle');
        });
        $image->text('Ngày sinh: ' . date('d/m/Y', strtotime($sv->ngay_sinh)), 250, 180, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(35);
            $font->color('#0000FF');
            $font->align('left');
            $font->valign('middle');
        });        
        $image->text('Khóa: '.$sv->khoa_hoc.' - '.($sv->khoa_hoc+3), 250, 250, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(35);
            $font->color('#0000FF');
            $font->align('left');
            $font->valign('middle');
        });
        $image->text('Lớp: '.$lop->ten_lop_hoc, 250, 325, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(35);
            $font->color('#0000FF');
            $font->align('left');
            $font->valign('middle');
        });
        $image->text('MS: '.$sv->ma_sv, 19, 370, function($font) {
            $font->file(public_path('sinhvien_thesinhvien/calibri.ttf'));
            $font->size(25);
            $font->color('#0000FF');
            $font->align('left');
            $font->valign('middle');
        });  
        $newImagePath = public_path('sinhvien_thesinhvien/image.jpg');
        $image->save($newImagePath);
        return response()->json(asset('sinhvien_thesinhvien/image.jpg'));
    }
    public function getDiemTrungBinhHocKy()
    {
        $result = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk6')
            )
            ->groupBy('sinh_viens.ten_sinh_vien')
            ->get();
    
        return response()->json($result);
    }
    public function getDiemTrungBinhHocKyByLop($id_lop_hoc)
    {
        $result = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(ct_lop_hoc_phans.tong_ket_1, COALESCE(ct_lop_hoc_phans.tong_ket_2, ct_lop_hoc_phans.tong_ket_1)) ELSE NULL END) AS trung_binh_hk6')
            )
            ->where('sinh_viens.id_lop_hoc', $id_lop_hoc)
            ->groupBy('sinh_viens.ten_sinh_vien')
            ->get();
    
        return response()->json($result);
    }
    public function getDiemTrungBinhHocKyByLop_xettotnghiep($id_lop_hoc)
    {
        $result = SinhVien::leftJoin('ct_lop_hoc_phans', 'sinh_viens.ma_sv', '=', 'ct_lop_hoc_phans.ma_sv')
            ->leftJoin('lop_hoc_phans', 'ct_lop_hoc_phans.id_lop_hoc_phan', '=', 'lop_hoc_phans.id')
            ->leftJoin('ct_chuong_trinh_dao_taos', 'lop_hoc_phans.id_ct_chuong_trinh_dao_tao', '=', 'ct_chuong_trinh_dao_taos.id')
            ->select(
                'sinh_viens.ten_sinh_vien',
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 1 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk1'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 2 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk2'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 3 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk3'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 4 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk4'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 5 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk5'),
                DB::raw('AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky = 6 THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) AS trung_binh_hk6'),
                DB::raw('CASE
                    WHEN AVG(CASE WHEN ct_chuong_trinh_dao_taos.hoc_ky <= 6 AND (ct_lop_hoc_phans.tong_ket_1 >= 5 OR ct_lop_hoc_phans.tong_ket_2 >= 5) THEN GREATEST(COALESCE(ct_lop_hoc_phans.tong_ket_1, 0), COALESCE(ct_lop_hoc_phans.tong_ket_2, 0)) END) < 5 THEN "Không đạt"
                    WHEN COUNT(CASE WHEN (ct_lop_hoc_phans.tong_ket_1 < 5 OR ct_lop_hoc_phans.tong_ket_2 < 5) AND (ct_lop_hoc_phans.tong_ket_1 IS NOT NULL OR ct_lop_hoc_phans.tong_ket_2 IS NOT NULL) THEN 1 END) > 0 THEN "Không đạt"
                    ELSE "Đạt"
                END AS tot_nghiep')
            )
            ->where('lop_hoc_phans.id_lop_hoc', $id_lop_hoc)
            ->groupBy('sinh_viens.ten_sinh_vien')
            ->get();
    
        return response()->json($result);
    }
    

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $profileImage = $request->input('hinh_anh_dai_dien_hidden'); // Giá trị hiện tại của hinh_anh_dai_dien
        if ($request->hasFile('hinh_anh_dai_dien')) {
            $oldImage = SinhVien::where('ma_sv', $request->ma_sv)->value('hinh_anh_dai_dien');
            if ($oldImage && FILE::exists('sinhvien_img/' . $oldImage)) {
                // Xóa ảnh cũ
                FILE::delete('sinhvien_img/' . $oldImage);
            }
            $files = $request->file('hinh_anh_dai_dien');
            $destinationPath = 'sinhvien_img/'; // Đường dẫn lưu trữ ảnh
            // $profileImage = $request->ma_sv . "." . $files->getClientOriginalExtension();
            $profileImage = $request->ma_sv . "_" . time() . ".jpg";
            $files->move($destinationPath, $profileImage);
        }
        $request->validate([
            'ten_sinh_vien' => ['required', 'regex:/^[\p{L}\s]+$/u'],
            'email' => ['required', 'email'],
            'so_dien_thoai' => ['required', 'regex:/^(0|\+84)?([3-9]\d{8})$/'],
            'so_cmt' => ['required', 'regex:/\d{9}|\d{12}/'],
            'gioi_tinh' => ['required'],
            'ngay_sinh' => ['required'],
            'noi_sinh' => ['required'],
            'dan_toc' => ['required', 'regex:/^[\p{L}\s]+$/u'],
            'ton_giao' => ['required', 'regex:/^[\p{L}\s]+$/u'],
            'dia_chi_thuong_tru' => ['required'],
            'dia_chi_tam_tru' => ['required'],
            'tai_khoan' => ['required'],
            'khoa_hoc' => ['required', 'regex:/^\d{4}$/'],
            'bac_dao_tao' => ['required'],
            'he_dao_tao' => ['required'],
            'id_lop_hoc' => ['required'],
            'tinh_trang_hoc' => ['required'],
        ]);        
        $sinhVienData = [
            'ten_sinh_vien' => $request->ten_sinh_vien,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'so_cmt' => $request->so_cmt,
            'gioi_tinh' => $request->gioi_tinh,
            'ngay_sinh' => $request->ngay_sinh,
            'noi_sinh' => $request->noi_sinh,
            'dan_toc' => $request->dan_toc,
            'ton_giao' => $request->ton_giao,
            'dia_chi_thuong_tru' => $request->dia_chi_thuong_tru,
            'dia_chi_tam_tru' => $request->dia_chi_tam_tru,
            'hinh_anh_dai_dien' => $profileImage,
            'tai_khoan' => $request->tai_khoan,
            'khoa_hoc' => $request->khoa_hoc,
            'bac_dao_tao' => $request->bac_dao_tao,
            'he_dao_tao' => $request->he_dao_tao,
            'id_lop_hoc' => $request->id_lop_hoc,
            'tinh_trang_hoc' => $request->tinh_trang_hoc,
        ];
        if (!empty($request->mat_khau)) {
            $sinhVienData['mat_khau'] = bcrypt($request->mat_khau);
        }
        SinhVien::updateOrCreate(['ma_sv' => $request->ma_sv], $sinhVienData);
        return response()->json(['success'=>'Lưu Thành Công.']);
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
        $sinhvien = SinhVien::find($id);
        return response()->json($sinhvien);
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
        SinhVien::where('ma_sv', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        SinhVien::where('ma_sv', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function laySinhVienTheoLopHoc($id_lop_hoc)
    {
        $sinhviens = SinhVien::where('id_lop_hoc', $id_lop_hoc)->get();
        return response()->json($sinhviens);
    }
    public function layTongSinhVien()
    {
        $tongSinhViens = SinhVien::where('trang_thai', 1)->count();

        return response()->json(['tongSinhViens' => $tongSinhViens]);
    }


}