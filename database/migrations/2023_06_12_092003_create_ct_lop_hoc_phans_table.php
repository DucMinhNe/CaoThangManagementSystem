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
        Schema::create('ct_lop_hoc_phans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_lop_hoc_phan');    
            $table->string('ma_sv');
            $table->float('chuyen_can')->nullable();
            $table->float('tbkt')->nullable();
            $table->float('thi_1')->nullable();
            $table->float('thi_2')->nullable();
            $table->float('tong_ket_1')->nullable();
            $table->float('tong_ket_2')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_lop_hoc_phan')->references('id')->on('lop_hoc_phans');
            $table->foreign('ma_sv')->references('ma_sv')->on('sinh_viens');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_lop_hoc_phans');
    }
};