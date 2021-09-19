<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryPrizesTable extends Migration
{
    /**
     * 抽奖奖品表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_prizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prize_name', 20)->comment('奖品名');
            $table->unsignedInteger('stock_count')->comment('库存数量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_prizes');
    }
}
