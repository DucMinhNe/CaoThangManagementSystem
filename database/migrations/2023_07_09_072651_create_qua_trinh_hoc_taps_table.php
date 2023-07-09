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
        Schema::create('qua_trinh_hoc_taps', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_lop_hoc')->nullable()->index('id_lop_hoc');
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->date('thoi_gian_bat_dau')->nullable();
            $table->date('thoi_gian_ket_thuc')->nullable();
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
        Schema::dropIfExists('qua_trinh_hoc_taps');
    }
};
