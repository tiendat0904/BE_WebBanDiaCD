<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhaPhatHanhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nha_phat_hanhs', function (Blueprint $table) {
            $table->id("ma_nha_phat_hanh");
            $table->string("ten_nha_phat_hanh");
            $table->string("dia_chi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nha_phat_hanhs');
    }
}
