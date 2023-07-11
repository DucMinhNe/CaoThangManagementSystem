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
        Schema::create('dang_ky_lop_hoc_phans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_lop_hoc_phan')->nullable()->index('id_lop_hoc_phan');
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->decimal('tien_dong', 10, 0)->nullable();
            $table->boolean('da_dong_tien')->nullable()->default(false);
            $table->boolean('duyet')->nullable()->default(false);
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
        Schema::dropIfExists('dang_ky_lop_hoc_phans');
    }
};
