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
        Schema::create('chuyen_nganhs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('ten_chuyen_nganh')->nullable();
            $table->string('ma_chu')->nullable();
            $table->string('ma_so')->nullable();
            $table->integer('id_khoa')->nullable()->index('id_khoa');
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
        Schema::dropIfExists('chuyen_nganhs');
    }
};
