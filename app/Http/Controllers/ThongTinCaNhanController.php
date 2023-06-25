<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\GiangVien;
use App\Models\BoMon;
use App\Models\LopHoc;
use App\Models\ChucVuGiangVien;
use App\Models\LopHocPhan;
class ThongTinCaNhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giangviens = Auth::user();
       
        
        $bomons = null;
        $chucvus = null;
        if ($giangviens->id_bo_mon !== null) {
            $bomons = BoMon::find($giangviens->id_bo_mon);
        }
        
        if ($giangviens->id_chuc_vu !== null) {
            $chucvus = ChucVuGiangVien::find($giangviens->id_chuc_vu);
        }
        // $bomons = BoMon::find($giangviens->id_bo_mon);
        // $chucvus = ChucVuGiangVien::find($giangviens->id_chuc_vu);
        $chunhiems = LopHoc::where('ma_gv_chu_nhiem', $giangviens->ma_gv)->get();
        $lophocphans = LopHocPhan::where('ma_gv_1', $giangviens->ma_gv)
        ->orWhere('ma_gv_2', $giangviens->ma_gv)
        ->orWhere('ma_gv_3', $giangviens->ma_gv)
        ->get();
        return view('admin.thongtincanhans.index', compact('giangviens','bomons','chucvus','chunhiems','lophocphans'));  
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
        # Validation
        $request->validate([
            'mat_khau_cu' => 'required',
            'mat_khau_moi' => 'required',
            'nhap_lai_mat_khau' => 'required|same:mat_khau_moi',
        ], [
            'mat_khau_cu.required' => 'Vui lòng nhập Mật khẩu cũ.',
            'mat_khau_moi.required' => 'Vui lòng nhập Mật khẩu mới.',
            'nhap_lai_mat_khau.required' => 'Vui lòng nhập lại Mật khẩu.',
            'nhap_lai_mat_khau.same' => 'Mật khẩu nhập lại không khớp với Mật khẩu mới.',
        ]);
        
      
        if(!Hash::check($request->mat_khau_cu, auth()->user()->mat_khau)){
            return response()->json(['success' => false, 'message' => 'Mật Khẩu Không Khớp'], 422);

        }

        #Update the new Password
        GiangVien::where('ma_gv', auth()->user()->ma_gv)->update([
            'mat_khau' => Hash::make($request->mat_khau_moi)
        ]);
        

        return response()->json(['success' => true, 'message' => 'Cập Nhật Thành Công']);

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
        //
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
        //
    }
}