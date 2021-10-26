<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Laravel;

// 二 路由
//Route::get('/index', 'App\Http\Controllers\Laravel\RouteController@index');
//Route::get('/read/{id}', 'App\Http\Controllers\Laravel\RouteController@read');
//
//Route::group(['namespace' => 'App\Http\Controllers\Laravel\Route'],function (){
//    Route::get('/index', 'RouteController@index');
//    Route::get('/read/{id}', 'RouteController@read');
//});

//Route::get('/read/{id}/{name}', [Laravel\Route\RouteController::class, 'read'])->where('id','[0-9]+');
Route::get('/read/{id}/{name}', [Laravel\Route\RouteController::class, 'read'])->where(['id'=>'[0-9]+', 'name'=>'[a-z]+']);

Route::get('/index', [Laravel\Route\RouteController::class, 'index']);
Route::get('/read/{id}', [Laravel\Route\RouteController::class, 'read'])->where('id', '.*');
//Route::get('/read/{id}', [Laravel\Route\RouteController::class, 'read']);

Route::redirect("/index", "/read/1");
