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
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_lop');
            $table->unsignedInteger('id_chuyen_nganh');
            $table->string('ma_gv_chu_nhiem')->nullable();
            $table->string('ma_sv_lop_truong')->nullable();
            $table->string('ma_sv_lop_pho_1')->nullable();
            $table->string('ma_sv_lop_pho_2')->nullable();
            $table->string('ma_sv_bi_thu')->nullable();
            $table->string('ma_sv_pho_bi_thu')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            // $table->foreign('id_chuyen_nganh')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_gv_chu_nhiem')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_sv_lop_truong')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_sv_lop_pho_1')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_sv_lop_pho_2')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_sv_bi_thu')->references('id')->on('chuyen_nganhs');
            // $table->foreign('ma_sv_pho_bi_thu')->references('id')->on('chuyen_nganhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop_hocs');
    }
};
