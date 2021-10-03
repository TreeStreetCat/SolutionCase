<?php

namespace Database\Seeders;

use App\Models\Lottery\ScLotteryPrize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LotteryPrizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['prize_name' => '奖品A', 'source' => 'source_1', 'probability' => 7000, 'stock_count' => 99999],
            ['prize_name' => '奖品B', 'source' => 'source_1', 'probability' => 1350, 'stock_count' => 99999],
            ['prize_name' => '奖品C', 'source' => 'source_1', 'probability' => 1000, 'stock_count' => 20],
            ['prize_name' => '奖品D', 'source' => 'source_1', 'probability' => 650, 'stock_count' => 10]
        ];

        foreach ($items as $item) {
            ScLotteryPrize::create($item);
        }
    }
}
