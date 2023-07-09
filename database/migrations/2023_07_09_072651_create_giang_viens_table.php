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
            $table->integer('id_bo_mon')->nullable()->index('id_bo_mon');
            $table->integer('id_chuc_vu')->nullable()->index('id_chuc_vu');
            $table->boolean('tinh_trang_lam_viec')->nullable()->default(true);
            $table->boolean('trang_thai')->nullable()->default(true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
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
