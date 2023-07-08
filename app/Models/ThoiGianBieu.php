<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoiGianBieu extends Model
{
    use HasFactory;
    protected $fillable=[
        'stt',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'trang_thai',
    ];
}
