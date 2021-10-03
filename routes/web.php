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


//Route::get('/index', 'App\Http\Controllers\Laravel\TestController@index');
//Route::get('/read/{id}', 'App\Http\Controllers\Laravel\TestController@read');

Route::group(['namespace' => 'App\Http\Controllers\Laravel'],function (){
    Route::get('/index', 'TestController@index');
    Route::get('/read/{id}', 'TestController@read');
});
