<?php

namespace Tests\Models\Lottery;

use App\Common\CommonCode;
use App\Exceptions\Base\BaseException;
use App\Models\Lottery\ScLotteryPrize;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\New_;
use Tests\TestCase;


class ScLotteryPrizeTest extends TestCase
{

    public function testGetWinnerPrize()
    {
        \Log::info(CommonCode::SUCCESS);
        $source = 'source_1';
        \Log::info((new ScLotteryPrize())->getWinnerPrize($source));
        $this->assertTrue(true);
    }

}
