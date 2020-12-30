<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietHoaDonNhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_don_nhaps', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('ma_HDN');
            $table->bigInteger('ma_CD');
            $table->double('gia_nhap', 15, 2)->default(0.00);
            $table->integer('so_luong')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_hoa_don_nhaps');
    }
}
