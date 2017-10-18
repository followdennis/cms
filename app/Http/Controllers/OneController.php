<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneController extends Controller
{
    //one
    public function index(){
        return redirect()->action('TwoController@index');
    }
}
