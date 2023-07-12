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
        Schema::table('bo_mons', function (Blueprint $table) {
            $table->foreign(['id_khoa'], 'bo_mons_ibfk_1')->references(['id'])->on('khoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bo_mons', function (Blueprint $table) {
            $table->dropForeign('bo_mons_ibfk_1');
        });
    }
};
