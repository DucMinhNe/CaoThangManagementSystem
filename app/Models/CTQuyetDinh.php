<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTQuyetDinh extends Model
{
    use HasFactory;
    protected $table = 'ct_quyet_dinhs';
    protected $fillable = [
        'id_quyet_dinh','ma_sv_nhan_quyet_dinh','trang_thai'
    ];  
}