<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class OneController extends Controller
{
    //one
    public function index(){
        echo $curRoute = Route::Current()->getName();
    }
    //百度编辑器使用
    public function ueditor(){
        return view('ueditor');
    }
}
