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
        Schema::table('bang_thong_baos', function (Blueprint $table) {
            $table->foreign(['id_lop_hoc_phan'], 'bang_thong_baos_ibfk_2')->references(['id'])->on('lop_hoc_phans');
            $table->foreign(['ma_gv'], 'bang_thong_baos_ibfk_1')->references(['ma_gv'])->on('giang_viens');
            $table->foreign(['id_lop_hoc'], 'bang_thong_baos_ibfk_3')->references(['id'])->on('lop_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bang_thong_baos', function (Blueprint $table) {
            $table->dropForeign('bang_thong_baos_ibfk_2');
            $table->dropForeign('bang_thong_baos_ibfk_1');
            $table->dropForeign('bang_thong_baos_ibfk_3');
        });
    }
};
