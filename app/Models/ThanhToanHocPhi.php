<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToanHocPhi extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_hoc_phi',
        'id_hinh_thuc_thanh_toan',
        'vnpay_payment_id',
        'paypal_payment_id',
        'ma_sv',
        'trang_thai',
    ];
}
