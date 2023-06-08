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
        Schema::create('bo_mons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_bo_mon');
            $table->unsignedInteger('id_khoa');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_khoa')->references('id')->on('khoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bo_mons');
    }
};
