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
        Schema::create('chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('khoa_hoc');
            $table->unsignedInteger('id_chuyen_nganh');    
            $table->timestamps();
            $table->boolean('trang_thai')->default(true);
            $table->foreign('id_chuyen_nganh')->references('id')->on('chuyen_nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chuong_trinh_dao_taos');
    }
};