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
        Schema::create('quyet_dinhs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_gv_ra_quyet_dinh');
            $table->datetime('ngay_ra_quyet_dinh');
            $table->text('noi_dung');
            $table->datetime('hieu_luc_bat_dau');
            $table->datetime('hieu_luc_ket_thuc')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('ma_gv_ra_quyet_dinh')->references('ma_gv')->on('giang_viens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quyet_dinhs');
    }
};
