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
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->string('ma_sv')->primary();
            $table->string('ten_sinh_vien');
            $table->date('ngay_sinh');
            $table->string('noi_sinh');
            $table->boolean('gioi_tinh');
            $table->string('dan_toc');
            $table->string('so_cmt');
            $table->string('ton_giao');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->string('khoa_hoc');
            $table->string('hinh_anh_dai_dien');
            $table->string('bac_dao_tao');
            $table->string('he_dao_tao');
            $table->string('dia_chi_thuong_tru');
            $table->string('dia_chi_tam_tru');
            $table->string('id_lop_hoc');
            $table->string('tinh_trang_hoc');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinh_viens');
    }
};
