<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyetDinh extends Model
{
    use HasFactory;
    protected $table = 'quyet_dinhs';
    protected $fillable = [
        'ma_gv_ra_quyet_dinh',
        'ngay_ra_quyet_dinh',
        'noi_dung',
        'hieu_luc_bat_dau',
        'hieu_luc_ket_thuc',
        'trang_thai',
    ];
    
}
