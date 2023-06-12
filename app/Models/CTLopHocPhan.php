<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTLopHocPhan extends Model
{
    use HasFactory;
    protected $table = 'ct_lop_hoc_phans';
    protected $fillable = [
        'id_lop_hoc_phan','ma_sv','chuyen_can','tbkt','thi_1','thi_2','tong_ket_1','tong_ket_2','trang_thai'
    ];  
}