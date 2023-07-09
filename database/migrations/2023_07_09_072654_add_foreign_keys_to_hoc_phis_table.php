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
        Schema::table('hoc_phis', function (Blueprint $table) {
            $table->foreign(['id_chuyen_nganh'], 'hoc_phis_ibfk_1')->references(['id'])->on('chuyen_nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoc_phis', function (Blueprint $table) {
            $table->dropForeign('hoc_phis_ibfk_1');
        });
    }
};
