<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\QuaTrinhHocTap;

class APIQuaTrinhHocTapController extends Controller
{
    public function layQuaTrinhHocTap($ma_sv){
        $quaTrinhHocTap=QuaTrinhHocTap::where('ma_sv',$ma_sv)->where('trang_thai',1)->orderBy('created_at','desc')->first();
        if($quaTrinhHocTap!=null){
            return response()->json([
                'qua_trinh_hoc_tap'=>$quaTrinhHocTap,
                'status'=>11,
            ],201);
        }
        return response()->json([
            'message'=>"Không tìm thấy quá trình học tập của sinh vien",
            'status'=>0,
        ],201);
    }
}
