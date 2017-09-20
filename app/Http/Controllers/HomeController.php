<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo Auth::user()->name;
//        dd(\Route::has('test'));
        echo route('baidu_map');
        echo 'hello000';
        echo "<br/>";
        echo app('router')->getRoutes()->getByName('baidu_map')->uri();
        return view('home');
    }
}
