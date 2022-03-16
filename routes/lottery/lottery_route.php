<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Laravel;


Route::get('/draw/{source}', [\App\Http\Controllers\Lottery\ScLotteryController::class, 'draw']);


