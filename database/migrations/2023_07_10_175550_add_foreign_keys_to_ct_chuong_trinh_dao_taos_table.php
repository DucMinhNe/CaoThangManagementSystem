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
        Schema::table('ct_chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->foreign(['id_chuong_trinh_dao_tao'], 'ct_chuong_trinh_dao_taos_ibfk_2')->references(['id'])->on('chuong_trinh_dao_taos');
            $table->foreign(['id_mon_hoc'], 'ct_chuong_trinh_dao_taos_ibfk_1')->references(['id'])->on('mon_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ct_chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->dropForeign('ct_chuong_trinh_dao_taos_ibfk_2');
            $table->dropForeign('ct_chuong_trinh_dao_taos_ibfk_1');
        });
    }
};
