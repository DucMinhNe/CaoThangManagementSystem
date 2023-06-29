<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBaoCuaSinhVien extends Model
{
    use HasFactory;
    protected $fillable=['id_thong_bao','ma_sv','trang_thai_doc','trang_thai'];
    public function thongBao(){
        return $this->hasOne(ThongBao::class,'id','id_thong_bao');
    }
    public function SinhVien_ThongBao()
    {
        return $this->hasOne(SinhVien::class,'ma_sv','ma_sv');
    }
}
