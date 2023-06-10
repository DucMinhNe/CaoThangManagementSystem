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
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_lop_hoc');
            $table->unsignedInteger('id_chuyen_nganh');
            $table->string('ma_gv_chu_nhiem')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_chuyen_nganh')->references('id')->on('chuyen_nganhs');
            $table->foreign('ma_gv_chu_nhiem')->references('ma_gv')->on('giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop_hocs');
    }
};