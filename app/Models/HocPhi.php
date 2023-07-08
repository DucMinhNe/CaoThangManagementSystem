<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocPhi extends Model
{
    use HasFactory;
    protected $fillable=[
        'hoc_ky',
        'id_chuyen_nganh',
        'khoa_hoc',
        'so_tien',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'mo_dong_hoc_phi',
        'trang_thai',
    ];
}
