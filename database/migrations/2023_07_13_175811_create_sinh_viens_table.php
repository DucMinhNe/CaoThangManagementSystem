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
            $table->string('ten_sinh_vien')->nullable();
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
            $table->string('khoa_hoc')->nullable();
            $table->string('bac_dao_tao')->nullable();
            $table->string('he_dao_tao')->nullable();
            $table->integer('id_lop_hoc')->nullable()->index('id_lop_hoc');
            $table->string('tinh_trang_hoc')->nullable();
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
        Schema::dropIfExists('sinh_viens');
    }
};
