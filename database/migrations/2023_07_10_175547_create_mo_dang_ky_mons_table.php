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
        Schema::create('mo_dang_ky_mons', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('khoa_hoc')->nullable();
            $table->integer('id_mon_hoc')->nullable()->index('id_mon_hoc');
            $table->dateTime('mo_dang_ky')->nullable();
            $table->dateTime('dong_dang_ky')->nullable();
            $table->boolean('da_dong')->nullable();
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
        Schema::dropIfExists('mo_dang_ky_mons');
    }
};
