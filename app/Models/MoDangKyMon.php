<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoDangKyMon extends Model
{
    use HasFactory;
    protected $fillable=[
        'khoa_hoc',
        'id_mon_hoc',
        'mo_dang_ky',
        'dong_dang_ky',
        'trang_thai',
    ];
}
