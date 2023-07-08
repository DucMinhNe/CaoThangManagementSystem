<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToanDangKyLopHocPhan extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_dang_ky_lop_hoc_phan',
        'id_hinh_thuc_thanh_toan',
        'vnpay_payment_id',
        'paypal_payment_id',
        'ma_sv',
        'trang_thai',
    ];
}
