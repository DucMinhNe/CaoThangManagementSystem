<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVuGiangVien extends Model
{
    use HasFactory;
    protected $table = 'chuc_vu_giang_viens';
    protected $fillable = [
        'ten_chuc_vu',
        'trang_thai'
    ];
}