<?php

namespace App\Models\Lottery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RandNum;

/**
 * 抽奖 model
 *
 * Class ScLotteryPrize
 * @package App\Models\Lottery
 */
class ScLotteryPrize extends Model
{
    use HasFactory, SoftDeletes, RandNum;

    protected $connection = 'mysql_lottery';

    protected $table = 'sc_lottery_prizes';

    public function draw($source){
        // 1. 获取所有奖品
       $scLotteryPrizes = ScLotteryPrize::where('source', $source)->get();
       // 2. 获奖的总概率
       $probability = $scLotteryPrizes->sum('probability');
       // 3. 循环 抽奖
       foreach ($scLotteryPrizes as $scLotteryPrize){
           // 获取当前的概率数字
           $lotteryNum = $this->randFloat(1, $probability);
           \Log::info("当前概率数字：".$lotteryNum." 获奖总概率：".$probability);
           if ($probability <= $lotteryNum){
               // 3.1 检查库存
               if ($scLotteryPrize->stock_count > 0){
                   // 3.1 中奖，返回奖品
                   return $scLotteryPrize;
               }
               // 3.2 无库存，未中奖，减去当前概率
               $probability -= $lotteryNum;
           }else{
               // 3.3 未中奖，减去当前概率
               $probability -= $lotteryNum;
           }
       }
    }
}
