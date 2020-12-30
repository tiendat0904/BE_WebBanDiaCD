<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemBanQuyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tem_ban_quyens', function (Blueprint $table) {
            $table->id("ma_tem_ban_quyen");
            $table->string("ten_tem_ban_quyen");
            $table->int("so_luong", 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tem_ban_quyens');
    }
}
