<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
        return view('home');
    }

    public function detail(){
        $data = ['name'=>'xiaoming','sex'=>'male','age'=>'18','address'=>'beijing'];
        echo "<pre>";
        print_r($data);

        $b = '2';
        $res = compact("data");
        print_r($res);
        print_r($res);
        echo "路由";

        //return view('admin.detail');
    }
}
