<?php

namespace App\Models\Lottery;

use App\Http\Traits\RedisLock;
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
    use HasFactory, SoftDeletes, RandNum, RedisLock;

    protected $connection = 'mysql_lottery';

    protected $table = 'sc_lottery_prizes';

    protected $guarded = [];

    /**
     * 获取中奖奖品
     *
     * @param $source
     * @return mixed
     */
    public function getWinnerPrize($source){
        // 1. 获取所有奖品
       $scLotteryPrizes = ScLotteryPrize::where('source', $source)->get();
       // 2. 获奖的总概率
       $probability = $scLotteryPrizes->sum('probability');
       // 3. 循环 抽奖
       foreach ($scLotteryPrizes as $scLotteryPrize){
           // 获取当前的概率数字
           $lotteryNum = mt_rand(1, $probability);
           \Log::info("当前概率数字：".$lotteryNum." 当前奖品 ".$scLotteryPrize->prize_name." 概率：".$scLotteryPrize->probability." 获奖总概率：".$probability);
           if ($lotteryNum <= $scLotteryPrize->probability){
               // 3.1 检查库存
               if ($scLotteryPrize->stock_count > 0){
                   // 3.1 中奖，返回奖品
                   return $scLotteryPrize;
               }
               // 3.2 无库存，未中奖，减去当前概率
               $probability -= $scLotteryPrize->probability;
           }else{
               // 3.3 未中奖，减去当前概率
               $probability -= $scLotteryPrize->probability;
           }
       }
    }

    /**
     * 抽奖
     *
     * @param $source
     */
    public function draw($source){
        try{
            // lock 加锁
            $this->init("lottery", $source);
            $this->addLock();
            // 获取中奖奖品
            $scLotteryPrize = $this->getWinnerPrize($source);
            // 减库存
            if (isset($scLotteryPrize) && $scLotteryPrize->stock_count > 0){
                $scLotteryPrize->stock_count = $scLotteryPrize->stock_count - 1;
                $scLotteryPrize->save();
            }
        }catch (\Exception $e){
            \Log::error($e->getFile() . ' ' . $e->getLine() . ': ' . $e->getMessage());
        } finally {
            // lock 解锁
            $this->unlock();
        }
    }
}
