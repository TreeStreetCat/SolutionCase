<?php

namespace App\Http\Controllers\Lottery;

use App\Exceptions\Base\BaseException;
use App\Exceptions\Code\BaseCode;
use App\Exceptions\Code\ScLotteryCode;
use App\Http\Controllers\Controller;
use App\Models\Lottery\ScLotteryPrize;
use Illuminate\Http\Request;

class ScLotteryController extends Controller
{

    /**
     * 抽奖
     *
     * @param Request $request
     * @param $source
     * @return \Illuminate\Http\JsonResponse
     * @throws BaseException
     */
    public function draw(Request $request, $source){
        try {
            // 抽奖
            (new ScLotteryPrize())->draw($source);
        }catch (\Exception $e){
            throw new BaseException(ScLotteryCode::SCLOTTERY_DRAW_EXCEPTION);
        }
        return $this->json_output(BaseCode::HTTP_OK, "抽奖成功");
    }
}
