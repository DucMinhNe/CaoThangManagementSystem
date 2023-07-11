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
        Schema::create('lop_hoc_phans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('ten_lop_hoc_phan')->nullable();
            $table->integer('id_lop_hoc')->nullable()->index('id_lop_hoc');
            $table->string('ma_gv_1')->nullable()->index('ma_gv_1');
            $table->string('ma_gv_2')->nullable()->index('ma_gv_2');
            $table->string('ma_gv_3')->nullable()->index('ma_gv_3');
            $table->integer('id_ct_chuong_trinh_dao_tao')->nullable()->index('id_ct_chuong_trinh_dao_tao');
            $table->boolean('mo_dang_ky')->nullable()->default(true);
            $table->boolean('trang_thai_hoan_thanh')->nullable()->default(false);
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
        Schema::dropIfExists('lop_hoc_phans');
    }
};
