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
        Schema::table('qua_trinh_hoc_taps', function (Blueprint $table) {
            $table->foreign(['ma_sv'], 'qua_trinh_hoc_taps_ibfk_1')->references(['ma_sv'])->on('sinh_viens');
            $table->foreign(['id_lop_hoc'], 'qua_trinh_hoc_taps_ibfk_2')->references(['id'])->on('lop_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qua_trinh_hoc_taps', function (Blueprint $table) {
            $table->dropForeign('qua_trinh_hoc_taps_ibfk_1');
            $table->dropForeign('qua_trinh_hoc_taps_ibfk_2');
        });
    }
};
