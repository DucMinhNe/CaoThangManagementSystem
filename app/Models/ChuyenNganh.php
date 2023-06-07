<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    use HasFactory;
    protected $table = 'chuyen_nganhs';
    protected $fillable = [
        'id','ten_chuyen_nganh','id_khoa'
    ];
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa', 'id');
    }
}   
