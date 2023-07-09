<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    protected $table = 'lop_hocs';
    protected $fillable = [
        'ten_lop_hoc','id_chuyen_nganh','ma_gv_chu_nhiem','trang_thai'
    ];
    public function giangVienChuNhiem(){
        return $this->hasOne(GiangVien::class,'ma_gv','ma_gv_chu_nhiem');
    }
    public function chuyenNganh(){
        return $this->hasOne(ChuyenNganh::class,'id','id_chuyen_nganh');
    }
}
