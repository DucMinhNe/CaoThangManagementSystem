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
        Schema::create('giang_viens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('magv')->nullable();
            $table->string('ten_gv');
            $table->string('email');
            $table->string('sodienthoai');
            $table->string('so_cmt');
            $table->date('ngaysinh');
            $table->string('noisinh');
            $table->boolean('gioitinh');
            $table->string('dantoc');
            $table->string('tongiao');
            $table->string('dia_chi_thuong_tru');
            $table->string('dia_chi_tam_tru');
            $table->string('quoc_gia');
            $table->string('hinhanhdaidien');
            $table->unsignedInteger('id_chuc_vu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giang_viens');
    }
};
