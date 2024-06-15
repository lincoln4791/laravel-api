<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

class TestController extends Controller
{
    //use AuthorizesRequests, ValidatesRequests;
    public function test(){
        return "first api test";
    }
}
