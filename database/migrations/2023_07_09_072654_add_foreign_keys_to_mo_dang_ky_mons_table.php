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
        Schema::table('mo_dang_ky_mons', function (Blueprint $table) {
            $table->foreign(['id_mon_hoc'], 'mo_dang_ky_mons_ibfk_1')->references(['id'])->on('mon_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mo_dang_ky_mons', function (Blueprint $table) {
            $table->dropForeign('mo_dang_ky_mons_ibfk_1');
        });
    }
};
