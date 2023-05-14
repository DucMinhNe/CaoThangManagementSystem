<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiangVien extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'magv',
        'ten_gv',
        'email',
        'sodienthoai',
        'so_cmt',
        'ngaysinh',
        'noisinh',
        'gioitinh',
        'dantoc',
        'tongiao',
        'dia_chi_thuong_tru',
        'dia_chi_tam_tru',
        'quoc_gia',
        'hinhanhdaidien',
        'id_chuc_vu',
    ];
}
