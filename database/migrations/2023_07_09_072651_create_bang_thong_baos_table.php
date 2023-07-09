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
        Schema::create('bang_thong_baos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_lop_hoc_phan')->nullable()->index('id_lop_hoc_phan');
            $table->integer('id_lop_hoc')->nullable()->index('id_lop_hoc');
            $table->string('ma_gv')->nullable()->index('ma_gv');
            $table->text('tieu_de')->nullable();
            $table->text('noi_dung')->nullable();
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
        Schema::dropIfExists('bang_thong_baos');
    }
};
