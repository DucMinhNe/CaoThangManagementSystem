<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachChucVuSinhVien extends Model
{
    use HasFactory;
    protected $table = 'danh_sach_chuc_vu_sinh_viens';
    protected $fillable = ['ma_sv', 'id_chuc_vu', 'trang_thai'];
}