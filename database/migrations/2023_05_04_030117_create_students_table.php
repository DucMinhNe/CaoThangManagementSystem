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
        Schema::create('students', function (Blueprint $table) {
            $table->string('mssv')->primary()->default('0306201155');
            $table->string('hoten');
            $table->string('lop');
            $table->string('email');
            $table->string('cmnd');
            $table->string('sdt');
            $table->date('ngaysinh');
            $table->string('gioitinh');
            $table->string('hinhdaidien');  
            $table->integer('trangthai')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
