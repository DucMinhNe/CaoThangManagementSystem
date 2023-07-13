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
        Schema::table('thoi_khoa_bieus', function (Blueprint $table) {
            $table->foreign(['id_phong_hoc'], 'thoi_khoa_bieus_ibfk_1')->references(['id'])->on('phongs');
            $table->foreign(['id_tiet_ket_thuc'], 'thoi_khoa_bieus_ibfk_3')->references(['id'])->on('thoi_gian_bieus');
            $table->foreign(['id_lop_hoc_phan'], 'thoi_khoa_bieus_ibfk_2')->references(['id'])->on('lop_hoc_phans');
            $table->foreign(['id_tiet_bat_dau'], 'thoi_khoa_bieus_ibfk_4')->references(['id'])->on('thoi_gian_bieus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thoi_khoa_bieus', function (Blueprint $table) {
            $table->dropForeign('thoi_khoa_bieus_ibfk_1');
            $table->dropForeign('thoi_khoa_bieus_ibfk_3');
            $table->dropForeign('thoi_khoa_bieus_ibfk_2');
            $table->dropForeign('thoi_khoa_bieus_ibfk_4');
        });
    }
};
