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
        Schema::create('ct_quyet_dinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_quyet_dinh');
            $table->string('ma_sv_nhan_quyet_dinh');
            $table->timestamps();
            $table->boolean('trang_thai')->default(true);
            $table->foreign('id_quyet_dinh')->references('id')->on('quyet_dinhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_quyet_dinhs');
    }
};