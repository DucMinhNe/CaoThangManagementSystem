<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;

class MoDangKyMon extends Model
{
    use HasFactory;
    // use LogsActivity;
    protected $fillable=[
        'khoa_hoc',
        'id_mon_hoc',
        'mo_dang_ky',
        'dong_dang_ky',
        'da_dong',
        'trang_thai',
    ];
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->u
    //     ->logOnly(['*']);
    //     // Chain fluent methods for configuration options
    // }
}
