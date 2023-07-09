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
        Schema::table('ct_quyet_dinhs', function (Blueprint $table) {
            $table->foreign(['id_quyet_dinh'], 'ct_quyet_dinhs_ibfk_1')->references(['id'])->on('quyet_dinhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ct_quyet_dinhs', function (Blueprint $table) {
            $table->dropForeign('ct_quyet_dinhs_ibfk_1');
        });
    }
};
