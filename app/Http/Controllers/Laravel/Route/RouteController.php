<?php

namespace App\Http\Controllers\Laravel\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(){
        return phpinfo();
        return __FUNCTION__."AA";
        return "index";
    }

    public function read($id){
        return "id:".$id;
    }
}
