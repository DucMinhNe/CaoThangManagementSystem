<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;
    protected $table = 'mon_hocs';
    protected $fillable = [
        'ten_mon_hoc','id_bo_mon','id_loai_mon_hoc','trang_thai'
    ];
    public function boMon()
    {
        return $this->belongsTo(BoMon::class, 'id_bo_mon');
    }
    public function loaiMonHoc()
    {
        return $this->belongsTo(LoaiMonHoc::class, 'id_loai_mon_hoc');
    }
}
