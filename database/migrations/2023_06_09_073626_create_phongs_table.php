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
        Schema::create('phongs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_phong');
            $table->string('mo_ta')->nullable();
            $table->integer('suc_chua');
            $table->unsignedInteger('id_loai_phong');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_loai_phong')->references('id')->on('loai_phongs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phongs');
    }
};
