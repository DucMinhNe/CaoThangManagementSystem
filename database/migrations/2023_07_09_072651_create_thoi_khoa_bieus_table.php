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
        Schema::create('thoi_khoa_bieus', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_phong_hoc')->nullable()->index('id_phong_hoc');
            $table->integer('id_lop_hoc_phan')->nullable()->index('id_lop_hoc_phan');
            $table->integer('thu_trong_tuan')->nullable();
            $table->integer('id_tiet_bat_dau')->nullable()->index('id_tiet_bat_dau');
            $table->integer('id_tiet_ket_thuc')->nullable()->index('id_tiet_ket_thuc');
            $table->integer('hoc_ky')->nullable();
            $table->text('ghi_chu')->nullable();
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
        Schema::dropIfExists('thoi_khoa_bieus');
    }
};
