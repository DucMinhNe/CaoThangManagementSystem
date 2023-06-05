<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Khoa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','ten_khoa'
    ];
}
