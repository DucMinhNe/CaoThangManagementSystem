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
        Schema::create('tai_khoan_sinh_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tai_khoan');
            $table->string('mat_khau');
            $table->string('ma_sv');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
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
        Schema::dropIfExists('tai_khoan_sinh_viens');
    }
};