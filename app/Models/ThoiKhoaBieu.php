<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoiKhoaBieu extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_phong_hoc',
        'id_lop_hoc_phan',
        'hoc_ky',
        'thu_trong_tuan',
        'id_tiet_bat_dau',
        'id_tiet_ket_thuc',
    ];
    public function lopHocPhan(){
        return $this->belongsTo(LopHocPhan::class,'id_lop_hoc_phan','id');
    }
    public function phongHoc(){
        return $this->hasOne(Phong::class,'id','id_phong_hoc');
    }
    public function tietBatDau(){
        return $this->hasOne(ThoiGianBieu::class,'id','id_tiet_bat_dau');
    }
    public function tietKetThuc(){
        return $this->hasOne(ThoiGianBieu::class,'id','id_tiet_ket_thuc');
    }
}
