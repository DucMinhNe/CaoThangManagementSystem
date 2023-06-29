<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'payment_id',
        'payer_email_address',
        'payer_id',
        'gross_amount',
        'paypal_fee',
        'net_amount',
        'currency_code',
        'trang_thai',
    ];
}
