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
        Schema::table('giang_viens', function (Blueprint $table) {
            $table->foreign(['id_bo_mon'], 'giang_viens_ibfk_1')->references(['id'])->on('bo_mons');
            $table->foreign(['id_chuc_vu'], 'giang_viens_ibfk_2')->references(['id'])->on('chuc_vu_giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('giang_viens', function (Blueprint $table) {
            $table->dropForeign('giang_viens_ibfk_1');
            $table->dropForeign('giang_viens_ibfk_2');
        });
    }
};
