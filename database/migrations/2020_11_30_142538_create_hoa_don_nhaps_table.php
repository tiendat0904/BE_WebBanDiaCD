<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonNhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_don_nhaps', function (Blueprint $table) {
            $table->id("ma_HDN");
            $table->bigInteger("ma_nhan_vien")->nullable(false);
            $table->bigInteger('ma_nha_phat_hanh')->nullable(false);
            $table->date('ngay_nhap')->nullable(false);
            $table->double('tong_tien', 15, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_don_nhaps');
    }
}
