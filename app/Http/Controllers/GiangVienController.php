<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiangVien;
use App\Models\BoMon;
use App\Models\Khoa;
use App\Models\ChucVuGiangVien;
use DataTables;
use File;
class GiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = GiangVien::leftJoin('bo_mons', 'giang_viens.id_bo_mon', '=', 'bo_mons.id')
            ->leftJoin('chuc_vu_giang_viens', 'giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
            ->select('giang_viens.*', 'bo_mons.ten_bo_mon', 'chuc_vu_giang_viens.ten_chuc_vu')
            ->where('giang_viens.trang_thai', 1) 
            ->latest()
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $khoas = Khoa::all();
        $bomons = BoMon::all();
        $chucvus = ChucVuGiangVien::all();
        return view('admin.giangviens.index', compact('khoas','bomons','chucvus'));    
    }
    public function getInactiveData()
    {
        $data = GiangVien::leftJoin('bo_mons', 'giang_viens.id_bo_mon', '=', 'bo_mons.id')
        ->leftJoin('chuc_vu_giang_viens', 'giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
        ->select('giang_viens.*', 'bo_mons.ten_bo_mon', 'chuc_vu_giang_viens.ten_chuc_vu')
        ->where('giang_viens.trang_thai', 0) 
        ->latest()
        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_gv.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->ma_gv.'" data-original-title="Restore" class="restore btn btn-success btn-sm restoreBtn"><i class="fa-solid fa-trash-can-arrow-up"></i></a>';
                  
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function getBoMonByKhoa($id_khoa)
    {
        $boMons = BoMon::where('id_khoa', $id_khoa)
        ->where('trang_thai', 1)
        ->get();
        return response()->json($boMons);
    }
    public function getGiangVienByIdKhoa($id_khoa)
    {
        $data = GiangVien::leftJoin('bo_mons', 'giang_viens.id_bo_mon', '=', 'bo_mons.id')
        ->leftJoin('khoas', 'bo_mons.id_khoa', '=', 'khoas.id')
        ->leftJoin('chuc_vu_giang_viens', 'giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
        ->select('giang_viens.*', 'bo_mons.ten_bo_mon', 'chuc_vu_giang_viens.ten_chuc_vu')
        ->where('khoas.id', $id_khoa)
        ->where('giang_viens.trang_thai', 1) 
        ->latest()
        ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function getGiangVienByIdBoMon($id_bo_mon)
    {
        $data = GiangVien::leftJoin('bo_mons', 'giang_viens.id_bo_mon', '=', 'bo_mons.id')
        ->leftJoin('chuc_vu_giang_viens', 'giang_viens.id_chuc_vu', '=', 'chuc_vu_giang_viens.id')
        ->select('giang_viens.*', 'bo_mons.ten_bo_mon', 'chuc_vu_giang_viens.ten_chuc_vu')
        ->where('id_bo_mon', $id_bo_mon)
        ->where('giang_viens.trang_thai', 1) 
        ->latest()
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBtn"><i class="fas fa-pencil-alt"></i></a>';
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ma_gv . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-trash"></i></a>';
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
        $profileImage = $request->input('hinh_anh_dai_dien_hidden'); // Giá trị hiện tại của hinh_anh_dai_dien
        if ($request->hasFile('hinh_anh_dai_dien')) {
            $oldImage = GiangVien::where('ma_gv', $request->ma_gv)->value('hinh_anh_dai_dien');
            if ($oldImage && FILE::exists('giangvien_img/' . $oldImage)) {
                // Xóa ảnh cũ
                FILE::delete('giangvien_img/' . $oldImage);
            }
            $files = $request->file('hinh_anh_dai_dien');
            $destinationPath = 'giangvien_img/'; // Đường dẫn lưu trữ ảnh
            // $profileImage = $request->ma_gv . "." . $files->getClientOriginalExtension();
            $profileImage = $request->ma_gv . "_" . time() . ".jpg";
            $files->move($destinationPath, $profileImage);
        }
        $request->validate([
            'ten_giang_vien' => ['required', 'regex:/^[\p{L}\s]+$/u'],
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
            'id_chuc_vu' => ['required'],
            'tinh_trang_lam_viec' => ['required'],
        ]);  
        $giangVienData = [
            'ten_giang_vien' => $request->ten_giang_vien,
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
            'id_bo_mon' => $request->id_bo_mon,
            'id_chuc_vu' => $request->id_chuc_vu,
            'tinh_trang_lam_viec' => $request->tinh_trang_lam_viec,
        ];
        if (!empty($request->mat_khau)) {
            $giangVienData['mat_khau'] = bcrypt($request->mat_khau);
        }
        GiangVien::updateOrCreate(['ma_gv' => $request->ma_gv], $giangVienData);      
        return response()->json(['success'=>'Lưu Thành Công.']);
    }
    public function thongTinCaNhanstore(Request $request)
    {  
        $request->validate([
            'ten_giang_vien' => ['required', 'regex:/^[\p{L}\s]+$/u'],
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
        ]); 
        $giangVienData = [
            'ten_giang_vien' => $request->ten_giang_vien,
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
        ];
        GiangVien::updateOrCreate(['ma_gv' => auth()->user()->ma_gv], $giangVienData);      
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
        $giangvien = GiangVien::find($id);
        return response()->json($giangvien);
    }
    public function profile($id)
    {
        $giangVien = GiangVien::find($id);
        
        return view('giangviens.profile', ['giangVien' => $giangVien]);
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
        GiangVien::where('ma_gv', $id)->update(['trang_thai' => 0]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function restore($id)
    {
        GiangVien::where('ma_gv', $id)->update(['trang_thai' => 1]);
        return response()->json(['success' => 'Xóa Chuyên Ngành Thành Công.']);
    }
    public function layTongGiangVien()
    {
        $tongGiangViens = GiangVien::where('trang_thai', 1)->count();

        return response()->json(['tongGiangViens' => $tongGiangViens]);
    }
    public function layThongTinQuanTriVien()
    {
        $data = GiangVien::select('ten_giang_vien', 'email', 'so_dien_thoai', 'hinh_anh_dai_dien')
            ->where('id_chuc_vu', 1)
            ->get();
        return response()->json($data);
    }
}