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
        Schema::table('chuyen_nganhs', function (Blueprint $table) {
            $table->foreign(['id_khoa'], 'chuyen_nganhs_ibfk_1')->references(['id'])->on('khoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chuyen_nganhs', function (Blueprint $table) {
            $table->dropForeign('chuyen_nganhs_ibfk_1');
        });
    }
};
