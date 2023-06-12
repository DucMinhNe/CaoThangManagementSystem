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
        Schema::create('lop_hoc_phans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_lop_hoc_phan');
            $table->unsignedInteger('id_lop_hoc');    
            $table->string('ma_gv_1');
            $table->string('ma_gv_2');
            $table->string('ma_gv_3');
            $table->unsignedInteger('id_ct_chuong_trinh_dao_tao');    
            $table->boolean('mo_lop')->default(true);
            $table->boolean('trang_thai')->default(true);
            $table->foreign('id_lop_hoc')->references('id')->on('lop_hocs');
            $table->foreign('ma_gv_1')->references('ma_gv')->on('giang_viens');
            $table->foreign('ma_gv_2')->references('ma_gv')->on('giang_viens');
            $table->foreign('ma_gv_3')->references('ma_gv')->on('giang_viens');
            $table->foreign('id_ct_chuong_trinh_dao_tao')->references('id')->on('chuong_trinh_dao_taos');
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
        Schema::dropIfExists('lop_hoc_phans');
    }
};