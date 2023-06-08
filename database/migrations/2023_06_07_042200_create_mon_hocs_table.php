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
        Schema::create('mon_hocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_mon_hoc');
            $table->unsignedInteger('id_bo_mon');
            $table->unsignedInteger('id_loai_mon_hoc');
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
            $table->foreign('id_bo_mon')->references('id')->on('bo_mons');
            $table->foreign('id_loai_mon_hoc')->references('id')->on('loai_mon_hocs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mon_hocs');
    }
};
