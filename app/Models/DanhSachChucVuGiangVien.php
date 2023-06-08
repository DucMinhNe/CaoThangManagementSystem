<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachChucVuGiangVien extends Model
{
    use HasFactory;
    protected $table = 'danh_sach_chuc_vu_giang_viens';
    protected $fillable = ['ma_gv', 'id_chuc_vu', 'trang_thai'];

    public function giangVien()
    {
        return $this->belongsTo(GiangVien::class, 'ma_gv', 'ma_gv');
    }

    public function chucVuGiangVien()
    {
        return $this->belongsTo(ChucVuGiangVien::class, 'id_chuc_vu', 'id');
    }
}
