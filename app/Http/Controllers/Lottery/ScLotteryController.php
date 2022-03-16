<?php

namespace App\Http\Controllers\Lottery;

use App\Common\CommonCode;
use App\Exceptions\Base\BaseException;
use App\Http\Controllers\Controller;
use App\Models\Lottery\ScLotteryPrize;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScLotteryController extends Controller
{

    public function draw(Request $request, $source){
        try {
            // 抽奖
//            (new ScLotteryPrize())->draw($source);
            throw new BaseException('message',1001);
        }catch (\Exception $e){
            throw new BaseException('message',1002);
        }
    }
}
