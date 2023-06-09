<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVuSinhVien extends Model
{
    use HasFactory;
    protected $table = 'chuc_vu_sinh_viens';
    protected $fillable = [
        'ten_chuc_vu',
        'trang_thai'
    ];
}