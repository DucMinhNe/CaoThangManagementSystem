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
        Schema::table('thong_bao_cua_sinh_viens', function (Blueprint $table) {
            $table->foreign(['id_thong_bao'], 'thong_bao_cua_sinh_viens_ibfk_2')->references(['id'])->on('bang_thong_baos');
            $table->foreign(['ma_sv'], 'thong_bao_cua_sinh_viens_ibfk_1')->references(['ma_sv'])->on('sinh_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thong_bao_cua_sinh_viens', function (Blueprint $table) {
            $table->dropForeign('thong_bao_cua_sinh_viens_ibfk_2');
            $table->dropForeign('thong_bao_cua_sinh_viens_ibfk_1');
        });
    }
};
