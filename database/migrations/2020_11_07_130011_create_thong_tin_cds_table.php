<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongTinCdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_tin_cds', function (Blueprint $table) {
            $table->id("ma_CD");
            $table->string("ten_CD")->nullable(false);
            $table->integer('ma_loai_CD')->nullable(false);
            $table->integer('ma_tem_ban_quyen')->nullable(false);
            $table->integer('ma_dao_dien')->nullable(false);
            $table->string("mo_ta")->nullable(true);
            $table->string("khu_vuc")->nullable(true);
            $table->string("hinh_anh")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thong_tin_cds');
    }
}
