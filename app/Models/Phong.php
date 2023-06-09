<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $table = 'phongs';
    protected $fillable = [
        'ten_phong','mo_ta','suc_chua','id_loai_phong','trang_thai'
    ];  
    public function loaiPhong()
    {
        return $this->belongsTo(LoaiPhong::class, 'id_loai_phong');
    }
}
