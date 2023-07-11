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
        Schema::table('danh_sach_chuc_vu_giang_viens', function (Blueprint $table) {
            $table->foreign(['id_chuc_vu'], 'danh_sach_chuc_vu_giang_viens_ibfk_2')->references(['id'])->on('chuc_vu_giang_viens');
            $table->foreign(['ma_gv'], 'danh_sach_chuc_vu_giang_viens_ibfk_1')->references(['ma_gv'])->on('giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('danh_sach_chuc_vu_giang_viens', function (Blueprint $table) {
            $table->dropForeign('danh_sach_chuc_vu_giang_viens_ibfk_2');
            $table->dropForeign('danh_sach_chuc_vu_giang_viens_ibfk_1');
        });
    }
};
