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
        Schema::create('danh_sach_chuc_vu_sinh_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_sv');
            $table->unsignedInteger('id_chuc_vu');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('ma_sv')->references('ma_sv')->on('sinh_viens');
            $table->foreign('id_chuc_vu')->references('id')->on('chuc_vu_sinh_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danh_sach_chuc_vu_sinh_viens');
    }
};