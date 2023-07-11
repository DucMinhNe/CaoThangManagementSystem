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
        Schema::table('thanh_toan_hoc_phis', function (Blueprint $table) {
            $table->foreign(['paypal_payment_id'], 'thanh_toan_hoc_phis_ibfk_2')->references(['id'])->on('paypal_payments');
            $table->foreign(['id_hinh_thuc_thanh_toan'], 'thanh_toan_hoc_phis_ibfk_4')->references(['id'])->on('hinh_thuc_thanh_toans');
            $table->foreign(['ma_sv'], 'thanh_toan_hoc_phis_ibfk_1')->references(['ma_sv'])->on('sinh_viens');
            $table->foreign(['vnpay_payment_id'], 'thanh_toan_hoc_phis_ibfk_3')->references(['id'])->on('vnpay_payments');
            $table->foreign(['id_hoc_phi'], 'thanh_toan_hoc_phis_ibfk_5')->references(['id'])->on('hoc_phis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thanh_toan_hoc_phis', function (Blueprint $table) {
            $table->dropForeign('thanh_toan_hoc_phis_ibfk_2');
            $table->dropForeign('thanh_toan_hoc_phis_ibfk_4');
            $table->dropForeign('thanh_toan_hoc_phis_ibfk_1');
            $table->dropForeign('thanh_toan_hoc_phis_ibfk_3');
            $table->dropForeign('thanh_toan_hoc_phis_ibfk_5');
        });
    }
};
