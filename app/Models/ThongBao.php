<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;
    protected $table="bang_thong_baos";
    protected $fillable=['ma_gv','id_lop_hoc_phan','id_lop_hoc','tieu_de','noi_dung','trang_thai'];
    public function ThongBaoCuaSinhVien()
    {
        return $this->hasMany(ThongBaoCuaSinhVien::class,'id_thong_bao','id');
    }
}
