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
        Schema::create('thong_bao_cua_sinh_viens', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_thong_bao')->nullable()->index('id_thong_bao');
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->boolean('trang_thai_doc')->nullable()->default(false);
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
        Schema::dropIfExists('thong_bao_cua_sinh_viens');
    }
};
