<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
    use HasFactory;
    protected $table = 'bo_mons';
    protected $fillable = [
        'ten_bo_mon',
        'id_khoa',
        'trang_thai',
    ];
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa', 'id');
    }
}
