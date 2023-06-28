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
        Schema::create('ct_chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_chuong_trinh_dao_tao');  
            $table->integer('hoc_ky');  
            $table->unsignedInteger('id_mon_hoc');  
            $table->unsignedInteger('so_tin_chi');
            $table->unsignedInteger('so_tiet');
            $table->boolean('trang_thai')->default(true);
            $table->foreign('id_chuong_trinh_dao_tao')->references('id')->on('chuong_trinh_dao_taos');
            $table->foreign('id_mon_hoc')->references('id')->on('mon_hocs');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_chuong_trinh_dao_taos');
    }
};