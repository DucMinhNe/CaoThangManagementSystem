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
        Schema::table('chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->foreign(['id_chuyen_nganh'], 'chuong_trinh_dao_taos_ibfk_1')->references(['id'])->on('chuyen_nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->dropForeign('chuong_trinh_dao_taos_ibfk_1');
        });
    }
};
