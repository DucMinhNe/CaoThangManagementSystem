<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiangVien extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ma_gv',
        'ten_gv',
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
        'hinh_anh_dai_dien',
        'id_chuc_vu',
    ];
}
