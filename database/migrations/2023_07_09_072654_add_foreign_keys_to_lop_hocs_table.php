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
        Schema::table('lop_hocs', function (Blueprint $table) {
            $table->foreign(['ma_gv_chu_nhiem'], 'lop_hocs_ibfk_1')->references(['ma_gv'])->on('giang_viens');
            $table->foreign(['id_chuyen_nganh'], 'lop_hocs_ibfk_2')->references(['id'])->on('chuyen_nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lop_hocs', function (Blueprint $table) {
            $table->dropForeign('lop_hocs_ibfk_1');
            $table->dropForeign('lop_hocs_ibfk_2');
        });
    }
};
