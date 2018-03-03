<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoController extends Controller
{
    //
    public function index(){
        echo 'two';
        $res = in_array($url = 'http://www.qq.com',$arr = ["http://www.qq.com","http://www.qq.com/1.html"]);
       
    }
}
