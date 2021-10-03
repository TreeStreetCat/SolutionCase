<?php

namespace App\Http\Controllers\Laravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return "index";
    }

    public function read($id){
        return "id:".$id;
    }
}
