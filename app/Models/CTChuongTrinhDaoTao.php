<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTChuongTrinhDaoTao extends Model
{
    use HasFactory;
    protected $table = 'ct_chuong_trinh_dao_taos';
    protected $fillable = [
        'id_chuong_trinh_dao_tao',
        'hoc_ky',
        'id_mon_hoc',
        'so_tin_chi',
        'so_tiet',
        'trang_thai',
    ];
}