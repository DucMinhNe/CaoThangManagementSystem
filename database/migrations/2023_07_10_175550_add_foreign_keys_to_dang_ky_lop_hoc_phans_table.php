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
        Schema::table('dang_ky_lop_hoc_phans', function (Blueprint $table) {
            $table->foreign(['ma_sv'], 'dang_ky_lop_hoc_phans_ibfk_2')->references(['ma_sv'])->on('sinh_viens');
            $table->foreign(['id_lop_hoc_phan'], 'dang_ky_lop_hoc_phans_ibfk_1')->references(['id'])->on('lop_hoc_phans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dang_ky_lop_hoc_phans', function (Blueprint $table) {
            $table->dropForeign('dang_ky_lop_hoc_phans_ibfk_2');
            $table->dropForeign('dang_ky_lop_hoc_phans_ibfk_1');
        });
    }
};
