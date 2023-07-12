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
        Schema::create('ct_lop_hoc_phans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_lop_hoc_phan')->nullable()->index('id_lop_hoc_phan');
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->integer('chuyen_can')->nullable();
            $table->float('tbkt', 10, 0)->nullable();
            $table->float('thi_1', 10, 0)->nullable();
            $table->float('thi_2', 10, 0)->nullable();
            $table->float('tong_ket_1', 10, 0)->nullable();
            $table->float('tong_ket_2', 10, 0)->nullable();
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
        Schema::dropIfExists('ct_lop_hoc_phans');
    }
};
