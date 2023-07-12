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
        Schema::table('lop_hoc_phans', function (Blueprint $table) {
            $table->foreign(['id_ct_chuong_trinh_dao_tao'], 'lop_hoc_phans_ibfk_1')->references(['id'])->on('ct_chuong_trinh_dao_taos');
            $table->foreign(['ma_gv_2'], 'lop_hoc_phans_ibfk_3')->references(['ma_gv'])->on('giang_viens');
            $table->foreign(['id_lop_hoc'], 'lop_hoc_phans_ibfk_5')->references(['id'])->on('lop_hocs');
            $table->foreign(['ma_gv_1'], 'lop_hoc_phans_ibfk_2')->references(['ma_gv'])->on('giang_viens');
            $table->foreign(['ma_gv_3'], 'lop_hoc_phans_ibfk_4')->references(['ma_gv'])->on('giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lop_hoc_phans', function (Blueprint $table) {
            $table->dropForeign('lop_hoc_phans_ibfk_1');
            $table->dropForeign('lop_hoc_phans_ibfk_3');
            $table->dropForeign('lop_hoc_phans_ibfk_5');
            $table->dropForeign('lop_hoc_phans_ibfk_2');
            $table->dropForeign('lop_hoc_phans_ibfk_4');
        });
    }
};
