<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Auth;
use Hash;
class GiangVien extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $table = 'giang_viens';
    protected $primaryKey = 'ma_gv';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $rememberTokenName = false;
    protected $fillable = [
        'ma_gv',
        'ten_giang_vien',
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
        'id_bo_mon',
        'id_chuc_vu',
        'tinh_trang_lam_viec',
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
}