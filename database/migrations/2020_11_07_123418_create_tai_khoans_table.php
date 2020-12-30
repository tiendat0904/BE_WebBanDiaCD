<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTaiKhoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id('ma_tai_khoan');
            $table->string('ten_dang_nhap')->unique();
            $table->string('mat_khau')->nullable(false);
            $table->string('ho_ten', 50);
            $table->string('dia_chi');
            $table->string('so_dien_thoai', 10)->nullable(false);
            $table->string('hinh_anh')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tai_khoans');
    }
}
