<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';
    protected $fillable = [
    'ma_sv',
    'ten_sinh_vien',
    'ngay_sinh',
    'noi_sinh',
    'gioi_tinh',
    'dan_toc',
    'so_cmt', 
    'id_chuyen_nganh',
    'id_khoa',
    'ton_giao',
    'email',
    'so_dien_thoai',
    'khoa_hoc', 
    'hinh_anh_dai_dien',
    'bac_dao_tao',
    'he_dao_tao',
    'dia_chi_thuong_tru',
    'dia_chi_tam_tru', 
    'quoc_gia',
    'id_lop_hoc',
    'tinh_trang_hoc'
    ];
}