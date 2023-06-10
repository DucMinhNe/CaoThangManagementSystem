<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Auth;
use Hash;
class TaiKhoanGiangVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tai_khoan_giang_viens';
    public $timestamps = false;
    protected $rememberTokenName = false;
    protected $fillable = [
        'tai_khoan',
        'mat_khau',
        'ma_gv',
    ];

    /**
     * Get the custom password field for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        // 'remember_token',
        // 'mat_khau',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['mat_khau'] = bcrypt($password);
    }
    /**
     * Get the associated GiangVien for the TaiKhoanGiangVien.
     */
    public function giangVien()
    {
        return $this->belongsTo(GiangVien::class, 'ma_gv', 'ma_gv');
    }
}