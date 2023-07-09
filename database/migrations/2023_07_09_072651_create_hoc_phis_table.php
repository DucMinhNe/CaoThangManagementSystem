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
        Schema::create('hoc_phis', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('hoc_ky')->nullable();
            $table->string('khoa_hoc', 11)->nullable();
            $table->integer('id_chuyen_nganh')->nullable()->index('id_chuyen_nganh');
            $table->decimal('so_tien', 10, 0)->nullable();
            $table->dateTime('ngay_bat_dau')->nullable();
            $table->dateTime('ngay_ket_thuc')->nullable();
            $table->boolean('mo_dong_hoc_phi')->nullable()->default(true);
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
        Schema::dropIfExists('hoc_phis');
    }
};
