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
Route::get('index/{id}', function ($id) {
    $arr = ['link_id' => 1, 'share_count' => 2];
    $array = array_map(function (){
        $item = arr
        $item['id'] = $item['link_id'];
        unset($item['link_id']);
        return $item;
    }, $arr);
    dd($array);
    return 'Hello, World!'.$id;
});
