<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHocPhan extends Model
{
    use HasFactory;
    protected $table = 'lop_hoc_phans';
    protected $fillable = [
        'ten_lop_hoc_phan','id_lop_hoc','ma_gv_1','ma_gv_2','ma_gv_3','id_ct_chuong_trinh_dao_tao','mo_lop','trang_thai'
    ];  
}