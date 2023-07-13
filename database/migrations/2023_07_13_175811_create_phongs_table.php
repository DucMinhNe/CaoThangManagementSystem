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
            $table->integer('id', true);
            $table->integer('id_loai_phong')->nullable()->index('id_loai_phong');
            $table->string('ten_phong')->nullable();
            $table->string('mo_ta')->nullable();
            $table->integer('suc_chua')->nullable();
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
        Schema::dropIfExists('phongs');
    }
};
