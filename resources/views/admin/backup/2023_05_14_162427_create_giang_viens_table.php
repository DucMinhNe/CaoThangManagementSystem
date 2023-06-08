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
            $table->string('ma_gv')->nullable();
            $table->string('ten_gv');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->string('so_cmt');
            $table->date('ngay_sinh');
            $table->string('noi_sinh');
            $table->boolean('gioi_tinh');
            $table->string('dan_toc');
            $table->string('ton_giao');
            $table->string('dia_chi_thuong_tru');
            $table->string('dia_chi_tam_tru');
            $table->string('quoc_gia');
            $table->string('hinh_anh_dai_dien');
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
