<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyLopHocPhan extends Model
{
    use HasFactory;
    protected $fillable=[
        'ma_sv',
        'id_lop_hoc_phan',
        'tien_dong',
        'da_dong_tien',
        'duyet',
        'trang_thai',
    ];

    public function sinhVien(){
        return $this->hasOne(SinhVien::class,'ma_sv','ma_sv');
    }
    public function lopHocPhan(){
        return $this->hasOne(LopHocPhan::class,'id','id_lop_hoc_phan');
    }


}
