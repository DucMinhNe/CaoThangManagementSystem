<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'students';
    protected $primaryKey = 'mssv';
    protected $fillable = ['mssv','hoten', 'lop', 'email','cmnd','sdt','ngaysinh','gioitinh','hinhdaidien','trangthai'];
}
