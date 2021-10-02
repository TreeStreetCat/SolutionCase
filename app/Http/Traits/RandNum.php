<?php

namespace App\Http\Traits;


trait RandNum{
    /**
     * 生成随机浮点数（小数）并保留两位小数点函数：
     *
     * @param int $min
     * @param int $max
     * @return float
     */
    function randFloat($min = 0, $max = 1) {
        $rand = $min + mt_rand() / mt_getrandmax() * ($max - $min);
        return floatval(number_format($rand,2));
    }
}
