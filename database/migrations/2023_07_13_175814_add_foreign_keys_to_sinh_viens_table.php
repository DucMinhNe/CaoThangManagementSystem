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
        Schema::table('sinh_viens', function (Blueprint $table) {
            $table->foreign(['id_lop_hoc'], 'sinh_viens_ibfk_1')->references(['id'])->on('lop_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinh_viens', function (Blueprint $table) {
            $table->dropForeign('sinh_viens_ibfk_1');
        });
    }
};
