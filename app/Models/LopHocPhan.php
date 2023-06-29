<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHocPhan extends Model
{
    use HasFactory;
    protected $table = 'lop_hoc_phans';
    protected $fillable = [
        'ten_lop_hoc_phan','id_lop_hoc','ma_gv_1','ma_gv_2','ma_gv_3','id_ct_chuong_trinh_dao_tao','mo_dang_ky','trang_thai_hoan_thanh','trang_thai'
    ];
    public function chiTietLopHocPhan()
    {
        return $this->hasMany(ChiTietLopHocPhan::class,'id_lop_hoc_phan','id');
    }
    public function lopHoc(){
        return $this->hasOne(LopHoc::class,'id','id_lop_hoc');
    }
    public function giangVienChinh(){
        return $this->hasOne(GiangVien::class,'ma_gv','ma_gv_1');
    }
    public function giangVienPhu(){
        return $this->hasOne(GiangVien::class,'ma_gv','ma_gv_2');
    }
    public function giangVienPhu2(){
        return $this->hasOne(GiangVien::class,'ma_gv','ma_gv_3');
    }
    public function chiTietChuongTrinhDaoTao(){
        return $this->hasOne(CTChuongTrinhDaoTao::class,'id','id_ct_chuong_trinh_dao_tao');
    }
    public function thoiKhoaBieu(){
        return $this->hasMany(ThoiKhoaBieu::class,'id_lop_hoc_phan','id')->orderBy('thu_trong_tuan');
    }
}
