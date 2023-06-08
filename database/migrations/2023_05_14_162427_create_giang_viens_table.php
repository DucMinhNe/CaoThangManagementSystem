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
            $table->string('ma_gv')->primary();
            $table->string('ten_giang_vien');
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
            $table->unsignedInteger('id_bo_mon')->nullable();
            $table->string('hinh_anh_dai_dien')->nullable();
            $table->unsignedInteger('id_chuc_vu')->nullable();
            $table->boolean('trang_thai_lam_viec')->default(true);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_bo_mon')->references('id')->on('bo_mons');
            $table->foreign('id_chuc_vu')->references('id')->on('chuc_vu_giang_viens');
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
