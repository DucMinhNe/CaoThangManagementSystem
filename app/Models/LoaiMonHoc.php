<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiMonHoc extends Model
{
    use HasFactory;
    protected $table = 'loai_mon_hocs';
    protected $fillable = [
        'ten_loai_mon_hoc','trang_thai'
    ];
}
