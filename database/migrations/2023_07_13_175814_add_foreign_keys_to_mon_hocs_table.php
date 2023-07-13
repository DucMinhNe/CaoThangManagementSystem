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
        Schema::table('mon_hocs', function (Blueprint $table) {
            $table->foreign(['id_bo_mon'], 'mon_hocs_ibfk_1')->references(['id'])->on('bo_mons');
            $table->foreign(['id_loai_mon_hoc'], 'mon_hocs_ibfk_2')->references(['id'])->on('loai_mon_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mon_hocs', function (Blueprint $table) {
            $table->dropForeign('mon_hocs_ibfk_1');
            $table->dropForeign('mon_hocs_ibfk_2');
        });
    }
};
