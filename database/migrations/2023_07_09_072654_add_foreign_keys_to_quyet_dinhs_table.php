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
        Schema::table('quyet_dinhs', function (Blueprint $table) {
            $table->foreign(['ma_gv_ra_quyet_dinh'], 'quyet_dinhs_ibfk_1')->references(['ma_gv'])->on('giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quyet_dinhs', function (Blueprint $table) {
            $table->dropForeign('quyet_dinhs_ibfk_1');
        });
    }
};
