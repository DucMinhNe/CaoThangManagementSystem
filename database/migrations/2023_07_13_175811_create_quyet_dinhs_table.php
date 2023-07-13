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
            $table->integer('id', true);
            $table->string('ma_gv_ra_quyet_dinh')->nullable()->index('ma_gv_ra_quyet_dinh');
            $table->date('ngay_ra_quyet_dinh')->nullable();
            $table->text('noi_dung')->nullable();
            $table->date('hieu_luc_bat_dau')->nullable();
            $table->date('hieu_luc_ket_thuc')->nullable();
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
        Schema::dropIfExists('quyet_dinhs');
    }
};
