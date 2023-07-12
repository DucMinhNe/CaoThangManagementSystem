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
        Schema::create('vnpay_payments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->decimal('vnp_Amount', 10, 0)->nullable();
            $table->string('vnp_BankCode')->nullable();
            $table->string('vnp_CardType')->nullable();
            $table->string('vnp_OrderInfo')->nullable();
            $table->string('vnp_PayDate')->nullable();
            $table->string('vnp_ResponseCode')->nullable();
            $table->string('vnp_TmnCode')->nullable();
            $table->string('vnp_TransactionNo')->nullable();
            $table->string('vnp_TransactionStatus')->nullable();
            $table->string('vnp_TxnRef')->nullable();
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
        Schema::dropIfExists('vnpay_payments');
    }
};
