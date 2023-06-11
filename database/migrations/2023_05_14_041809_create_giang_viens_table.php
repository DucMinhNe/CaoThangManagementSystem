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
            $table->string('ten_giang_vien')->nullable();
            $table->string('email')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('so_cmt')->nullable();
            $table->boolean('gioi_tinh')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('noi_sinh')->nullable();
            $table->string('dan_toc')->nullable();
            $table->string('ton_giao')->nullable();
            $table->string('dia_chi_thuong_tru')->nullable();
            $table->string('dia_chi_tam_tru')->nullable();
            $table->string('hinh_anh_dai_dien')->nullable();
            $table->string('tai_khoan')->nullable();
            $table->string('mat_khau')->nullable();
            $table->unsignedInteger('id_bo_mon')->nullable();
            $table->unsignedInteger('id_chuc_vu')->nullable();
            $table->unsignedInteger('tinh_trang_lam_viec')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->foreign('id_bo_mon')->references('id')->on('bo_mons');
            $table->timestamps();
            // $table->foreign('id_chuc_vu')->references('id')->on('chuc_vu_giang_viens');
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