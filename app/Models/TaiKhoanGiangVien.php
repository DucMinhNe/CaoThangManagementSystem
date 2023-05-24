<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Hash;
class TaiKhoanGiangVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tai_khoan',
        'mat_khau',
        'id_giang_vien',
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
     * @var array<int, string>
     */
    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];
    public function giangVien()
    {
        return $this->belongsTo(GiangVien::class, 'id_giang_vien', 'id');
    }
}
