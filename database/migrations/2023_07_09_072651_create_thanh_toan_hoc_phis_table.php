<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thanh_toan_hoc_phis', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_hoc_phi')->nullable();
            $table->integer('id_hinh_thuc_thanh_toan')->nullable()->index('id_hinh_thuc_thanh_toan');
            $table->integer('vnpay_payment_id')->nullable()->index('vnpay_payment_id');
            $table->integer('paypal_payment_id')->nullable()->index('paypal_payment_id');
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->boolean('trang_thai')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thanh_toan_hoc_phis');
    }
};
