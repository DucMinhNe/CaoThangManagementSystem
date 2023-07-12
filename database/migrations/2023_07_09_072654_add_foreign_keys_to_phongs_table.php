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
        Schema::table('phongs', function (Blueprint $table) {
            $table->foreign(['id_loai_phong'], 'phongs_ibfk_1')->references(['id'])->on('loai_phongs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phongs', function (Blueprint $table) {
            $table->dropForeign('phongs_ibfk_1');
        });
    }
};
