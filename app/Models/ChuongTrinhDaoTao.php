<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuongTrinhDaoTao extends Model
{
    use HasFactory;
    protected $table = 'chuong_trinh_dao_taos';
    protected $fillable = [
        'khoa_hoc',
        'id_chuyen_nganh',
        'trang_thai',
    ];
    public function ctChuongTrinhDaoTao()
    {
        return $this->hasMany(CTChuongTrinhDaoTao::class,'id_chuong_trinh_dao_tao','id');
    }
}
