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
        Schema::connection('mysql_lottery')->create('sc_lottery_prizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prize_name', 20)->comment('奖品名');
            $table->string('source', 20)->comment('抽奖期数');
            $table->integer('probability')->default(0)->comment('中奖概率');
            $table->unsignedInteger('stock_count')->comment('库存数量');
            $table->softDeletes();
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
        Schema::connection('mysql_lottery')->dropIfExists('sc_lottery_prizes');
    }
}
