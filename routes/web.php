<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ShortLink\ShortLinkController;

Route::group(['namespace' => ''], function() {
    Route::get('/test', [ShortLinkController::class, 'test']);
});


include base_path('routes/laravel/laravel_route.php');
include base_path('routes/lottery/lottery_route.php');

