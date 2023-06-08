<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class GiangVien extends Model
{
    use HasFactory;
    protected $table = 'giang_viens';
    protected $primaryKey = 'ma_gv';
    protected $fillable = [
        'ma_gv',
        'ten_giang_vien',
        'email',
        'so_dien_thoai',
        'so_cmt',
        'ngay_sinh',
        'noi_sinh',
        'gioi_tinh',
        'dan_toc',
        'ton_giao',
        'dia_chi_thuong_tru',
        'dia_chi_tam_tru',
        'quoc_gia',
        'id_bo_mon',
        'hinh_anh_dai_dien',
        'id_chuc_vu',
        'trang_thai_lam_viec',
        'trang_thai',
    ];
    public $incrementing = false;
    public function boMon()
    {
        return $this->belongsTo(BoMon::class, 'id_bo_mon', 'id');
    }

    public function chucVu()
    {
        return $this->belongsTo(ChucVuGiangVien::class, 'id_chuc_vu', 'id');
    }
}
