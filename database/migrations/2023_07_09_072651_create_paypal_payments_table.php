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
        Schema::create('paypal_payments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('payment_id')->nullable();
            $table->string('payer_email_address')->nullable();
            $table->string('payer_id')->nullable();
            $table->decimal('gross_amount', 10, 0)->nullable();
            $table->decimal('paypal_fee', 10, 0)->nullable();
            $table->decimal('net_amount', 10, 0)->nullable();
            $table->string('currency_code')->nullable();
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
        Schema::dropIfExists('paypal_payments');
    }
};
