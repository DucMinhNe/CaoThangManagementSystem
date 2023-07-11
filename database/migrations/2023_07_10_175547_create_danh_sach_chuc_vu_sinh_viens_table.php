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
        Schema::create('danh_sach_chuc_vu_sinh_viens', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('ma_sv')->nullable()->index('ma_sv');
            $table->integer('id_chuc_vu')->nullable()->index('id_chuc_vu');
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
        Schema::dropIfExists('danh_sach_chuc_vu_sinh_viens');
    }
};
