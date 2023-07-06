<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class SinhVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'sinh_viens';
    protected $primaryKey = 'ma_sv';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $rememberTokenName = false;
    protected $fillable = [
        'ma_sv',
        'ten_sinh_vien',
        'email',
        'so_dien_thoai',
        'so_cmt',
        'gioi_tinh',
        'ngay_sinh',
        'noi_sinh',
        'dan_toc',
        'ton_giao',
        'dia_chi_thuong_tru',
        'dia_chi_tam_tru',
        'hinh_anh_dai_dien',
        'tai_khoan',
        'mat_khau',
        'khoa_hoc',
        'bac_dao_tao',
        'he_dao_tao',
        'id_lop_hoc',
        'tinh_trang_hoc',
        'trang_thai',
    ];
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['mat_khau'] = bcrypt($password);
    }
    public function lopHoc(){
        return $this->hasOne(LopHoc::class,'id','id_lop_hoc');
    }
}
