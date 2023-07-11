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
        Schema::create('ct_chuong_trinh_dao_taos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_chuong_trinh_dao_tao')->nullable()->index('id_chuong_trinh_dao_tao');
            $table->integer('hoc_ky')->nullable();
            $table->integer('id_mon_hoc')->nullable()->index('id_mon_hoc');
            $table->integer('so_tin_chi')->nullable();
            $table->integer('so_tiet')->nullable();
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
        Schema::dropIfExists('ct_chuong_trinh_dao_taos');
    }
};
