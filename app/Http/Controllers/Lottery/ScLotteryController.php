<?php

namespace App\Http\Controllers\Lottery;

use App\Common\CommonCode;
use App\Http\Controllers\Controller;
use App\Models\Lottery\ScLotteryPrize;
use Illuminate\Http\Request;

class ScLotteryController extends Controller
{
    public function draw(Request $request, $source){
        try {
            (new ScLotteryPrize())->draw($source);

        }catch (\Exception $e){

        }
    }
}
