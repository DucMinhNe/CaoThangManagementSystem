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
            $table->integer('id', true);
            $table->string('ten_lop_hoc')->nullable();
            $table->integer('id_chuyen_nganh')->nullable()->index('id_chuyen_nganh');
            $table->string('ma_gv_chu_nhiem')->nullable()->index('ma_gv_chu_nhiem');
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
        Schema::dropIfExists('lop_hocs');
    }
};
